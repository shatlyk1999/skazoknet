<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Complex;
use App\Models\ComplexImage;
use App\Models\Developer;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;


class ComplexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complexes = Complex::orderBy('sort', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $cities = City::get();
        $developers = Developer::status()->get();

        return view('admin.complex.index', compact('complexes', 'cities', 'developers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            // 'city_ids' => 'required',
        ]);

        try {
            $status = false;
            if ($request->has('status_create')) {
                $status = true;
            }

            $complex = Complex::create([
                'name' => $request->name,
                'content' => $request->content,
                'address' => $request->address,
                'sort' => $request->sort,
                'status' => $status,
                'city_id' => $request->city_id,
                'developer_id' => $request->developer_id,
            ]);

            if ($request->has('image')) {
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/complex'))) {
                    mkdir(storage_path('app/complex'), 0777, true);
                }

                $destinationPath = storage_path('app/complex');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() <= 350 || $img->height() <= 450) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 350x450)'
                    ]);
                }


                $img->resize(415, 218, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                $complex->image = $input['imageName'];
                $complex->save();
            }

            if ($request->has('images')) {
                foreach ($request->images as $key => $image) {

                    $input['imageName'] = time() . '_' . $key . '.webp';

                    if (!is_dir(storage_path('app/complex-images'))) {
                        mkdir(storage_path('app/complex-images'), 0777, true);
                    }

                    $destinationPath = storage_path('app/complex-images');
                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($image);

                    if ($img->width() <= 350 || $img->height() <= 450) {
                        return redirect()->back()->with([
                            'type' => 'warning',
                            'message' => 'Изображение слишком маленькое (менее 350x450)'
                        ]);
                    }


                    // $img->resize(415, 218, function ($constraint) {
                    //     $constraint->aspectRatio();
                    //     $constraint->upsize();
                    // });

                    file_put_contents(($destinationPath . '/' . $input['imageName']),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    $complex->images()->create(['image' => $input['imageName']]);
                }
            }

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Комплекс успешно создан',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|max:10240', // max 10MB
            'name' => 'required',
        ]);

        try {
            $complex = Complex::find($id);
            if (!$complex) {
                return redirect()->back()->with([
                    'type' => 'error',
                    'message' => 'Комплекс не найден',
                ]);
            }

            if ($request->has('image')) {
                $filePath = storage_path('app/complex/' . $complex->image);

                if (($complex->image != null) && file_exists($filePath)) {
                    unlink($filePath);
                }
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/complex'))) {
                    mkdir(storage_path('app/complex'), 0777, true);
                }

                $destinationPath = storage_path('app/complex');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() <= 350 || $img->height() <= 450) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 350x450)'
                    ]);
                }

                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                $complex->image = $input['imageName'];
                $complex->save();
            }

            $status = false;
            if ($request->has('status_update')) {
                $status = true;
            }
            $complex->update([
                'name' => $request->name,
                'sort' => $request->sort,
                'address' => $request->address,
                'content' => $request->content,
                'status' => $status,
                'city_id' => $request->city_id,
                'developer_id' => $request->developer_id,
            ]);

            if ($request->has('images')) {
                foreach ($request->images as $key => $image) {

                    $input['imageName'] = time() . '_' . $key . '.webp';

                    if (!is_dir(storage_path('app/complex-images'))) {
                        mkdir(storage_path('app/complex-images'), 0777, true);
                    }

                    $destinationPath = storage_path('app/complex-images');
                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($image);

                    if ($img->width() <= 350 || $img->height() <= 450) {
                        return redirect()->back()->with([
                            'type' => 'warning',
                            'message' => 'Изображение слишком маленькое (менее 350x450)'
                        ]);
                    }


                    // $img->resize(415, 218, function ($constraint) {
                    //     $constraint->aspectRatio();
                    //     $constraint->upsize();
                    // });

                    file_put_contents(($destinationPath . '/' . $input['imageName']),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    $complex->images()->create(['image' => $input['imageName']]);
                }
            }

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Комплекс успешно отредактирован',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complex = Complex::find($id);
        if (!$complex) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Комплекс не найден',
            ]);
        }
        $filePath = storage_path('app/complex/' . $complex->image);

        if (($complex->image != null) && file_exists($filePath)) {
            unlink($filePath);
        }
        $complex->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Комплекс успешно удалён',
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required|boolean',
            ]);

            $complex = Complex::findOrFail($request->id);
            $complex->status = $request->status;
            $complex->save();

            return response()->json([
                'success' => true,
                'message' => 'Статус успешно обновлён'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось обновить статус: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyComplexImage($image_id)
    {
        $complex_image = ComplexImage::find($image_id);
        if (!$complex_image) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Комплекс Фото не найден',
            ]);
        }
        $filePath = storage_path('app/complex-images/' . $complex_image->image);

        if (($complex_image->image != null) && file_exists($filePath)) {
            unlink($filePath);
        }
        $complex_image->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Комплекс Фото успешно удалён',
        ]);
    }
}
