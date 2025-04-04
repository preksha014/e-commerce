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
        try {
            $orders = Order::with('customer')->paginate(10);

            $customer = $orders->map(function ($order) {
                return $order->customer;
            });

            return view('dashboard.order.index', compact('orders', 'customer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching orders.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching order details.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,delivered,cancelled',
            ]);

            $order->update(['status' => $request->status]);

            return redirect()->route('admin.orders')->with('success', 'Order status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating order status.');
        }
    }
}
