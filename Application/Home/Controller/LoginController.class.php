<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function login(){
        $this->display('index');
    }
    //手机号登录
    public function login_go(){
        $data=I('post.');
        //print_r($data);die;
        $user_tel=	$data['tel'];
        $user_password=MD5($data['password']);
        //$code=$data['l_code'];
        if(empty($user_tel)||empty($user_password)){
        // exit('错误：昵称或密码不能为空。<a href="javascript:history.back(-1);">返回</a>');  
        echo "0";
        }
       // //判断验证码
       //  if(empty($code)){
       //  exit('错误：验证码不能为空。<a href="javascript:history.back(-1);">返回</a>');
       //  }
       //  $rec = $this->check_verify($code);
       //  if(!$rec){
       //  exit('错误：验证码错误。<a href="javascript:history.back(-1);">返回</a>');
       //  }
        $User = M('user');
        $res=$User->where("user_tel=$user_tel")->find();
        // print_r($res);die;
        if($res){
               if($user_password==$res['user_password']){
                  cookie('user_name',$res['user_name'],3600*24*15); 
                  cookie('user_id',$res['user_id']);
                  cookie('user_tel',$user_tel);
                  echo "3";
               }else{ 
                echo "2";
               }

        }else{
          echo "1";
        }
     
       }


    //退出
      public function quit(){
          cookie('user_name',null);
          $this->success('注销成功',U('Index/index'));
          
      }
           //输出验证码
      function Verify(){
              $Verify =     new \Think\Verify();
              $Verify->fontSize = 15;
              $Verify->length   = 4;
              $Verify->useNoise = false;
              $Verify->entry();
          }    
          //实例化验证码类
      function check_verify($code){
              $verify = new \Think\Verify();   
              return $verify->check($code);
      }



      //显示手机登录页面
      public function login_tel(){
        $this->display('login_tel');
      } 
      public function login_tel_go(){
        $mobile=I('post.mobile');
        $mobile_code=I('post.mobile_code');
        //print_r($mobile);die;
        if(empty($mobile)){
          echo "0";die;
        }
        if(!preg_match('/^1[34578]{1}\d{9}$/', $mobile)){
        echo "1";die;
        }
        if(empty($mobile_code)){
         echo "3";die;
        }
        $mobile_codes = $_SESSION['mobile_code'];
        if($mobile_code!=$mobile_codes){
        echo "4";die;
        }
        $ree=M('user')->where('user_tel='.$mobile)->find();
        //print_r($ree);die;
        
        if($ree){
             cookie('user_name',$ree['user_name'],3600*24*15); 
             cookie('user_id',$res['user_id']);
             echo "6";die;
        }else{
             echo '5';die;
        }
      }
             //手机验证码
      public function shouji(){
        // echo 123123;die;
        $shouji = I('post.mobile');
        //短信接口地址
        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
        $appid = 'C49702215';
        $apikey = '702f09a3b4d3f5ac7ca6843191bbb970';
        //生成的随机数
        $mobile_code = $this->randoms(4,1);
        session('mobile_code',$mobile_code);
    
        $post_data = "account=".$appid."&password=".$apikey."&mobile=".$shouji."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
        //用户名是登录用户中心->验证码短信->产品总览->APIID
        //查看密码请登录用户中心->验证码短信->产品总览->APIKEY
        $gets =  $this->xml_to_array($this->Posts($post_data, $target));
        if($gets['SubmitResult']['code']==2){
            $_SESSION['mobile'] = $shouji;
            $_SESSION['mobile_code'] = $mobile_code;
        }
        echo $gets['SubmitResult']['msg'];
        echo $shouji;
        
      }
    //请求数据到短信接口，检查环境是否 开启 curl init。
      function Posts($curlPost,$url){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_NOBODY, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
            $return_str = curl_exec($curl);
            curl_close($curl);
            return $return_str;
      }

    //将 xml数据转换为数组格式。
      function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
        $subxml= $matches[2][$i];
        $key = $matches[1][$i];
        if(preg_match( $reg, $subxml )){
        $arr[$key] = $this->xml_to_array( $subxml );
        }else{
        $arr[$key] = $subxml;
        }
        }
        }
        return $arr;
      }

    //random() 函数返回随机整数。
      function randoms($length = 6 , $numeric = 0) {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        }else{
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
        }
        }
        return $hash;
      }
      //个人资料
      public function personal(){
  
        $user_tel=isset($_COOKIE['user_tel']) ? $_COOKIE['user_tel'] : "";
          if($user_tel){
            $where=[
              'user_tel'=>$user_tel
            ];
          }
        //实例化表
        $user=M('user');
        $data=$user->where($where)->find();
        //var_dump($data);die;
        $this->assign('data',$data);
        $this->display('personal');
      }
      //展示编辑页面
       public function personalupdate(){
        $this->display('personalupdate');
      }


      //编辑个人资料
      public function personal_go(){
        $data=I('post.');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['user_fullname']);
      
        $data['user_face']='./Public/Uploads/'.$info['savepath'].$info['savename'];
        $user_tel=$_COOKIE['user_tel'];
        // var_dump($user_tel);
        // print_r($data);die;
        //实例化表
         $user=M('user');
         $res=$user->where("user_tel='$user_tel'")->save($data);
         if($res){
          $this->success('编辑成功',U('Login/personal'));
         }else{
          $this->success('编辑失败');
         }
      }
    
}//结束