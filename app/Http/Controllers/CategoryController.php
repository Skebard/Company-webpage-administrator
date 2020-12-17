<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct(){
        //check if user is logged in or not
        $this->middleware('auth');
    }

    public function AllCat(){
        //Eloquent
        //data ordered chronologically starting by the last
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(3);
        $trashCat = Category::onlyTrashed()->latest()->paginate(2);



        //Query builder
        //$categories = DB::table('categories')->latest()->get();
        //pagination
        // $categories = DB::table('categories')->latest()->paginate(5);
        //relation
        // $categories = DB::table('categories')
        //                 ->join('users','categories.user_id','users.id')
        //                 ->select('categories.*','users.name')
        //                 ->latest()->paginate(3);

        return view('admin.category.index',compact('categories','trashCat'));
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



    public function edit($id){
        //ELoquent
        //$categories = Category::find($id);
        //Query Builder
        $categories = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit',compact('categories'));
    }

    public function update(Request $request, $id){
        //ELoquent
        // $update = Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        //     ]);

        //Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);


            return Redirect()->route('all.category')->with('success','Category UPdated Successfully');
        }

    
    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfully');
    }

    public function restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restored Successfully');

    }

    public function pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');

    }




}
