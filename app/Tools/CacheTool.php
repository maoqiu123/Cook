<?php
/**
 * Created by PhpStorm.
 * User: maoqiu
 * Date: 2019/3/18
 * Time: 10:46
 */

namespace App\Tools;


use Illuminate\Support\Facades\Redis;

class CacheTool
{
    public function test(){
        $data = Redis::hmset("user","name","maoqiu","age",'20');
        $data = Redis::hgetall("user");
        return RequestTool::response(1000,"aaa",$data);
    }

}