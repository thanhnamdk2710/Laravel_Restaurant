<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contact;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        Toastr::success('Deleted contact message successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
