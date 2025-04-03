<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = Order::with('customer')->paginate(4);

            // Count totals
            $totalProducts = Product::count();
            $totalOrders = Order::count();
            $totalCustomers = Customer::count();

            return view('dashboard.index', [
                'orders' => $orders,
                'totalProducts' => $totalProducts,
                'totalOrders' => $totalOrders,
                'totalCustomers' => $totalCustomers
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching dashboard data.');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function report()
    {
        try {
            $totalProducts = Product::count();
            $totalOrders = Order::count();
            $totalCustomers = Customer::count();
            return view('dashboard.reports', compact('totalProducts', 'totalOrders', 'totalCustomers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching reports.');
        }
    }
}
