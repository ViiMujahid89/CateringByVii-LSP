<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = auth()->user();

        $activeOrders = Order::where('user_id', $user->id)
            ->with('package')
            ->whereNotIn('status', ['completed', 'rejected'])
            ->latest()
            ->get();

        $orderHistory = Order::where('user_id', $user->id)
            ->with('package')
            ->whereIn('status', ['completed', 'rejected'])
            ->latest()
            ->get();

        return view('customer.profile', compact('user', 'activeOrders', 'orderHistory'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
