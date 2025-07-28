<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        // Avatar upload - temporarily disabled for testing

        // Try different file input names
        // Log::info('File input attempts:', [
        //     'avatar' => $request->hasFile('avatar'),
        //     'image' => $request->hasFile('image'),
        //     'file' => $request->hasFile('file'),
        //     'redaktFileInput' => $request->hasFile('redaktFileInput')
        // ]);

        if ($request->hasFile('avatar')) {
            // try {
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

            // if ($img->width() < 200 || $img->height() < 200) {
            //     return redirect()->back()->with([
            //         'type' => 'warning',
            //         'message' => 'Изображение слишком маленькое (менее 200x200)'
            //     ]);
            // }

            // $img->resize(200, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            file_put_contents(($destinationPath . '/' . $input['imageName']),
                (string) $img->encode(new WebpEncoder(quality: 100))
            );

            $user->avatar = $input['imageName'];
            // } catch (\Exception $e) {
            //     return response()->json([
            //         'message' => $e->getMessage(),
            //     ]);
            // }
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
        // Fetch company information from the database
        // $companyInfo = ::first();

        // if (!$companyInfo) {
        //     return redirect()->back()->with([
        //         'type' => 'error',
        //         'message' => 'Информация о компании не найдена'
        //     ]);
        // }

        // return view('cabinet.about_company', compact('companyInfo'));
    }
}
