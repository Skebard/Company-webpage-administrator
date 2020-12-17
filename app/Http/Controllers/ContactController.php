<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
