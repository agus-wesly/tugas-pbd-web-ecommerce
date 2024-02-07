<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index() {
        $orders = Order::all();

        return Inertia::render('Dashboard', [
            'orders' => $orders
        ]);

    }

    public function productList() {
        $products = Product::orderBy('created_at', 'asc')->get();

        return Inertia::render('DashboardProduct', [
            'products' => $products,
        ]);

    }
}
