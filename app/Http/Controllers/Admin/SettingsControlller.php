<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class SettingsControlller extends Controller
{
    public function about_us()
    {
        $data = AboutUs::first() ?? null;
        return view('admin.settings.about_us', compact('data'));
    }

    public function about_us_store(Request $request)
    {
        try {
            $data = AboutUs::first();
            if (!$data) {
                AboutUs::create([
                    'text' => $request->text,
                ]);
            } else {
                $data->text = $request->text;
                $data->save();
            }

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Успешно обновил информацию о проекте',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
