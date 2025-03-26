<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPage;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pages=StaticPage::all();
        return view('dashboard.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
        $validated=$request->validate([
            'title'=>'required',
            'slug'=>'required',
            'content'=>'required',
            'status'=>'required'
        ]);

        StaticPage::create($validated);

        if($validated){
            return redirect()->route('admin.page')->with('success', 'Static page created successfully!');
        }else{
            return redirect()->back()->with('error', 'An error occurred while creating static page.');
        }
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating static block.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $slug)
    {
        //
        $page=StaticPage::where('slug',$slug)->first();
        return view('dashboard.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required'
            ]);

            StaticPage::where('slug', $slug)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'status' => $request->status
            ]);

            return redirect()->route('admin.page')->with('success', 'Static page updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating static page.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //
        try {
            StaticPage::where('slug', $slug)->delete();

            return redirect()->route('admin.page')->with('success', 'Static page deleted successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting static page.');
        }
    }
}
