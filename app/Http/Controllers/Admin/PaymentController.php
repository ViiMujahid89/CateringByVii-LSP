<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display list of payments for verification.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');

        $payments = Payment::with(['order.user', 'order.package', 'verifiedBy'])
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('admin.payments.index', compact('payments', 'status'));
    }

    /**
     * Show a specific payment detail.
     */
    public function show(Payment $payment): View
    {
        $payment->load(['order.user', 'order.package', 'verifiedBy']);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Approve or reject a payment.
     */
    public function verify(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'in:approved,rejected'],
        ]);

        $payment->update([
            'status' => $validated['action'],
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        // Update order status accordingly
        if ($validated['action'] === 'approved') {
            $payment->order->update(['status' => 'completed']);
        } else {
            $payment->order->update(['status' => 'waiting_payment']);
        }

        $label = $validated['action'] === 'approved' ? 'disetujui' : 'ditolak';

        return back()->with('success', "Pembayaran untuk pesanan #{$payment->order_id} berhasil {$label}.");
    }
}
