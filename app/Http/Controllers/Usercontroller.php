<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Admincontroller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    //
    public function login(){
        return view('login');
    }
    
    public function register(){
        return view('register');
    }

    public function postregister(Request $request){
   

        // mã hóa pass
        //dd(Hash::make($request->password));
        
        
        $request->merge(['password' =>Hash::make($request->password) ]);
        try {
            User::create($request->all());
        }
        catch(\Throwable $th)
        {   

            dd($th);
            // return redirect()->route('login');
        }
        return redirect()->route('login');

    }



    public function postlogin(Request $request)
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'role'=>0
            ];
            $credentialsadmin = [
                'email' => $request->email,
                'password' => $request->password,
                'role'=>1
            ];

            if (Auth::attempt($credentials)) {

                return redirect()->route('home');

            }elseif(Auth::attempt($credentialsadmin)){
                return redirect()->route('admin');
            } 
           
            else {
                return redirect()->back()->with('error', 'Sai thông tin tài khoản');
            }
        }

    
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
}
