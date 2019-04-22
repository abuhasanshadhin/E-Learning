<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserContactReplyMail;
use Brian2694\Toastr\Facades\Toastr;

class ContactsController extends Controller
{
    public function index()
    {
        return view('admin.contact.contacts', [
            'contacts' => Contact::latest()->get()
        ]);
    }

    public function contactMessageReplyForm($id)
    {
        $contact = Contact::find($id);
        $contact->status = 'seen';
        $contact->save();
        return view('admin.contact.reply', [
            'contact' => Contact::find($id)
        ]);
    }

    public function contactMessageReply(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'reply' => 'required'
        ]);
        
        Mail::to($request->email)->send(new UserContactReplyMail($request));

        Toastr::success('Reply Send Successfully', 'Message');
        return redirect()->route('admin.contacts');
    }

    public function contactMessageDelete(Request $request)
    {
        Contact::find($request->id)->delete();
        Toastr::success('Contact Message Deleted Successfully', 'Message');
        return redirect()->route('admin.contacts');
    }

    public function pendingContactMessages()
    {
        return Contact::where('status', 'pending')->count();
    }
}
