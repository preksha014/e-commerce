<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Display the Profile Information page
    public function profile()
    {
        try {
            $customer = auth()->guard('customer')->user();
            if (!$customer) {
                return redirect()->route('login')->with('error', 'Please login to access your account.');
            }

            $customer->load(['address']);
            return view('user.profile-information', compact('customer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching profile data.');
        }
    }

    // Assuming this is in your controller class
    public function orders()
    {
        try {
            $customer = auth()->guard('customer')->user();
            if (!$customer) {
                return redirect()->route('login')->with('error', 'Please login to access your account.');
            }

            $orders = $customer->orders()->with('shippingAddress')->paginate(5);
    
            return view('user.order-history', compact('orders'));
    
        } catch (\Exception $e) {
            \Log::error('Failed to fetch order history: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching order history: ' . $e->getMessage());
        }
    }

    // Display the Edit Profile form
    public function editProfile()
    {
        try {
            $customer = auth()->guard('customer')->user();
            if (!$customer) {
                return redirect()->route('login')->with('error', 'Please login to access your account.');
            }

            $customer->load(['address']);
            return view('user.profile-edit', compact('customer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the edit form.');
        }
    }

    // Update the Customer Profile
    public function updateProfile(Request $request)
    {
        try {
            $customer = auth()->guard('customer')->user();
            if (!$customer) {
                return redirect()->route('login')->with('error', 'Please login to access your account.');
            }

            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
                'street' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'zipcode' => 'nullable|string|max:10',
            ]);

            // Update customer details
            $customer->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update address
            if ($request->filled(['street', 'city', 'zipcode'])) {
                $address = $customer->address()->first();
                if ($address) {
                    $address->update([
                        'street' => $validated['street'],
                        'city' => $validated['city'],
                        'zipcode' => $validated['zipcode'],
                    ]);
                }
            }

            return redirect()->route('account.profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating your profile.');
        }
    }
}