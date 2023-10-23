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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $credentials = [
            'email' => $request->email,
            'role' => 0
        ];
    
        $credentialsadmin = [
            'email' => $request->email,
            'role' => 1
        ];
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại.');
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($user->role === 0) {
                session(['role' => 0]);
                $successMessage = 'Đăng nhập thành công';
                $redirectRoute = 'home';
            } elseif ($user->role === 1) {
                session(['role' => 1]);
                $successMessage = 'Đăng nhập thành công';
                $redirectRoute = 'loginadmin';
            }
        } else {
            // Kiểm tra mật khẩu không hợp lệ
            return redirect()->back()->with('error', 'Mật khẩu không đúng.');
        }
    
        if (isset($successMessage) && isset($redirectRoute)) {
            return redirect()->route($redirectRoute)->with('success', $successMessage);
        }
    
        return redirect()->back()->with('error', 'Đăng nhập không thành công');
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
    //quản lý 
            public function quanlyuser(){
                $quanlyuser = User::paginate();
                return view('quanly',compact('quanlyuser'))->with('i',(request()->input('page',1)-1)*5);


            }

            public function delete($id)
            {
                // Tìm và xóa người dùng có ID tương ứng
                User::where('id', $id)->delete();
            
                return redirect()->back()->with('success', 'Xóa thành công.');
            }
            
            public function edit($id)
            {
                // Tìm người dùng có ID tương ứng để hiển thị trang chỉnh sửa
                $user = User::find($id);
                
                if (!$user) {
                    return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
                }
            
                return view('edit', compact('user'));
            }
            
            public function update(Request $request, $id)
            {
                // Xác thực dữ liệu từ form
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,'.$id,
                    'password' => 'nullable|string|min:6',
                    // 'phone' => 'nullable|string|max:15',
                    'role' => 'required|integer' // Thêm xác thực cho cột 'role'
                ]);
            
                // Tìm người dùng cần cập nhật
                $user = User::find($id);
            
                if (!$user) {
                    return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
                }
            
                // Cập nhật thông tin người dùng
                $user->name = $validatedData['name'];
                $user->email = $validatedData['email'];
                $user->role = $validatedData['role']; 
                // Kiểm tra xem có cập nhật mật khẩu không
                if (!empty($validatedData['password'])) {
                    $user->password = Hash::make($validatedData['password']);
                }
                // $user->phone = $validatedData['phone'];
            
                // Lưu cập nhật vào cơ sở dữ liệu
                $user->save();
            
                return redirect()->route('quanly')->with('success', 'Cập nhật thông tin người dùng thành công.');
            }
            
            //add quan lý 
            public function quanlyadd(){
                return view('add');
            }

            public function store(Request $request)
                {
                    $validatedData = $request->validate([
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required|string|min:6',
                        'role' => 'required|in:0,1', // Kiểm tra role phải là 0 hoặc 1
                    ]);

                    $user = new User();
                    $user->name = $validatedData['name'];
                    $user->email = $validatedData['email'];
                    $user->password = Hash::make($validatedData['password']);
                    $user->role = $validatedData['role'];
                    $user->save();

                    return redirect()->route('quanly')->with('success', 'Thêm tài khoản thành công.');
                }

    
}
