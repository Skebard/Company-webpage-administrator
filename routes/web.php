<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $services = DB::table('services')->get();
    $pics =DB::table('multipics')->get();
    return view('home',compact('brands','abouts','services','pics'));
});
Route::get('/home', function () {
    echo 'This is Home page';
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact',[ContactController::class,'index'])->name('con');


//Category controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');



Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::post('/category/update/{id}',[CategoryController::class,'update']);

Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class,'pdelete']);


//For brand route
Route::get('/brand/all',[BrandController::class,'allBrand'])->name('all.brand');

Route::post('/brand/add',[BrandController::class,'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'edit']);
Route::post('/brand/update/{id}',[BrandController::class,'update']);
Route::get('/brand/delete/{id}',[BrandController::class,'delete']);


//Multi Image Route

Route::get('/multi/image',[BrandController::class,'multipic'])->name('multi.image');

Route::post('/multi/add',[BrandController::class,'storeImg'])->name('store.image');


// Admin all route

Route::get('/home/slider',[HomeController::class,'homeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class,'addSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class,'storeSlider'])->name('store.slider');
Route::get('/slider/delete/{id}',[HomeController::class,'deleteSlider']);
Route::get('/slider/edit/{id}',[HomeController::class,'editSlider']);
Route::post('/slider/update/{id}',[HomeController::class,'updateSlider']);


// Home About All Route
Route::get('/home/About',[AboutController::class,'homeAbout'])->name('home.about');
Route::get('/add/About',[AboutController::class,'addAbout'])->name('add.about');
Route::post('/store/About',[AboutController::class,'storeAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'editAbout']);
Route::post('/about/update/{id}',[AboutController::class,'updateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'deleteAbout']);


//Portfolio pages Route
Route::resource('portfolio',PortfolioController::class);



//Services

Route::resource('services',ServiceController::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //Eloquent
    // $users = User::all();

    //Query builder
    // $users = DB::table('users')->get();

    //return view('dashboard',compact('users'));
    return view('admin.index');

})->name('dashboard');

Route::get('/user/logout',[BrandController::class,'logout'])->name('user.logout');


