<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Tools\ValidationHelper;

class LoginController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request){
        $ruler = [
            'password'=>'required',
            'email'=>'required|email'
        ];
        $validator = ValidationHelper::checkAndGet($request,$ruler,1001);
        if (is_object($validator)){
            return $validator;
        }

        return $this->userService->login($validator);
    }
}
