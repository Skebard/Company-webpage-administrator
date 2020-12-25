<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function __construct(){
        //check if user is logged in or not
        $this->middleware('auth');
    }

    //
    public function index(){
        return view('contact');
    }


    public function adminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function addContact(){
        return view('admin.contact.create');
    }
    public function storeContact(Request $request){
        $validateData = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ],
        [
        'address.required' => 'required',
        'email.required' => 'required',
        'phone.required' => 'required',]);

        Contact::insert([
            'address' =>$request->address,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'created_at' =>Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success','Contact Inserted Successfully');
    }
}
