<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AccessController extends Controller
{
    public function index(Request $request)
    {
        $query = Access::query();

        $filters = $request->only(['status', 'search']);
        if (!empty($filters)) {
            $query->filter($filters);
        }

        $accesses = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.access.index', compact('accesses', 'filters'));
    }

    public function reject($id)
    {
        $access = Access::findOrFail($id);
        return view('admin.access.reject', compact('access'));
    }

    public function sendRejectMessage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $access = Access::findOrFail($id);

        try {
            Mail::send('emails.access_reject', [
                'title' => $request->title,
                'message' => $request->message,
                'company_name' => $access->company_name
            ], function ($mail) use ($access, $request) {
                $mail->to($access->email)
                    ->subject($request->title);
            });
        } catch (\Exception $e) {
            Log::info('Email sending failed (ignored): ' . $e->getMessage());
        }

        $access->update(['status' => 'rejected']);

        return redirect()->route('admin.access.index')
            ->with('success', 'Заявка отклонена и уведомление отправлено');
    }

    public function approve($id)
    {
        $access = Access::findOrFail($id);
        return view('admin.access.approve', compact('access'));
    }

    public function sendApproveMessage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $access = Access::findOrFail($id);

        try {
            Mail::send('emails.access_approve', [
                'title' => $request->title,
                'login' => $request->login,
                'password' => $request->password,
                'message' => $request->message,
                'company_name' => $access->company_name
            ], function ($mail) use ($access, $request) {
                $mail->to($access->email)
                    ->subject($request->title);
            });
        } catch (\Exception $e) {
            Log::info('Email sending failed (ignored): ' . $e->getMessage());
        }

        $access->update(['status' => 'approved']);

        return redirect()->route('admin.access.index')
            ->with('success', 'Заявка одобрена и данные отправлены');
    }
}
