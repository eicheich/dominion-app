<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('is_admin', 0)->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        $recentOrders = Order::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'pendingOrders',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    public function users()
    {
        $users = User::where('is_admin', 0)->paginate(10);
        return view('admin.users.index', compact('users'));
    }
}
