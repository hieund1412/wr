<?php

namespace Modules\Auth\Http\Controllers ;

// use Adldap\Laravel\Facades\Adldap;
use App\Http\Controllers\Controller;
use Modules\Auth\Entities\PermissionRole;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Modules\Permissions\Services\PermissionsService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as Auth;
use Modules\Auth\Entities\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $permissionService;
    public function __construct(PermissionsService $permissionsService)
    {
        $this->middleware('guest')->except('logout');
        $this->permissionService = $permissionsService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth::login');

    }

    public function checkPass($string)
    {
        $regex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,190}$/';
        if (!preg_match($regex, $string)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if ($this->checkText($request->user_login) == false) {
            return back()->with('errors', 'Tên đăng nhập trong khoảng từ 3 đến 190 ký tự !');
        }
        if ($this->checkText($request->password) == false) {
            return back()->with('errors', 'Mật khẩu trong khoảng từ 6 đến 30 ký tự, bao gồm chữ và số !');
        }

        $user = User::where('user_login', $request->user_login)->first();


        if ($user == null ) {

            return back()->with('errors', 'Tài khoản không được quyền đăng nhập');
        }
        if (Hash::check($request->password, $user->password)) {
            // Set Auth Details
            Auth::login($user);

            $roles = $this->permissionService->getJoinPermission();
                    Session::put('permission', $roles);
                
            // $xy = Session::get('permission');
           Session::put('permission', $roles);
            // Redirect home page
            if(!empty (Auth::user()->block_id) && !empty(Auth::user()->department_id) && !empty(Auth::user()->fullname) && !empty(Auth::user()->email))
            {
                return view('index');
            } else {
                return redirect()->route('users.startView');
            }
        } else {
            return back()->with('errors', 'Sai mật khẩu');
        }
    }

    public function checkText($string)
    {
//        $regex = '/^[a-zA-Z0-9]{3,190}$/';
//        if (!preg_match($regex, $string)) {
//            return false;
//        } else {
//            return true;
//        }
        if (strlen($string) < 3) {
            return false;
        } elseif (strlen($string) > 190) {
            return false;
        } else {
            return true;
        }
    }

    public function loginGet(Request $request)
    {
        if ($this->checkText($request->user_login) == false) {
            return $this->responErrorAjax("Tên đăng nhập trong khoảng từ 3 đến 190 ký tự !");
        }
        if ($this->checkText($request->password) == false) {
            return $this->responErrorAjax("Mật khẩu trong khoảng từ 6 đến 30 ký tự, bao gồm chữ và số !");
        }

        $user = User::where('username', $request->user_login)->first();

        if ($user == null || $user->status == 0) {
            return $this->responErrorAjax("Tài khoản không được quyền đăng nhập");
        }
        if (Hash::check($request->password, $user->password)) {
            // Set Auth Details

            Auth::login($user);

            Session::put('user_id', $user->id);

//            $roles = $this->createPermit($user->id);
//            Session::put('permission', $roles);

            $service = $this->createService($user->id);
            Session::put('services', $service);

            return redirect()->route('home');
        } else {
            return $this->responErrorAjax("Mật khẩu không đúng");
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function pushSession() {

    }

//    protected function createPermit($id)
//    {
//        $permit = PermissionRole::select("permission_role.permission_id")
//                                ->join('user_role', 'user_role.role_id', 'permission_role.role_id')
//                                ->where('user_role.user_id', $id)->get();
//        $list_role = [];
//        foreach ($permit as $perm) {
//            array_push($list_role, $perm->permission_id);
//        }
//        return $list_role;
//    }

}
