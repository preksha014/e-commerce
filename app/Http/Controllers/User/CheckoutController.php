<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Payment;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function address_create()
    {
        //
        $customer = Customer::find(auth()->user()->id);

        return view('user.checkout-address', compact('customer'));
    }

    public function address_store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|numeric',
            'recipient_name' => 'required|string|max:255',
        ]);

        // Get the authenticated customer
        $customer = auth()->user(); // Ensure user is logged in

        // Store address in the database
        Address::create([
            'customer_id' => $customer->id,
            'name' => $request->name,
            'email' => $request->email,
            'street' => $request->street,
            'city' => $request->city,
            'zipcode' => $request->zipcode, // Include 'zipcode'
            'recipient_name' => $request->recipient_name, // Ensure recipient_name is inserted
            'commentary' => $request->commentary,
        ]);

        // Redirect to the checkout-payment page
        return redirect('/checkout-payment')->with('success', 'Address saved successfully.');
    }

    public function payment_create()
    {
        $customer = Customer::find(auth()->user()->id);
        return view('user.checkout-payment', compact('customer'));
    }

    // public function payment_store(Request $request)
    // {
    //     // Validate input data
    //     $request->validate([
    //         'payment_method' => 'required|in:paypal,cod,upi',
    //     ]);

    //     // Store payment in the database
    //     Payment::create([
    //         'payment_method' => $request->payment_method,
    //     ]);

    //     // Redirect to the checkout-review page
    //     return redirect('/checkout-review')->with('success', 'Payment saved successfully.');
    // }

    public function review()
    {
        $cart = session('cart');
        $cart_total = session('cart_total', 0);
        $cart_count = session('cart_count', 0);

        $customer = Customer::find(auth()->user()->id);
        return view('user.checkout-review', compact('customer', 'cart', 'cart_total', 'cart_count'));
    }
    public function confirmation()
    {
        $customer = Customer::find(auth()->user()->id);
        return view('user.checkout-confirmation', compact('customer'));
    }
}
