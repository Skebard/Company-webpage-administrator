<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
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

Route::get('/', function () {
    return view('welcome');
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



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //Eloquent
    // $users = User::all();

    //Query builder
    $users = DB::table('users')->get();

    return view('dashboard',compact('users'));
})->name('dashboard');


