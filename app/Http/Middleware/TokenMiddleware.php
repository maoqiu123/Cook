<?php

namespace App\Http\Middleware;

use App\Tools\RequestTool;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->token){
            $token_expire = DB::table("users")->where('token',$request->token)->value('token_expire');
            if ($token_expire){
                if ($token_expire > Carbon::now()) {
                    $user = DB::table('users')->where('token',$request->token)->first();
                    $request->user = $user;
                    return $next($request);
                }else{
                    return RequestTool::response(3002,'token已过期，请重新登录',null);
                }
            }else{
                return RequestTool::response(3002,'token不存在',null);
            }
        }else{
            return RequestTool::response(3001,'未检测到token',null);
        }

    }
}
