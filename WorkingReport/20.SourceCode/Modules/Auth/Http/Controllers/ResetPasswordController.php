<?php

namespace Modules\Auth\Http\Controllers ;

use App\Auth\Models\PasswordResets;
use App\Auth\Models\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

//    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function checkPass($string){
        $regex='/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,190}$/';
        if (!preg_match($regex, $string) ){
            return false;
        }else{
            return true;
        }
    }
    public function checkRspwDb($email,$token){
        //lấy thông tin khôi phục mật khẩu từ db
        $getRspwDb=PasswordResets::where('email',$email)->where('token',$token)->first();
        if ($getRspwDb==null){
            return null;

        }else{
            return $getRspwDb;
        }
    }
    public function index($email,$token)
    {
        $getRspwDb=$this->checkRspwDb($email,$token);

        if ($getRspwDb==null){
            return redirect()->route('forgot')->with('errors','Link khôi phục mật khẩu sai hoặc đã hết hạn,
            vui lòng gửi lại yêu cầu đổi mật khẩu !');
        }else{

            view()->addNamespace('login_view', app_path('Auth/Views'));
            return view('login_view::resetpw') ;
        }

    }
    public function resetPassword(Request $request,$email,$token){
        $input=$request->all();
        $url=route('password.reset',[$email,$token]);
//        dd($input,$email,$token);
        $password=$request->password;
        $re_password=$input['re-password'];
        if ($this->checkPass($password)==false){
            return back()->with('errors','Mật khẩu trong khoảng từ 8 đến 30 ký tự, bao gồm chữ và số !');
        }
        if ($password != $re_password){
            return back()->with('errors','Mật khẩu và xác nhận mật khẩu phải trùng nhau !');

        }
        //lấy thông tin khôi phục mật khẩu từ db
        $getRspwDb=$this->checkRspwDb($email,$token);
        if ($getRspwDb==null){
            return back()->with('errors','Không có yêu cầu khôi phục mật khẩu nào trùng với thông tin của bạn !');

        }
        //kiểm tra hiệu lực 1h
//        $current_date=date('Y-m-d H:i:s');
//        $send_date=$getRspwDb['created_at'];
//        $diff=date('H',strtotime($current_date))-date('H',strtotime($send_date));
//        dd($diff,$current_date,$send_date);
//        if ($diff>1){
//            return back()->with('errors','Thời gian thay đổi mật khẩu chỉ có hiệu lực trong vòng 1h kể từ khi gửi mail !');
//        }
        $new_password=bcrypt($password);
        // cập nhật mật khẩu
        DB::beginTransaction();

        try {
            $update=User::where('email',$email)->update(['password'=>$new_password]);
            if ($update){
               PasswordResets::where('email',$email)->where('token',$token)->delete();
            }
            DB::commit();
            $user = User::select("*")->where(['email' => $email])->first();
            Auth::loginUsingId($user->id);

            return redirect()->route('home')->with('success','Đổi mật khẩu thành công !');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect($url)->with('errors','Đổi mật khẩu thất bại !' . $e->getMessage());
        }

    }
}
