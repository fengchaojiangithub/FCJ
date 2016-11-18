<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::any('/','IndexController@index');
//展示首页
Route::any('index/index','IndexController@index');
//轮播图
Route::any('index/carousel','IndexController@carousel');
//校园简介
Route::any('index/synopsis','IndexController@synopsis');
//校园资讯
Route::any('index/news_info','IndexController@news_info');
//绿色通道入库
Route::any('index/green_insert','IndexController@green_insert');
//个人信息入库
Route::any('index/userinfo_insert','IndexController@userinfo_insert');
//宿舍信息入库
Route::any('index/dorm_insert','IndexController@dorm_insert');
//抵校登记信息入库
Route::any('index/arrive_insert','IndexController@arrive_insert');
//报到单信息查询
Route::any('index/report_select','IndexController@report_select');
//推迟报到信息入库
Route::any('index/delay_insert','IndexController@delay_insert');
//提问信息入库
Route::any('index/tiwen_insert','IndexController@tiwen_insert');
//查看提问信息
Route::any('index/tiwen_select','IndexController@tiwen_select');
//咨询常见问题解答
Route::any('index/zanswer_select','IndexController@zanswer_select');
//下载信息查看
Route::any('index/uploadate_select','IndexController@uploadate_select');
//资料下载
Route::any('index/data_select','IndexController@data_select');
//通知公告
Route::any('index/notice_select','IndexController@notice_select');
//登陆
Route::any('index/login','IndexController@login');
Route::any('index/Memcache','IndexController@Memcache');
//