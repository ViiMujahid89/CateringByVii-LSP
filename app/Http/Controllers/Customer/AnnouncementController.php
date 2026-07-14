<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with('createdBy')->latest()->paginate(9);

        return view('customer.announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement): View
    {
        return view('customer.announcements.show', compact('announcement'));
    }
}
