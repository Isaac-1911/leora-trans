<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|max:30',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        return back()->with('success', 'Your message has been sent.');
    }
}
