<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admincontroller extends Controller
{   
    
    public function loginadmin(){
        return view('loginadmin');
    }

    
    public function dashboard(){
        return view('layouts.admin');
    }
    
}
