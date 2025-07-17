<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderByDesc('id')->paginate(10);
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'image' => 'required|image|max:10240', // max 10MB
        ]);

        $image = $request->file('image');
        $input['imageName'] = time() . '.webp';

        if (!is_dir(storage_path('app/cities'))) {
            mkdir(storage_path('app/cities'), 0777, true);
        }

        $destinationPath = storage_path('app/cities');
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);

        if ($img->width() <= 350 || $img->height() <= 450) {
            return redirect()->back()->with([
                'type' => 'warning',
                'message' => 'Изображение слишком маленькое (менее 350x450)'
            ]);
        }

        if ($img->width() > 1000) {
            $img->resize(667, 601, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // WebP encode (quality 100)
        // $encoded = $img->encode(new WebpEncoder(quality: 100));

        // Storage::put('cities/' . $input['imageName'], $encoded);
        // $img->encode('webp', 100)->save(storage_path('app/cities/' . $input['imageName']));

        file_put_contents(($destinationPath . '/' . $input['imageName']),
            (string) $img->encode(new WebpEncoder(quality: 100))
        );

        City::create([
            'name' => $request->name,
            'label' => $request->label,
            'text' => $request->text,
            'image' => $input['imageName'],
        ]);

        return to_route('city.index')->with([
            'type' => 'success',
            'message' => 'Город успешно создан',
        ]);
    }

    // } catch (Exception $e) {
    //     return redirect()->back()->with([
    //         'type' => 'error',
    //         'message' => $e->getMessage(),
    //     ]);
    // }

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
        $city = City::find($id);
        if (!$city) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => '  Город не найден',
            ]);
        }

        return view('admin.city.update', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|max:10240', // max 10MB
            'name' => 'required',
            'label' => 'required'
        ]);

        $city = City::find($id);
        if (!$city) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Город не найден',
            ]);
        }

        try {
            if ($request->has('image')) {
                $filePath = storage_path('app/cities/' . $city->image);

                if (($city->image != null) && file_exists($filePath)) {
                    unlink($filePath);
                }
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';
                if (!is_dir(storage_path('app/cities'))) {
                    mkdir(storage_path('app/cities'), 0777, true);
                }
                $destinationPath = storage_path('app/cities');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() <= 350 || $img->height() <= 450) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 350x450)'
                    ]);
                }

                if ($img->width() > 1000) {
                    $img->resize(667, 601, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );
                $city->image = $input['imageName'];
                $city->save();
            }
            $city->update([
                'name' => $request->name,
                'label' => $request->label,
                'text' => $request->text,
            ]);

            return to_route('city.index')->with([
                'type' => 'success',
                'message' => 'Город успешно отредактирован',
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
        $city = City::find($id);
        if (!$city) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Город не найден',
            ]);
        }
        $filePath = storage_path('app/cities/' . $city->image);

        if (($city->image != null) && file_exists($filePath)) {
            unlink($filePath);
        }
        $city->delete();
        return to_route('city.index')->with([
            'type' => 'success',
            'message' => 'Город успешно удалён',
        ]);
    }
}
