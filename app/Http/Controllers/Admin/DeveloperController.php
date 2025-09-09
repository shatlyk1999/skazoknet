<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Developer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->all() ?? '';
        $developers = Developer::filter($filter)->orderBy('sort', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $cities = City::get();
        $users = User::where('role', 'developer')
            ->whereDoesntHave('developer')
            ->get();
        $developer_users = User::where('role', 'developer')
            ->whereHas('developer')
            ->get();

        return view('admin.developer.index', compact('developers', 'cities', 'filter', 'users', 'developer_users'));
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
            'city_ids' => 'required',
        ]);

        try {
            $status = false;
            if ($request->has('status_create')) {
                $status = true;
            }

            $popular = false;
            if ($request->has('popular')) {
                $popular = true;
            }

            $developer = Developer::create([
                'name' => $request->name,
                'content' => $request->content,
                'year_establishment' => $request->year_establishment,
                'sort' => $request->sort,
                'status' => $status,
                'popular' => $popular,
                'slug' => Str::slug($request->name),
                'user_id' => $request->user_id,
            ]);

            if ($request->has('image')) {
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/developer'))) {
                    mkdir(storage_path('app/developer'), 0777, true);
                }
                // if (!is_dir(storage_path('app/developer-small'))) {
                //     mkdir(storage_path('app/developer-small'), 0777, true);
                // }

                $destinationPath = storage_path('app/developer');
                // $destinationPath2 = storage_path('app/developer-small');

                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() < 500 || $img->height() < 300) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 500x300)'
                    ]);
                }

                // $originalWidth = $img->width();
                // $originalHeight = $img->height();

                // $width = $originalWidth;
                // $height = $originalHeight;

                // if ($width >= 2000) {
                //     $width = intval($originalWidth / 4);
                //     $height = intval($originalHeight / 4);
                // } elseif ($width >= 1000) {
                //     $width = intval($originalWidth / 2);
                //     $height = intval($originalHeight / 2);
                // }

                // $img->resize($width, $height, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // }); 
                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                // $img->resize(146, 134, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // });

                // file_put_contents(($destinationPath2 . '/' . $input['imageName']),
                //     (string) $img->encode(new WebpEncoder(quality: 100))
                // );

                $developer->image = $input['imageName'];
                $developer->save();
            }

            if ($request->has('city_ids')) {
                $developer->syncCities($request->city_ids);
            }

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Застройщик успешно создан',
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
            $developer = Developer::find($id);
            if (!$developer) {
                return redirect()->back()->with([
                    'type' => 'error',
                    'message' => 'Застройщик не найден',
                ]);
            }

            if ($request->has('image')) {
                $filePath = storage_path('app/developer/' . $developer->image);
                // $filePath2 = storage_path('app/developer-small/' . $developer->image);

                if (($developer->image != null) && file_exists($filePath)) {
                    unlink($filePath);
                }
                // if (($developer->image != null) && file_exists($filePath2)) {
                //     unlink($filePath);
                // }
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/developer'))) {
                    mkdir(storage_path('app/developer'), 0777, true);
                }
                // if (!is_dir(storage_path('app/developer-small'))) {
                //     mkdir(storage_path('app/developer-small'), 0777, true);
                // }

                $destinationPath = storage_path('app/developer');
                // $destinationPath2 = storage_path('app/developer-small');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() < 500 || $img->height() < 300) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 500x300)'
                    ]);
                }

                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                // $img->resize(146, 134, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // });

                // file_put_contents(($destinationPath2 . '/' . $input['imageName']),
                //     (string) $img->encode(new WebpEncoder(quality: 100))
                // );

                $developer->image = $input['imageName'];
                $developer->save();
            }

            $status = false;
            if ($request->has('status_update')) {
                $status = true;
            }
            $popular = false;
            if ($request->has('popular')) {
                $popular = true;
            }
            $developer->update([
                'name' => $request->name,
                'sort' => $request->sort,
                'year_establishment' => $request->year_establishment,
                'content' => $request->content,
                'status' => $status,
                'popular' => $popular,
                'slug' => Str::slug($request->name),
                'user_id' => $request->user_id,
            ]);

            if ($request->has('city_ids')) {
                $developer->syncCities($request->city_ids);
            } else {
                $developer->cities()->delete();
            }

            return to_route('developer.index')->with([
                'type' => 'success',
                'message' => 'Застройщик успешно отредактирован',
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
        $developer = Developer::find($id);
        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Застройщик не найден',
            ]);
        }
        $filePath = storage_path('app/developer/' . $developer->image);

        if (($developer->image != null) && file_exists($filePath)) {
            unlink($filePath);
        }
        $developer->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Застройщик успешно удалён',
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required|boolean',
            ]);

            $developer = Developer::findOrFail($request->id);
            $developer->status = $request->status;
            $developer->save();

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
}
