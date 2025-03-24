<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('user.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        try {
            $attributes = $request->validated();

            if (!Auth::guard('customer')->attempt($attributes)) {
                throw ValidationException::withMessages([
                    'email' => 'Sorry, those credentials do not match.',
                ]);
            }

            request()->session()->regenerate();

            return redirect('/');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'An error occurred while logging in.');
        }
    }
}