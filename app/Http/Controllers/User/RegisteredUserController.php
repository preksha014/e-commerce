<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Events\UserRegistered;

class RegisteredUserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        try {
            $attributes = $request->validated();

            // Hash the password before saving
            $attributes['password'] = bcrypt($attributes['password']);

            // Create the customer
            $customer = Customer::create($attributes);

            // Log in the customer
            Auth::guard('customer')->login($customer);

            event(new UserRegistered($customer));
            
            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while registering.');
        }
    }
}
