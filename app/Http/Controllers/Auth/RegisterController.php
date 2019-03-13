<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\ValidationHelper;
use App\Tools\RequestTool;
use App\Services\UserService;

class RegisterController extends Controller
{

    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $ruler = [
            'username'=>'required',
            'password'=>'required',
            'email'=>'required|email|unique:users'
        ];
        $validator = ValidationHelper::checkAndGet($request,$ruler,1001);
        if (is_object($validator)){
            return $validator;
        }

        $this->userService->register($validator);

        return RequestTool::response(1000,'注册成功',null);
    }
}
