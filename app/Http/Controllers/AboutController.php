<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    //
    public function homeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }

    public function addAbout()
    {
        return view('admin.home.create');
    }

    public function storeAbout(Request $request)
    {
        $validateData = $request->validate(
            [
                'title' => 'required',
                'short_description' => 'required',
                'long_description' => 'required',
            ],
            [
                'title.required' => 'This field can not be empty.',
                'short_description.required' => 'This field can not be empty.',
                'long_description.required' => 'This field can not be empty.',
            ]
        );

        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success', 'About inserted successfully');
    }

    public function editAbout($id){
        $homeAbout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeAbout'));
    }
    public function updateAbout(Request $request, $id){

        $validateData = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ],
        [
            'title.required' => 'This field can not be empty.',
            'short_description.required' => 'This field can not be empty.',
            'long_description.required' => 'This field can not be empty.',
        ]);
        HomeAbout::find($id)->update([
            'title' =>$request->title,
            'short_description'=> $request->short_description,
            'long_description' => $request->long_description,
        ]);

        return Redirect()->route('home.about')->with('success','About updated successfully');
    }


    public function deleteAbout($id){
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','About Deleted Successfully');
    }
}
