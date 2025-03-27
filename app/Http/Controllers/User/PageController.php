<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;

class PageController extends Controller
{
    //
    public function show(string $slug="terms-conditions"){
        $page = StaticPage::where('slug', $slug)->where('status', StaticPage::ACTIVE_STATUS)->first();
        if(!$page){
            abort(404);
        }
        return view('user.terms-conditions',compact('page'));
    }
}
