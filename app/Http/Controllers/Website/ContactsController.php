<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        return view('website.contact.contact');
    }

    public function sendContactMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|max:15',
            'message' => 'required'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('message', 'Message send successfully');
    }
}
