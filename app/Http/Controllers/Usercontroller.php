<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\Admincontroller;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
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
            
        }
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');

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
                session(['role' => 0]);
                $successMessage = 'Đăng nhập thành công';
                $redirectRoute = 'home';
            } elseif (Auth::attempt($credentialsadmin)) {
                session(['role' => 1]);
                $successMessage = 'Đăng nhập thành công';
                $redirectRoute = 'loginadmin';
            } else {
                return redirect()->back()->with('error', 'Đăng nhập không thành công');
            }
            
            if (isset($successMessage) && isset($redirectRoute)) {
                return redirect()->back()->with('success', $successMessage)->with('redirectRoute', $redirectRoute);
            }
        }

    
    public function logout(){
        Auth::logout();
        session()->forget('role');
        return redirect()->back();
    }

    public function now(){
        return view('now');
    }
    //lấy lại passwword 
    public function forgetpassword(){
        return view('emails.forgetpassword');
    }
    
    public function postforgetpassword(Request $request){
    //    dd($request->all());
       $email = $request->email;
       $checkuser=User::where ('email', $email)->first();

       if(!$checkuser){
        return redirect()->back()->with('error', 'Email không tồn tại');
       }
       //mã hóa và tạo thành mã 
       $link=bcrypt(md5(time().$email));
       $checkuser->link= $link;

       $checkuser->time_link=Carbon::now();//lưa thời gian yêu cầu 
       $checkuser->save();


    //     $data = [
    //     'data'=> 1234
    //    ];
    //     Mail::to($email)->send(new SendEmail($data)); dd(1);

    $url = route('getresetpassword', ['link' => $checkuser->link, 'email' => $email]);

    $data = [
        'route' => $url
    ];
    
    Mail::send('emails.email', $data, function ($message) use ($email) {
        $message->to($email)
                ->subject('Lấy lại mật khẩu');
               
    });

        return redirect()->back()->with('success','link lấy lại mật khẩu đã được gửi tới Email của bạn');



    }

    public function getresetpassword(Request $request){
        $link=$request->link;
        $email=$request->email;

        //lấy giá trị bẩng user ra để so sánh
        $checkuser= User::where([
            'link'=>$link,
            'email'=>$email
        ])->first();


        if(!$checkuser){
            return redirect('/')->with('đương dẫn lấy lại mật khâu không đúng ');
        }
        return view('emails.getresetpassword');
    }


    public function postresetpassword(Request $resetpassword){
        if($resetpassword->password){
            $link=$resetpassword->link;
            $email=$resetpassword->email;

        //lấy giá trị bẩng user ra để so sánh
        $checkuser= User::where([
            'link'=>$link,
            'email'=>$email
        ])->first();

        }
        if(!$checkuser){
            return redirect('/')->with('đương dẫn lấy lại mật khâu không đúng ');
        }
        $checkuser->password=bcrypt($resetpassword->password);

        $checkuser->save();

        return redirect()->route('login')->with('Đổi mật khẩu thành công  ');
    }
    
}
