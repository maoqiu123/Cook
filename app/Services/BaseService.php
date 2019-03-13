<?php
/**
 * Created by PhpStorm.
 * User: maoqiu
 * Date: 2019/3/6
 * Time: 17:37
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class BaseService
{
    public function create($table,$data){
        DB::table($table)->insertGetId($data);
    }

}