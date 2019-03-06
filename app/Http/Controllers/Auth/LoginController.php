<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tools\ValidationHelper;
use App\Tools\RequestTool;

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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function login(Request $request){
        $ruler = [
            'password'=>'required',
            'email'=>'required|email'
        ];
        $validator = ValidationHelper::checkAndGet($request,$ruler,1001);
        if (is_object($validator)){
            return $validator;
        }
        $password = DB::table('users')->where('email',$validator['email'])->value('password');
        if ($password){
            if ($validator['password'] === decrypt($password)){
                return RequestTool::response(1000,'登录成功',null);
            }else{
                return RequestTool::response(2001,'登录失败，请检查账号密码',null);
            }
        }else{
            return RequestTool::response(1002,'登录失败，请检查账号是否存在',null);
        }
    }
}
