<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('role')->paginate(5);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'status' => 'required|in:active,inactive',
            'role' => 'required|exists:roles,id',
        ]);

        try {
            // Create new admin
            $admin = new Admin();
            $admin->name = $validated['name'];
            $admin->email = $validated['email'];
            $admin->status = $validated['status'];
            $admin->role_id = $validated['role'];
            // Generate a default password (you might want to modify this)
            $admin->password = Hash::make('default_password'); // Consider sending this via email
            $admin->save();

            return redirect()->route('admin.admins.index')
                ->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create admin: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
                'status' => 'required|in:active,inactive',
                'role' => 'required|exists:roles,id',
            ]);

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'role_id' => $request->role,
            ]);

            return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update admin: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete admin: ' . $e->getMessage());
        }
    }
}
