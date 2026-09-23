<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $builds = Auth::user()
            ->builds()
            ->withCount('products')
            ->latest()
            ->get();

        return view('dashboard.index', compact('builds'));
    }
}
