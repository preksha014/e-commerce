<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticBlock;
use Illuminate\Support\Str;

class StaticBlockController extends Controller
{
    /**
     * Display a listing of the resource.i
     */
    public function index()
    {
        $data = StaticBlock::all();
        return view('dashboard.blocks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required'
            ]);

            StaticBlock::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status
            ]);

            return redirect()->route('admin.block')->with('success', 'Static block created successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating static block.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $slug)
    {
        $data = StaticBlock::where('slug', $slug)->first();
        return view('dashboard.blocks.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required'
            ]);

            StaticBlock::where('slug', $slug)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status
            ]);

            return redirect()->route('admin.block')->with('success', 'Static block updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating static block.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            StaticBlock::where('slug', $slug)->delete();

            return redirect()->route('admin.block')->with('success', 'Static block deleted successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting static block.');
        }
    }
}
