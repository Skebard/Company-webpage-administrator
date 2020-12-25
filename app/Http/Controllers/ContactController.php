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


    public function editContact($id){
        $contact = Contact::find($id);
        return view('admin.contact.edit',compact('contact'));

    }
    public function updateContact(Request $request, $id){
        Contact::find($id)->update([
            'address' =>$request->address,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'updated_at' =>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Contact Updated Successfully');
    }
    public function deleteContact($id){
        Contact::find($id)->delete();
        return Redirect()->back()->with('success','Contact Deleted Successfully');
        
    }
}
