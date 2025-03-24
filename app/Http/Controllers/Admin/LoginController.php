<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        try {
            $attributes = $request->validated();

            if (!Auth::guard("admin")->attempt($attributes)) {
                throw ValidationException::withMessages([
                    'email' => 'Sorry, those credentials do not match.',
                ]);
            }

            request()->session()->regenerate();

            return redirect('admin/dashboard');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'An error occurred while logging in.');
        }
    }

    public function logout()
    {
        try {
            Auth::guard("admin")->logout();
            return redirect('admin/login');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while logging out.');
        }
    }
}
