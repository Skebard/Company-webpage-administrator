<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
        //Eloquent
        //data ordered chronologically starting by the last
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(3);
        
        //Query builder
        //$categories = DB::table('categories')->latest()->get();
        //pagination
        // $categories = DB::table('categories')->latest()->paginate(5);

        return view('admin.category.index',compact('categories'));
    }

    public function AddCat(Request $request){
        $validateData = $request->validate([
            'category_name'=>'required|unique:categories|min:5|max:255',
        ],
        [
            'category_name.required'=>'Please Input Category Name',
            'category_name.max'=>'Category Less than 255 characters',

        ]);
        //If the validation successes the following code will be executed
        //if not then it will redirect to the page that generated the request

        //Eloquent
        // Category::insert([
        //     'category_name' =>$request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at'=> Carbon::now()
        // ]);

        // $category = new Category;
        // $category->category_name =$request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();
        //created and updated dates automatically created


        //Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);


        //after the data is inserted
        return Redirect()->back()->with('success','Category Inserted Successfully');
    }
}
