<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contacts = Contact::latest()->paginate(10);
            return view('dashboard.contacts', compact('contacts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching contact submissions.');
        }
    }
}