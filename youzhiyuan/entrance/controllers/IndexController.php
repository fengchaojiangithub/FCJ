<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class IndexController extends Controller
{   //禁掉自带样式
    public $layout=false;
    //禁掉csrf验证
    public $enableCsrfValidation = false;

    //登陆
    public function actionLogin(){
      return $this->render('login.html');
    }
    //执行登陆
    public function actionLoginto(){
      $username=yii::$app->request->post('username');
      $password=yii::$app->request->post('password');
      //print_r($username);die;
        $time = time();
        // var_dump($time);die;
        $token = '456';
        $datas = array(
            'token' =>$token,
            'username' => $username,
            'password' => $password,
            'time' => $time,
            'arr'=>"",
            );
        //var_dump($datas);die;
        // //去空   //排序
        $datak= array_filter($datas);
        //print_r($data);die;
           ksort($datak);
        //print_r($data);die;
           //拼接地址字符串
        $data = "";
        while (list ($key, $val) = each($datak)) {
            $data .= $key . "=" . $val . "&";
        }
        //print_r($data);die;
        //去掉最后一个&字符
         $data = substr($data, 0, count($data) - 2);
         // //print_r($data);die;
         // $data = md5($data);
         // $url = "http://www.entrance.com/public/index/loginto?&password=$password&time=$time&token=$token&username=$username&sign=$data";
         // $arr = file_get_contents($url);
         // if($arr){
         //     echo "登陆成功";
         // }

        }
      /*
       * 首页
       * @return [type] [description]
       */
        public function actionIndex()
        {
         //获取轮播图数据
          $url=HURL.'index/carousel';
          $data=file_get_contents($url);
           //转换成json格式
          $path=json_decode($data,true);
           // print_r($path);die;
           //获取简介数据
          $url1=HURL.'index/synopsis';
          $synopsis_json=file_get_contents($url1);
           //print_r($synopsis);die;
          $synopsis=json_decode($synopsis_json,true);
          //var_dump($synopsis);die;
          //获取校园资讯数据
           $url_newsinfo=HURL.'index/news_info';
           $newsinfo_json=file_get_contents($url_newsinfo);
           $news_info=json_decode($newsinfo_json,true);
          // print_r($news_info);die;
          return $this->render('index.html',['path'=>$path['data'],
          'synopsis'=>$synopsis['data'],'news_info'=>$news_info['data']]);
        }
      /*
       *自助报到
       */
        public function actionSelf_report()
        {
          return $this->render('self_report.html');
        }
      /*
       * 绿色通道
       * @return [type] [description]
       */
        public function actionGreen()
        {
          return $this->render('green.html');
        }
     /*
      *抵校登记
      */
        public function actionArrive()
        {
        return $this->render('arrive.html');
        }
     /*
      *推迟报到
      */
        public function actionDelay()
        {
        return $this->render('delay.html');
        }
     /*
      *入学须知
      */
       public function actionMust_know()
        {
        return $this->render('must_know.html');
        }
     /*
      *通知公告
      */
        public function actionNotice()
        {
        return $this->render('notice.html');
        }
     /*
      *公告详情
      */
        public function actionNoticedetail()
        {
        return $this->render('noticedetail.html');
        }
    /*
     *资料下载
     */
        public function actionData()
        {
        return $this->render('data.html');
        }
     /*
      *资讯帮助
      */
        public function actionAsk()
        {
        return $this->render('ask.html');
        }
     /*
      * 到校路线
      */
        public function actionRoute()
        {
        return $this->render('route.html');
        }
     /*
      * 常见问题
      */
        public function actionCommonquestion()
        {
        return $this->render('commonquestion.html');
        }
     /*
      * 资讯解答
      */
        public function actionAnswer()
        {
        return $this->render('answer.html');
        }
     /*
      * 下载中心
      */
        public function actionUploadate()
        {
        return $this->render('uploadate.html');
        }
     /*
      * 我的提问
      */
        public function actionMyanswer()
        {
        return $this->render('myanswer.html');
        }
     /*
      * 我要提问
      */
        public function actionTiwen()
        {
        return $this->render('tiwen.html');
        }
     /*
      * 地址
      */
        public function actionAdress()
        {
        return $this->render('adress.html');
        }
     /*
      * 自助入学
      */
        public function actionEntrance()
        {
        return $this->render('entrance.html');
        }
     /*
      *个人中心
      */
       public function actionUser_center()
       {
       return $this->render('user_center.html');
       }
     /*
      *个人信息
      */
       public function actionUser_info()
       {
       return $this->render('user_info.html');
       }
     /*
      *宿舍预定
      */
       public function actionDorm()
       {
       return $this->render('dorm_book.html');
       }
     /*
      *报到单
      */
       public function actionReportcard()
       {
       return $this->render('reportcard.html');
       }
   
 //结束     
}
