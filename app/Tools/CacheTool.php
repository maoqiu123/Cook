<?php
/**
 * Created by PhpStorm.
 * User: maoqiu
 * Date: 2019/3/18
 * Time: 10:46
 */

namespace App\Tools;


use function Complex\sec;
use Illuminate\Support\Facades\Redis;

class CacheTool
{
    public function test(){
        $data = $this->setrange("name",3,"mmm111");
//        $data = Redis::hmset("user","name","maoqiu","age",'20');
//        $data = Redis::hgetall("user");
        return $data;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * String
     */
    public function set($key,$value){
        $data = Redis::set($key,$value);
        $data = Redis::get($key);
        return RequestTool::response(1000,"Success!",null);
    }
    public function get($key){
        $data = Redis::get($key);
        return RequestTool::response(1000,"Success!",$data);
    }

    /**
     * @param $key
     * @param $start
     * @param $end
     * @return \Illuminate\Http\JsonResponse
     * 截取字符串
     */
    public function getrange($key,$start,$end){
        $data = Redis::getrange($key,$start,$end);
        return RequestTool::response(1000,"Success!",$data);
    }

    /**
     * @param $key
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * 给 key 赋新值，并返回 key 的旧值
     */
    public function getset($key,$value){
        $data = Redis::getset($key,$value);
        return RequestTool::response(1000,"Success!",$data);
    }

    /**
     * @param $key
     * @param $offset
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * 对 key 所储存的字符串值，设置或清除指定偏移量上的位(bit)。
     */
    public function setbit($key,$offset,$value){
        Redis::setbit($key,$offset,$value);
        return RequestTool::response(1000,"Success!",null);
    }

    /**
     * @param $key
     * @param $offset
     * @return \Illuminate\Http\JsonResponse
     * 对 key 所储存的字符串值，获取指定偏移量上的位(bit)
     */
    public function getbit($key,$offset){
        $data = Redis::getbit($key,$offset);
        return RequestTool::response(1000,"Success!",$data);
    }

    /**
     * @param $keys
     * @return \Illuminate\Http\JsonResponse
     * 获取所有(一个或多个)给定 key 的值。
     */
    public function mget($keys){
        $data = Redis::mget($keys);
        return RequestTool::response(1000,"Success!",$data);
    }
//    public function mset($keys){
//        Redis::mset("name","123","num","233");
//        return RequestTool::response(1000,"Success!",null);
//    }
    /**
     * @param $keys
     * @param $seconds
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * 有过期时间的set
     */
    public function setex($keys,$seconds,$value){
        Redis::setex($keys,$seconds,$value);
        return RequestTool::response(1000,"Success!",null);
    }

    /**
     * @param $keys
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * 当key没有被设置时才会设置
     */
    public function setnx($keys,$value){
        Redis::setnx($keys,$value);
        return RequestTool::response(1000,"Success!",null);
    }

    /**
     * @param $keys
     * @param $offset
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * 用 value 参数覆写给定 key 所储存的字符串值，从偏移量 offset 开始。
     */
    public function setrange($keys,$offset,$value){
        Redis::setrange($keys,$offset,$value);
        return RequestTool::response(1000,"Success!",null);
    }
    public function serlen($keys){
        $data = Redis::serlen($keys);
        return RequestTool::response(1000,"Success!",$data);
    }
}