<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display list of orders for admin.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');

        $orders = Order::with(['user', 'package', 'payment'])
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    /**
     * Show a specific order detail.
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'package', 'payment.verifiedBy']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Approve or reject an order.
     */
    public function verify(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'in:approved,rejected'],
        ]);

        $newStatus = $validated['action'] === 'approved' ? 'waiting_payment' : 'rejected';
        $order->update(['status' => $newStatus]);

        $label = $validated['action'] === 'approved' ? 'disetujui' : 'ditolak';

        return back()->with('success', "Pesanan #{$order->id} berhasil {$label}.");
    }
}
