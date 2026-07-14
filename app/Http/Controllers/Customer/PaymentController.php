<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function create(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        abort_if($order->status !== 'waiting_payment', 403);
        abort_if($order->payment !== null, 403);

        $order->load('package');

        return view('customer.payments.create', compact('order'));
    }

    public function store(Request $request, Order $order): RedirectResponse
    {
        abort_if($order->user_id !== auth()->id(), 403);
        abort_if($order->status !== 'waiting_payment', 403);
        abort_if($order->payment !== null, 403);

        $validated = $request->validate([
            'proof_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $proofPath = $request->file('proof_image')->store('payments', 'public');

        Payment::create([
            'order_id' => $order->id,
            'proof_image' => $proofPath,
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu verifikasi admin.');
    }
}
