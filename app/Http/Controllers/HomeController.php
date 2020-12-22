<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    //

    public function homeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function addSlider()
    {
        return view('admin.slider.create');
    }
    public function storeSlider(Request $request)
    {
        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1080)->save('image/slider/' . $name_gen);
        $last_img = 'image/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
    }
    public function deleteSlider($id)
    {
        //delete image from the system
        $slider = Slider::find($id);
        $old_image = $slider->image;
        unlink($old_image);

        //delete slider from the DB
        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider deleted successfully');
    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function updateSlider(Request $request, $id)
    {
        //validation
        $validateData = $request->validate(
            [
                'title' => 'required|min:6',
                'description' => 'required|min:20',
            ],
            [
                'title.required' => 'Please Input Title',
                'description.required' => 'Please Input Description',
                'description.min' => 'Please Description must contain at least 20 characters',
            ]
        );

        $slider_image = $request->file('image');
        if ($slider_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($slider_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location . $img_name;
            $slider_image->move($up_location, $img_name);
            unlink($request->old_image);
            $updatedImg = $last_img;
        }else{
            $updatedImg = $request->old_image;
        }

        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $updatedImg,
            'updated_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Slider Updated Successfully');
    }
}
