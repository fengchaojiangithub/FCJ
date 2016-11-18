<?php
namespace App\Http\Controllers;

use Request;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\libs\respons\Response; 
use Memcache;

class IndexController extends BaseController
{    //首页
    public function index()
    {
       return View('index');  
    }
    //执行登陆
    public function login()
    {
        //接收前台传来的值
        $username=Request::get('username');
        $password=Request::get('password');
        $time=Request::get('time');
        $sign=request::get('sign');
        $token=request::get('token');
         echo $sign;die;
    }
    /*
     * 轮播图
     * @return [type] [description]
     */
    public function carousel()
    {
     	$code="200";
     	$message="成功";
        $data=DB::table('picture')->get(); 
        $path=$this->json($code,$message,$data);
        return $path;
    }
    /*
     * /校园简介
     * @return [type] [description]
     */
    public function synopsis()
    {
    	$code="200";
     	$message="成功";
        $data=DB::table('synopsis')->get(); 
    	$synopsis=$this->json($code,$message,$data);
    	return $synopsis;

    }
    //校园资讯
    public function news_info()
    {
    	$code="200";
     	$message="成功";
    	$data=DB::table('news_info')->get(); 
    	$news_info=$this->json($code,$message,$data);
    	return $news_info;
    }
  
    /*
    *绿色通道信息入库
    */
    public function green_insert(Request $request)
    {
        //接收数据
        $data=Request::input();
         //调用封装添加方法
        echo $this->Insert_sel($data,'pre_info');
    }
    /*
    *个人信息入库
    */
    public function userinfo_insert()
    {
        //接收数据
        $data=Request::input();
        //调用封装添加方法
        echo $this->Insert_sel($data,'user_info');
    }
    /*
    *宿舍信息入库
    */
    public function dorm_insert()
    {
        //接收数据
        $data=Request::input();
        //调用封装添加方法
        echo $this->Insert_sel($data,'dorm');
    }
    /*
    *抵校登记信息入库
    */
    public function arrive_insert ()
    {
        //接收数据
        $data=Request::input();
         //调用封装添加方法
        echo $this->Insert_sel($data,'arrive');
    }
    /*
     *推迟报到信息入库
     */
    public function delay_insert ()
    {
        //接收数据
        $data=Request::input();
        //调用封装添加方法
        echo $this->Insert_sel($data,'delay');
    }
    /*
     * 报到单查询
     * @return [type] [description]
     */
    public function report_select()
    {
        //两表联查考生和宿舍信息
            $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
            $users = DB::table('login')
            ->join('dorm', 'login.l_id', '=', 'dorm.l_id')
            ->join('costs', 'login.l_id', '=', 'costs.l_id')
            ->get();
       // print_r($users);die;
        //将数据转换成json格式
        $data=$jsoncallback."(".json_encode($users).")";
        // print_r($data);die;
        echo  $data;
    }

    /**
     * 我要提问
     */
    public function tiwen_insert()
    {
          //接收数据
        $question_arr=Request::input();
        echo $this->Insert_sel($question_arr,'tiwen');
    }
    /*
     * 我的提问
     */
    public function tiwen_select()
    {
        echo $this->Select_sel('tiwen','tiwen');

    }
    /*
     * 咨询常见问题解答
     */
    public function zanswer_select()
    {
        echo $this->Select_sel('zanswer','zanswer');
    }
    /*
     * 下载中心
     */
    public function uploadate_select()
    {
        echo $this->Select_sel('uploadate','uploadate');
    }
    /*
     * 资料下载
     */
    public function data_select()
    {
        echo $this->Select_sel('data','data');
    }
    /*
     * 通知公告
     */
    public function notice_select()
    {
        echo $this->Select_sel('notice','notice');
    }
    /*=========================================================
     * /json方法
     * @param  [type] $code    [description]
     * @param  [type] $message [description]
     * @param  array  $data    [description]
     * @return [type]          [description]
     */
    public function json($code,$message,$data=array()){

      if(!is_numeric($code)){
        return "";
        }
      $result=array(
        'code'=>$code,
        'message'=>$message,
        'data'=>$data
      );
    return  json_encode($result);
    }
    public function Memcache()
    {
        $mem = new Memcache;
        // var_dump($mem);die;
        $mem->connect('127.0.0.1',11211);
        //$mem->set('zanswer','zanswer');
        $a=$mem->get('zanswer');
        var_dump($a);die;
    }
    /*
     * 单表查询--封装 
     * @param [type] $table [description]
     */
    public static function Select_sel($table,$da)
    {    

        //初始化对象
        $mem = new Memcache;
        //建立连接
        $mem->connect('127.0.0.1',11211);
        //判断是否有值
          if(!$mem->get($da)) {
            //echo "1";
            //查询数据库
            $data = DB::table($table)->get();
              //先清空
            $mem->flush();
            //存入
            $mem->set($da,$data);
            $mdata=$mem->get($da);
            //var_dump($mdata);die;
            $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
            $data=json_encode($data);
            return $jsoncallback . "(" .$data. ")"; 
           } else {
             //取出
            $mdata=$mem->get($da);
            //var_dump($mdata);die;
            $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
            $mdata=json_encode($mdata);
            return $jsoncallback . "(" .$mdata. ")"; 

           }
    }
    /**添加数据--封装
     * [Insert_sel description]
     * @param [type] $data  [description]
     * @param [type] $table [description]
     */
    public static function Insert_sel($data,$table)
    {
        //去除自动生成的callback
        unset($data['callback']);
        unset($data['_']);

        foreach ($data as $k => $v) {
            if($v=="") {
                unset($data[$k]);
            }
        }
        //抵校登记信息入库
        $data=DB::table($table)->insert($data);
           //通过json类验证
        // $result = Response::json(200,"success",$data);
        if($data) { 
            echo "1";
        } else {
            echo "0";
        }
    }
//结束
}