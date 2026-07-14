<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserVerificationController extends Controller
{
    /**
     * Display list of pelanggan accounts pending/all.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');

        $users = User::where('role', 'pelanggan')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users', 'status'));
    }

    /**
     * Approve or reject a user's account.
     */
    public function verify(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'in:approved,rejected'],
        ]);

        $user->update(['status' => $validated['action']]);

        $label = $validated['action'] === 'approved' ? 'disetujui' : 'ditolak';

        return back()->with('success', "Akun {$user->name} berhasil {$label}.");
    }
}
