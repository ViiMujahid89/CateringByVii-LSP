<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Order;
use App\Models\Package;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $recentOrders = Order::where('user_id', $user->id)
            ->with('package')
            ->latest()
            ->limit(5)
            ->get();

        $latestAnnouncements = Announcement::latest()->limit(3)->get();

        $featuredPackages = Package::active()->oldest()->get();

        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'active_orders' => Order::where('user_id', $user->id)->whereNotIn('status', ['completed', 'rejected'])->count(),
            'completed_orders' => Order::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('customer.dashboard', compact('recentOrders', 'latestAnnouncements', 'featuredPackages', 'stats'));
    }
}
