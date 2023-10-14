<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Admincontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {   
    return view('welcome');
});


Route::get('/home',[Homecontroller::class ,'home'])->name('home');

// Route::get('/', [Homecontroller:: class,'index'])->name('index');

Route::get('/login',[Usercontroller::class ,'login'])->name('login');
Route::post('/login',[Usercontroller::class ,'postlogin']);

Route::get('/register',[Usercontroller::class ,'register'])->name('register');//name để gọi qua route 
Route::post('/register',[Usercontroller::class ,'postregister']);


Route::get('/loginadmin',[Admincontroller::class ,'loginadmin'])->name('loginadmin');
Route::get('/',[Admincontroller::class ,'admin'])->name('admin');
//Route::get('/loginadmin',[Admincontroller::class ,'loginadmin'])->name('loginadmin');

// Route::prefix('admin')->middleware('admin')->group(function(){
//     Route::get('/',[Admincontroller::class ,'admin'])->name('admin');

// });