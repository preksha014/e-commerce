<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $products = Product::paginate(1);
        $orders = Order::with('customer')->paginate(2);

        // Count totals
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = Customer::count(); // Adjust model name if needed

        return view('dashboard.index', [
            'products' => $products,
            'orders' => $orders,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function report()
    {
        //
        
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        
        return view('dashboard.reports', compact('totalProducts', 'totalOrders', 'totalCustomers'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
