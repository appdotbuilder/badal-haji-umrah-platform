<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Order;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $featuredProviders = Provider::with('user')
            ->verified()
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        $stats = [
            'total_providers' => Provider::verified()->count(),
            'total_orders' => Order::completed()->count(),
            'average_rating' => Provider::verified()->avg('rating') ?? 0,
        ];

        return Inertia::render('welcome', [
            'featuredProviders' => $featuredProviders,
            'stats' => $stats,
        ]);
    }
}