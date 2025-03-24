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
        //
        $data=StaticBlock::all();
        return view('dashboard.blocks.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('dashboard.blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'status'=>'required'
        ]);

        $data=StaticBlock::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'content'=>$request->content,
            'status'=>$request->status
        ]);

        if($data){
            return redirect()->route('admin.block')->with('success','Static block created successfully');
        }else{      
            return back()->with('error','Something went wrong, Please try again');
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
    public function edit(Request $request, string $slug)
    {
        //
        $data=StaticBlock::where('slug',$slug)->first();
        return view('dashboard.blocks.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'status'=>'required'
        ]);

        $data=StaticBlock::where('slug',$slug)->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'content'=>$request->content,
            'status'=>$request->status
        ]);

        if($data){
            return redirect()->route('admin.block')->with('success','Static block updated successfully');
        }else{
            return back()->with('error','Something went wrong, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //
        $data=StaticBlock::where('slug',$slug)->delete();
        if($data){
            return redirect()->route('admin.block')->with('success','Static block deleted successfully');
        }else{
            return back()->with('error','Something went wrong, Please try again');
        }
    }
}
