<?php

namespace Modules\Auth\Http\Controllers ;

use App\Auth\Mail\Warning;
use App\Auth\Models\PasswordResets;
use App\Auth\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function forgot(){
        view()->addNamespace('login_view', app_path('Auth/Views'));
        return view('login_view::forgot') ;
    }
    public function validateEmail($email){
        $check=filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        return $check;
    }
    function makeToken($string){
        $token=bcrypt($string);
        $token=str_replace('/','A',$token);
        $token=str_replace('.','N',$token);
        return $token;
    }
    public function sendResetLinkEmail(Request $request){
        if ($this->validateEmail($request->email)==false){
            return redirect()->route('forgot')->with('errors','Email không đúng định dạng: abc@gmail.com !');
        }
        $checkEmailDb=User::where('email',$request->email)->first();
        if ($checkEmailDb==null){
            return redirect()->route('forgot')->with('errors','Email không tồn tại trong hệ thống !');
        }
        $email=$request->email;
        $token=$this->makeToken($email);
        $url=route('password.reset',[$email,$token]);
        $warning['sender']='Agrimedia';
        $warning['email']=$email;
        $warning['name']=$checkEmailDb['name'];
        $warning['url']=$url;
        //gửi mail
        Mail::to($email)->send(new Warning($warning));
        //tạo log
        $password_resets['email']=$email;
        $password_resets['token']=$token;
        $password_resets['created_at']=date('Y-m-d H:i:s');
        $createPwRs=PasswordResets::where('email',$email)->updateOrCreate($password_resets);
        if ($createPwRs){
            return redirect()->route('forgot')->with('success','Chúng tôi đã gửi link khôi phục mật khẩu đến Email của bạn !');
        }else{
            return redirect()->route('forgot')->with('errors','Gửi Email lỗi!');
        }
    }

}
