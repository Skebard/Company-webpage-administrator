<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Image;
use Whoops\Exception\ErrorException;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::latest()->get();
        
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name'=> 'required',
            'image'=> 'required',
            'description' => 'required'
        ],
        [
            'name.required' => 'Please fill this field',
            'image.required' => 'Please fill this field',
            'description.required' => 'Please fill this field',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image_location = 'image/service/';
        $image->move($image_location,$name_gen);
        $imagePath = $image_location . $name_gen;
        Service::insert([
            'name'=>$request->name,
            'image'=>$imagePath,
            'description'=>$request->description,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Service Inserted Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image = $request->file('image');
        if($image){
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_location = 'image/service/';
            $image->move($image_location,$name_gen);
            unlink($request->old_image);
            $image_path = $image_location . $name_gen;
        }else{
            $image_path = $request->old_image;
        }
        Service::find($id)->update([
            'name'=> $request->name,
            'description'=>$request->description,
            'image' =>$image_path,
            'updated_at' =>Carbon::now(),
        ]);
            return Redirect('/services')->with('success','Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $service = Service::find($id);
        if(file_exists($service->image)){
            unlink($service->image);
        }
        Service::find($id)->delete();
        return Redirect()->back()->with('success','Service Deleted Successfully');
    }
}
