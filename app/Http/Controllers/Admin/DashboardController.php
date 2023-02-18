<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $product = Product::all();
        $users = DB::table('users')->get();
        $deliveries = DB::table('deliveries')->get();
        $cancellations = DB::table('cancellations')->get();
        $countOrders = DB::table('orders')->count();
        $countUsers = DB::table('users')->count();
        $countProduct = DB::table('products')->count();


        return view('admin.index', compact(
            'categories',
            'countProduct',
            'countUsers', 'deliveries', 'cancellations', 'countOrders'));
    }


}
