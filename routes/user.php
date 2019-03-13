<?php
/**
 * Created by PhpStorm.
 * User: maoqiu
 * Date: 2019/2/26
 * Time: 16:12
 */

Route::post('/login', 'Auth\LoginController@login')->middleware('token');
Route::post('/register', 'Auth\RegisterController@create');
