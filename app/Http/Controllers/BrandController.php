<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Auth;

use Image;


class BrandController extends Controller
{
    //
    public function __construct()
    {
        //check if user is logged in or not
        $this->middleware('auth');
    }

    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $validateData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Bran longer than 4 characters',
                'brand_image.mimes' => 'TYpe',
            ]
        );

        $brand_image = $request->file('brand_image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location . $img_name;
        // $brand_image->move($up_location, $img_name);

        // Using intervention image
        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_gen);
        $last_img = 'image/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {

        $validateData = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Bran longer than 4 characters',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
        }


        return Redirect()->back()->with('success', 'Brand Updated Successfully');
    }

    public function  delete($id)
    {
        //Delete image from the system
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);

        //Delete brand from the DB
        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    //For multi Image methods

    public function multipic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }


    public function storeImg(Request $request)
    {

        $images = $request->file('image');
        foreach ($images as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('image/multi/' . $name_gen);
            $last_img = 'image/multi/' . $name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

    
    public function logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User logout');
    }
    

}
