<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Developer;
use App\Models\Complex;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userProfile($id)
    {
        return view('cabinet.user');
    }

    public function userUpdate(Request $request, $id)
    {
        // DEBUG: Request details
        Log::info('=== USER UPDATE DEBUG ===', [
            'has_avatar_file' => $request->hasFile('avatar'),
            'all_files' => $request->allFiles(),
            'all_input' => $request->all(),
            'content_type' => $request->header('Content-Type')
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Комплекс не найден',
            ]);
        }
        if ($request->has('name') && $request->name != $user->name) {
            $user->name = $request->name;
        }
        $passwordChanged = false;
        if ($request->has('password') && $request->password != null) {
            $user->password = Hash::make($request->password);
            $passwordChanged = true;
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;

            if ($user->avatar != null) {
                $filePath = storage_path('app/avatar/' . $user->avatar);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $input['imageName'] = time() . '.webp';

            if (!is_dir(storage_path('app/avatar'))) {
                mkdir(storage_path('app/avatar'), 0777, true);
            }

            $destinationPath = storage_path('app/avatar');

            $manager = new ImageManager(new Driver());
            $img = $manager->read($avatar);

            file_put_contents(($destinationPath . '/' . $input['imageName']),
                (string) $img->encode(new WebpEncoder(quality: 100))
            );

            $user->avatar = $input['imageName'];
        }
        $user->save();

        // Send password change notification email (ignore SMTP errors)
        if ($passwordChanged) {
            try {
                Mail::to($user->email)->send(new \App\Mail\PasswordChanged($user));
            } catch (\Exception $e) {
                // Ignore SMTP errors in local development
                Log::info('Password change email sending failed (ignored): ' . $e->getMessage());
            }
        }

        return back();
    }

    public function aboutCompany($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден'
            ]);
        }

        // Check if user has developer role
        if ($user->role !== 'developer' && $user->role !== 'superadmin') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа к этой странице'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        return view('cabinet.company', compact('developer'));
    }

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|max:10240', // max 10MB
            'name' => 'required',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден'
            ]);
        }

        // Check if user has developer role
        if ($user->role !== 'developer' && $user->role !== 'superadmin') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа к этой странице'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        try {
            // Handle image upload (same as admin)
            if ($request->hasFile('image')) {
                // Delete old images if exist
                $filePath = storage_path('app/developer/' . $developer->image);
                $filePath2 = storage_path('app/developer-small/' . $developer->image);

                if (($developer->image != null) && file_exists($filePath)) {
                    unlink($filePath);
                }
                if (($developer->image != null) && file_exists($filePath2)) {
                    unlink($filePath2);
                }

                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/developer'))) {
                    mkdir(storage_path('app/developer'), 0777, true);
                }
                if (!is_dir(storage_path('app/developer-small'))) {
                    mkdir(storage_path('app/developer-small'), 0777, true);
                }

                $destinationPath = storage_path('app/developer');
                $destinationPath2 = storage_path('app/developer-small');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() < 500 || $img->height() < 300) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 500x300)'
                    ]);
                }

                // Create main image (500x300)
                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                // Create small image (146x134)
                $img->resize(146, 134, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath2 . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                $developer->image = $input['imageName'];
            }

            // Update developer information (same fields as admin)
            $status = $request->has('status') ? (bool)$request->status : true;
            $popular = $request->has('popular') ? (bool)$request->popular : false;

            $developer->update([
                'name' => $request->name,
                'year_establishment' => $request->year_establishment,
                'content' => $request->content,
                'sort' => $request->sort ?? 0,
                'status' => $status,
                'popular' => $popular,
                'slug' => \Illuminate\Support\Str::slug($request->name),
            ]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Информация о компании успешно обновлена'
            ]);
        } catch (\Exception $e) {
            Log::error('Company update failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Ошибка при обновлении: ' . $e->getMessage()
            ]);
        }
    }

    public function myComplexes(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден'
            ]);
        }

        // Check if user has developer role
        if ($user->role !== 'developer' && $user->role !== 'superadmin') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа к этой странице'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        // Build query for complexes
        $query = Complex::where('developer_id', $developer->id)->with(['city', 'developer']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Order by sort and created_at
        $complexes = $query->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cabinet.complexes', compact('complexes'));
    }

    public function searchComplexes(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user || ($user->role !== 'developer' && $user->role !== 'superadmin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $developer = $user->developer;

        if (!$developer) {
            return response()->json(['error' => 'Developer not found'], 404);
        }

        // Build query for complexes
        $query = Complex::where('developer_id', $developer->id)->with(['city', 'developer']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Order by sort and created_at
        $complexes = $query->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cabinet.complexes-list', compact('complexes'))->render();
    }

    public function createComplex($id)
    {
        $user = User::find($id);

        if (!$user || ($user->role !== 'developer' && $user->role !== 'superadmin')) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа к этой странице'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        return view('cabinet.create-complex');
    }

    public function storeComplex(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|max:10240', // max 10MB
            'additional_images.*' => 'image|max:10240',
        ]);

        $user = User::find($id);

        if (!$user || ($user->role !== 'developer' && $user->role !== 'superadmin')) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        try {
            $status = $request->has('status') ? (bool)$request->status : true;
            $popular = $request->has('popular') ? (bool)$request->popular : false;

            $complex = Complex::create([
                'name' => $request->name,
                'content' => $request->content,
                'address' => $request->address,
                'sort' => $request->sort ?? 0,
                'status' => $status,
                'popular' => $popular,
                'city_id' => $user->city_id ?? 1,
                'developer_id' => $developer->id,
                'type' => $request->type ?? 'residential',
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'map_x' => $request->map_x,
                'map_y' => $request->map_y,
            ]);

            // Handle main image upload (same as admin)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/complex'))) {
                    mkdir(storage_path('app/complex'), 0777, true);
                }
                if (!is_dir(storage_path('app/complex-small'))) {
                    mkdir(storage_path('app/complex-small'), 0777, true);
                }

                $destinationPath = storage_path('app/complex');
                $destinationPath2 = storage_path('app/complex-small');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() < 500 || $img->height() < 300) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 500x300)'
                    ]);
                }

                // Create main image (500x300)
                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                // Create small image (146x134)
                $img->resize(146, 134, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath2 . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                $complex->image = $input['imageName'];
                $complex->save();
            }

            // Handle additional images
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $additionalImage) {
                    $additionalImageName = time() . '_' . uniqid() . '.webp';

                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($additionalImage);

                    // Create main additional image
                    $img->resize(500, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    file_put_contents(($destinationPath . '/' . $additionalImageName),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    // Create small additional image
                    $img->resize(146, 134, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    file_put_contents(($destinationPath2 . '/' . $additionalImageName),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    // Save to complex_images table
                    \App\Models\ComplexImage::create([
                        'complex_id' => $complex->id,
                        'image' => $additionalImageName,
                    ]);
                }
            }

            return redirect()->route('myComplexes', $user->id)->with([
                'type' => 'success',
                'message' => 'Комплекс успешно создан'
            ]);
        } catch (\Exception $e) {
            Log::error('Complex creation failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Ошибка при создании: ' . $e->getMessage()
            ]);
        }
    }

    public function editComplex($userId, $complexId)
    {
        $user = User::find($userId);

        if (!$user || ($user->role !== 'developer' && $user->role !== 'superadmin')) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        $complex = Complex::with('images')->where('id', $complexId)
            ->where('developer_id', $developer->id)
            ->first();

        if (!$complex) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Комплекс не найден'
            ]);
        }

        return view('cabinet.edit-complex', compact('complex'));
    }

    public function updateComplex(Request $request, $userId, $complexId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|max:10240', // max 10MB
            'additional_images.*' => 'image|max:10240',
        ]);

        $user = User::find($userId);

        if (!$user || ($user->role !== 'developer' && $user->role !== 'superadmin')) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        $complex = Complex::where('id', $complexId)
            ->where('developer_id', $developer->id)
            ->first();

        if (!$complex) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Комплекс не найден'
            ]);
        }

        try {
            // Handle main image upload (same as admin)
            if ($request->hasFile('image')) {
                // Delete old images if exist
                $filePath = storage_path('app/complex/' . $complex->image);
                $filePath2 = storage_path('app/complex-small/' . $complex->image);

                if (($complex->image != null) && file_exists($filePath)) {
                    unlink($filePath);
                }
                if (($complex->image != null) && file_exists($filePath2)) {
                    unlink($filePath2);
                }

                $image = $request->file('image');
                $input['imageName'] = time() . '.webp';

                if (!is_dir(storage_path('app/complex'))) {
                    mkdir(storage_path('app/complex'), 0777, true);
                }
                if (!is_dir(storage_path('app/complex-small'))) {
                    mkdir(storage_path('app/complex-small'), 0777, true);
                }

                $destinationPath = storage_path('app/complex');
                $destinationPath2 = storage_path('app/complex-small');
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                if ($img->width() < 500 || $img->height() < 300) {
                    return redirect()->back()->with([
                        'type' => 'warning',
                        'message' => 'Изображение слишком маленькое (менее 500x300)'
                    ]);
                }

                // Create main image (500x300)
                $img->resize(500, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                // Create small image (146x134)
                $img->resize(146, 134, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                file_put_contents(($destinationPath2 . '/' . $input['imageName']),
                    (string) $img->encode(new WebpEncoder(quality: 100))
                );

                $complex->image = $input['imageName'];
            }

            // Update complex information (same fields as admin)
            $status = $request->has('status') ? (bool)$request->status : true;
            $popular = $request->has('popular') ? (bool)$request->popular : false;

            $complex->update([
                'name' => $request->name,
                'content' => $request->content,
                'address' => $request->address,
                'sort' => $request->sort ?? 0,
                'status' => $status,
                'popular' => $popular,
                'type' => $request->type ?? 'residential',
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'map_x' => $request->map_x,
                'map_y' => $request->map_y,
            ]);

            // Handle additional images
            if ($request->hasFile('additional_images')) {
                $destinationPath = storage_path('app/complex');
                $destinationPath2 = storage_path('app/complex-small');

                foreach ($request->file('additional_images') as $additionalImage) {
                    $additionalImageName = time() . '_' . uniqid() . '.webp';

                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($additionalImage);

                    // Create main additional image
                    $img->resize(500, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    file_put_contents(($destinationPath . '/' . $additionalImageName),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    // Create small additional image
                    $img->resize(146, 134, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    file_put_contents(($destinationPath2 . '/' . $additionalImageName),
                        (string) $img->encode(new WebpEncoder(quality: 100))
                    );

                    // Save to complex_images table
                    \App\Models\ComplexImage::create([
                        'complex_id' => $complex->id,
                        'image' => $additionalImageName,
                    ]);
                }
            }

            return redirect()->route('myComplexes', $user->id)->with([
                'type' => 'success',
                'message' => 'Комплекс успешно обновлен'
            ]);
        } catch (\Exception $e) {
            Log::error('Complex update failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Ошибка при обновлении: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteComplexImage($imageId)
    {
        try {
            $complexImage = \App\Models\ComplexImage::find($imageId);

            if (!$complexImage) {
                return response()->json(['success' => false, 'message' => 'Изображение не найдено']);
            }

            // Check if user owns this complex
            $user = auth()->user();
            $developer = $user->developer;

            if (!$developer || $complexImage->complex->developer_id !== $developer->id) {
                return response()->json(['success' => false, 'message' => 'У вас нет прав на удаление этого изображения']);
            }

            // Delete files
            $filePath = storage_path('app/complex/' . $complexImage->image);
            $filePath2 = storage_path('app/complex-small/' . $complexImage->image);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
            if (file_exists($filePath2)) {
                unlink($filePath2);
            }

            // Delete from database
            $complexImage->delete();

            return response()->json(['success' => true, 'message' => 'Изображение удалено']);
        } catch (\Exception $e) {
            Log::error('Complex image deletion failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Ошибка при удалении изображения']);
        }
    }

    public function myReviews($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден',
            ]);
        }



        // Get filter parameters
        $filter = request()->get('filter', 'default');

        // Build query with filtering
        $query = $user->reviews()->with(['reviewable', 'reviewLikes', 'images']);

        // Apply filters
        switch ($filter) {
            case 'positive':
                $query->where('type', 'positive');
                break;
            case 'negative':
                $query->where('type', 'negative');
                break;
            case 'developer':
                $query->where('reviewable_type', 'App\Models\Developer');
                break;
            case 'complex':
                $query->where('reviewable_type', 'App\Models\Complex');
                break;
            case 'default':
            default:
                // No additional filtering, show all
                break;
        }

        // Apply sorting
        $query->orderBy('created_at', 'desc');

        // Get paginated results
        $reviews = $query->paginate(4); // 4 reviews per page (2 rows on desktop)

        // Calculate statistics from all reviews
        $allReviews = $user->reviews()->get();
        $positiveReviews = $allReviews->where('type', 'positive')->count();
        $negativeReviews = $allReviews->where('type', 'negative')->count();
        $totalReviews = $allReviews->count();

        // If AJAX request, return only the reviews HTML
        if (request()->ajax()) {
            $html = view('cabinet.partials.review-cards', compact('reviews'))->render();
            return response()->json([
                'html' => $html,
                'hasMore' => $reviews->hasMorePages(),
                'nextPage' => $reviews->currentPage() + 1
            ]);
        }

        return view('cabinet.my-reviews', compact('user', 'reviews', 'positiveReviews', 'negativeReviews', 'totalReviews'));
    }

    public function allReviews($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден',
            ]);
        }

        // Check if user has developer role
        if ($user->role !== 'developer' && $user->role !== 'superadmin') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'У вас нет прав доступа к этой странице'
            ]);
        }

        $developer = $user->developer;

        if (!$developer) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Профиль компании не найден'
            ]);
        }

        // Get filter parameters
        $filter = request()->get('filter', 'default');

        // Get complex IDs belonging to this developer
        $complexIds = $developer->complexes()->pluck('id')->toArray();

        // Build base query for reviews related to developer and their complexes
        $query = \App\Models\Review::where(function ($q) use ($developer, $complexIds) {
            $q->where(function ($subQ) use ($developer) {
                // Reviews about the developer company
                $subQ->where('reviewable_type', 'App\Models\Developer')
                    ->where('reviewable_id', $developer->id);
            })->orWhere(function ($subQ) use ($complexIds) {
                // Reviews about developer's complexes
                $subQ->where('reviewable_type', 'App\Models\Complex')
                    ->whereIn('reviewable_id', $complexIds);
            });
        })->with(['reviewable', 'reviewLikes', 'images', 'user']);

        // Apply filters
        switch ($filter) {
            case 'positive':
                $query->where('type', 'positive');
                break;
            case 'negative':
                $query->where('type', 'negative');
                break;
            case 'developer':
                $query->where('reviewable_type', 'App\Models\Developer');
                break;
            case 'complex':
                $query->where('reviewable_type', 'App\Models\Complex');
                break;
            case 'default':
            default:
                // No additional filtering, show all
                break;
        }

        // Apply sorting
        $query->orderBy('created_at', 'desc');

        // Get paginated results
        $reviews = $query->paginate(4); // 4 reviews per page (2 rows on desktop)

        // Calculate statistics from all reviews (without filters)
        $allReviewsQuery = \App\Models\Review::where(function ($q) use ($developer, $complexIds) {
            $q->where(function ($subQ) use ($developer) {
                // Reviews about the developer company
                $subQ->where('reviewable_type', 'App\Models\Developer')
                    ->where('reviewable_id', $developer->id);
            })->orWhere(function ($subQ) use ($complexIds) {
                // Reviews about developer's complexes
                $subQ->where('reviewable_type', 'App\Models\Complex')
                    ->whereIn('reviewable_id', $complexIds);
            });
        });

        $allReviews = $allReviewsQuery->get();
        $positiveReviews = $allReviews->where('type', 'positive')->count();
        $negativeReviews = $allReviews->where('type', 'negative')->count();
        $totalReviews = $allReviews->count();

        // If AJAX request, return only the reviews HTML
        if (request()->ajax()) {
            $html = view('cabinet.partials.all-review-cards', compact('reviews'))->render();
            return response()->json([
                'html' => $html,
                'hasMore' => $reviews->hasMorePages(),
                'nextPage' => $reviews->currentPage() + 1
            ]);
        }

        return view('cabinet.all-reviews', compact('user', 'reviews', 'positiveReviews', 'negativeReviews', 'totalReviews'));
    }
}
