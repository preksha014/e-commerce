<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = Customer::paginate(4);
            return view('dashboard.customers', compact('customers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching customers.');
        }
    }
}
