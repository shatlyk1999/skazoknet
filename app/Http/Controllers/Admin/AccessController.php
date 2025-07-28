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
        if ($access->status != 'pending') {
            return back();
        }
        return view('admin.access.reject', compact('access'));
    }

    public function sendRejectMessage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $access = Access::findOrFail($id);
        if ($access->status != 'pending') {
            return back();
        }
        // Send rejection email
        try {
            Log::info('Attempting to send rejection email to: ' . $access->email);

            $emailContent = view('emails.access_reject', [
                'title' => $request->title,
                'message' => $request->message,
                'company_name' => $access->company_name
            ])->render();

            Log::info('Email content rendered successfully');

            Mail::html($emailContent, function ($mail) use ($access, $request) {
                $mail->to($access->email)
                    ->subject($request->title);
            });

            Log::info('Email sent successfully to: ' . $access->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        $access->update(['status' => 'rejected']);

        return redirect()->route('admin.access.index')
            ->with('message', 'Заявка отклонена и уведомление отправлено')
            ->with('type', 'success');
    }

    public function approve($id)
    {
        $access = Access::findOrFail($id);
        if ($access->status != 'pending') {
            return back();
        }
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
        if ($access->status != 'pending') {
            return back();
        }
        // Send approval email with login and password
        try {
            Log::info('Attempting to send approval email to: ' . $access->email);

            $emailContent = view('emails.access_approve', [
                'title' => $request->title,
                'login' => $request->login,
                'password' => $request->password,
                'message' => $request->message,
                'company_name' => $access->company_name
            ])->render();

            Log::info('Email content rendered successfully');

            Mail::html($emailContent, function ($mail) use ($access, $request) {
                $mail->to($access->email)
                    ->subject($request->title);
            });

            Log::info('Email sent successfully to: ' . $access->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        $access->update(['status' => 'approved']);

        return redirect()->route('admin.access.index')
            ->with('message', 'Заявка одобрена и данные отправлены')
            ->with('type', 'success');
    }
}
