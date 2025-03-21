<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::all();

        $customer = $orders->map(function ($order) {
            return $order->customer;
        });


        // dd($orders);
        // dd($customer);
        return view('dashboard.order.index', compact('orders', 'customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Order $order)
    {
        $order->load('customer', 'order_items');

        $products = $order->order_items->map(function ($item) {
            return $item->product;
        });
        return view('dashboard.order.show', [
            'order' => $order,
            'customer' => $order->customer,
            'orderItems' => $order->order_items,
            'products' => $products
        ]);
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
