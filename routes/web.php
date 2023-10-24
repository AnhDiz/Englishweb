<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Typecontroller;
use App\Http\Controllers\Wordcontroller;


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
    return view('index');
});


// login-resigter
Route::get('/home',[Homecontroller::class ,'home'])->name('home');
Route::get('/login',[Usercontroller::class ,'login'])->name('login');
Route::post('/login',[Usercontroller::class ,'postlogin'])->name('postlogin');
Route::get('/register',[Usercontroller::class ,'register'])->name('register');//name để gọi qua route 
Route::post('/register',[Usercontroller::class ,'postregister']);
Route::get('/logout',[Usercontroller::class ,'logout'])->name('logout');
Route::get('/loginadmin',[Admincontroller::class ,'loginadmin'])->name('loginadmin')->middleware('admin.auth');

//retset-password 
Route::get('/forget-password',[Usercontroller::class ,'forgetpassword'])->name('forgetpassword');
Route::post('/forget-password',[Usercontroller::class ,'postforgetpassword']);//lấy dữ liệu từ from

Route::get('/get-password',[Usercontroller::class ,'getresetpassword'])->name('getresetpassword');//from pass mới
Route::post('/get-password',[Usercontroller::class ,'postresetpassword']);//xử lý from 

//điều hướng quan lý user
Route::get('/quanly', [UserController::class, 'quanlyuser'])->name('quanly');
Route::delete('/quanly/delete/{id}', [UserController::class, 'delete'])->name('quanly.delete');
Route::get('/quanly/edit/{id}', [UserController::class, 'edit'])->name('quanly.edit');
Route::put('/quanly/update/{id}', [UserController::class, 'update'])->name('quanly.update');

Route::get('quanly/add', [UserController::class, 'quanlyadd'])->name('quanly.add');
Route::post('quanly/store', [UserController::class, 'store'])->name('quanly.store');


Route::get('/now',[Usercontroller::class ,'now'])->name('now');




Route::group(['prefix' => 'admin'],function(){
    Route::get('/',[Admincontroller::class ,'dashboard'])->name('admin.dashboard');

    Route::resources([
        'type'=> Typecontroller::class,
        'word'=> Wordcontroller::class,
        'user'=> Usercontroller::class
    ]);
});


// Route::prefix('admin')->middleware('admin')->group(function(){
//     Route::get('/',[Admincontroller::class ,'admin'])->name('admin');

// });
