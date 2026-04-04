<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Basic Stats
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $newCustomers = \App\Models\User::where('type', '!=', 'admin')->where('created_at', '>=', now()->subMonth())->count();
        $weeklyOrders = \App\Models\Order::where('created_at', '>=', now()->subWeek())->count();

        // 2. Growth Calculation (Current vs Previous Month)
        $currentMonthRevenue = \App\Models\Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total_amount');
        $lastMonthRevenue = \App\Models\Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->sum('total_amount');
        
        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;

        // 3. Inventory/Categories Data
        $categoriesStats = \App\Models\Category::withCount('products')->get();

        // 4. Chart Data (Monthly Revenue)
        $months = [];
        $revenueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            $revenueData[] = \App\Models\Order::where('status', '!=', 'cancelled')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_amount');
        }

        // 5. Recent Orders
        $recentOrders = \App\Models\Order::latest()->take(5)->get();

        return view('home', compact(
            'totalOrders', 
            'totalRevenue', 
            'newCustomers', 
            'weeklyOrders', 
            'revenueGrowth', 
            'categoriesStats', 
            'months', 
            'revenueData',
            'recentOrders'
        ));
    }
}
