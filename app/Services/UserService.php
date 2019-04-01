<?php
/**
 * Created by PhpStorm.
 * User: maoqiu
 * Date: 2019/3/6
 * Time: 17:32
 */

namespace App\Services;

use App\Tools\FileUploadTool;
use App\Tools\RequestTool;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserService extends BaseService
{
    private $table = 'users';

    public function register($user){
        $user['password'] = encrypt($user['password']);

        $this->create($this->table,$user);
    }

    public function login($user){
        $password = DB::table($this->table)->where('email',$user['email'])->value('password');
        if ($password){
            if ($user['password'] === decrypt($password)){
                $time = Carbon::now();
                $token = md5($time.$password);
                $token_expire = $time->addDay();
                DB::table($this->table)->where('email',$user['email'])->update([
                    'token' => $token,
                    'token_expire' => $token_expire
                ]);
                return RequestTool::response(1000,'登录成功',$token);
            }else{
                return RequestTool::response(2001,'登录失败，请检查账号密码',null);
            }
        }else{
            return RequestTool::response(1002,'登录失败，请检查账号是否存在',null);
        }
    }
    public function update($data,$user){
        if ($data['pic'] !== null){
//            $file = new FileUploadTool();
//            $file = $file->saveToQiniu($data['pic'],'user');
//            if ($file == false){
//                return RequestTool::response(4001,"上传文件失败",null);
//            }
            $user->pic = $data['pic'];
        }
        if ($data['username'] !== null){
            $user->username = $data['username'];
        }

        DB::table($this->table)->where('id',$user->id)->update((array)$user);
        return RequestTool::response(1000,"更新用戶信息成功",$user);
    }


}