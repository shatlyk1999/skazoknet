<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index(Request $request)
    {
        $company_id = $request->company_id;
        return view('pages.gaining-access', compact('company_id'));
    }

    public function store(Request $request)
    {
        try {
            Access::create([
                'company_id' => $request->company_id,
                'company_name' => $request->company_name,
                'company_code' => $request->company_code,
                'email' => $request->email,
            ]);

            return view('pages.gaining-access-completed');
        } catch (\Exception $e) {
            return redirect('500');
        }
    }
}
