<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('package')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function create(Package $package): View
    {
        abort_if(! $package->is_active, 404);

        return view('customer.orders.create', compact('package'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'event_date' => ['required', 'date', 'after:today'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $package = Package::findOrFail($validated['package_id']);
        $totalPrice = $package->price * $validated['quantity'];

        $order = Order::create([
            'user_id' => auth()->id(),
            'package_id' => $validated['package_id'],
            'quantity' => $validated['quantity'],
            'event_date' => $validated['event_date'],
            'delivery_address' => $validated['delivery_address'],
            'notes' => $validated['notes'] ?? null,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Menunggu verifikasi admin.');
    }

    public function show(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $order->load(['package', 'payment']);

        return view('customer.orders.show', compact('order'));
    }
}
