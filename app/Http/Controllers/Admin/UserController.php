<?php

namespace App\Http\Controllers\ADmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::isUser()->paginate('10');

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('email')) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return redirect()->back()->with([
                    'type' => 'warning',
                    'message' => 'Извините, пользователь с таким email уже существует',
                ]);
            }
        }
        $permission_comment = false;
        $status = false;
        if ($request->has('permission_comment')) {
            $permission_comment = true;
        }
        if ($request->has('status')) {
            $status = true;
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_comment' => $permission_comment,
            'status' => $status,
        ]);

        return to_route('users.index')->with([
            'type' => 'success',
            'message' => 'Пользователь успешно создан',
        ]);
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
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден',
            ]);
        }

        return view('admin.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден',
            ]);
        }
        if ($request->has('email') && $request->email != $user->email) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return redirect()->back()->with([
                    'type' => 'warning',
                    'message' => 'Извините, пользователь с таким email уже существует',
                ]);
            }
        }
        $permission_comment = false;
        $status = false;
        if ($request->has('permission_comment')) {
            $permission_comment = true;
        }
        if ($request->has('status')) {
            $status = true;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'permission_comment' => $permission_comment,
            'status' => $status,
        ]);
        if ($request->has('password') && $request->password != null) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return to_route('users.index')->with([
            'type' => 'success',
            'message' => 'Пользователь успешно отредактирован',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Пользователь не найден',
            ]);
        }
        $user->delete();
        return to_route('users.index')->with([
            'type' => 'success',
            'message' => 'Пользователь успешно удалён',
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required|boolean',
            ]);

            $user = User::findOrFail($request->id);
            $user->status = $request->status;
            $user->save();

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

    public function updatePermissionComment(Request $request)
    {
        try {
            $request->validate([
                'permission_comment' => 'required|boolean',
            ]);

            $user = User::findOrFail($request->id);
            $user->permission_comment = $request->permission_comment;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Разрешение на комментарий успешно обновлён'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось обновить Разрешение на комментарий: ' . $e->getMessage()
            ], 500);
        }
    }
}
