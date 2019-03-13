<?php

namespace App\Tools;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TokenTool
{

    /**
     * @param $userId
     * @param string $type
     * @return string
     */
    public static function makeToken($userId, string $type)
    {
        $time=Carbon::now();
//        $Token=self::$config[$type]['table_name'].':'.md5(SqlTool::generatePassword(6).$time.$userId);
        $Token=md5(SqlTool::generatePassword(6).$time.$userId);
        DB::table('token')->insert([
            'content'=>$Token,
//            'user_table'=>self::$config[$type]['table_name'],
            'user_id'=>$userId,
            'expired_at'=>$time->addDay(1),
            'created_at'=>$time
        ]);
        return $Token;
    }

    public static function isTokenExpired($token){
        $expired_at=DB::table('token')->where('content','=',$token)->value('expired_at');
         return Carbon::now()>$expired_at;
    }

    public static function isTokenExist($token){
        $res=DB::table('token')->where('content','=',$token)->first();
        if ($res){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getUserByToken($token,$type){
        $user=DB::table('token')->where('content','=',$token)
            ->join(self::$config[$type]['table_name'],'token.user_id','=',self::$config[$type]['table_name'].'.'.'id')
            ->select(self::$config[$type]['select'])
            ->first();
        return $user;
    }

}