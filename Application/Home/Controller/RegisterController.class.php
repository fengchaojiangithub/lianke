<?php

namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {

    public function register(){
        $this->display('index');
    }


    public function reg_go(){
    	//注册信息判断
    	//$username=I('post.l_name');
    	//$password=I('post.l_password');
      $mobile=I('post.mobile');
      $mobile_code=I('post.mobile_code');
      //echo $mobile;die;
    	// if(empty($username)||empty($password)){
     //    exit('错误：用户名或密码不能为空。<a href="javascript:history.back(-1);">返回</a>');  
     //  }
     //  if(!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',$username)) {
     //    exit('错误：用户名由2-16位数字或字母、汉字、下划线组成!<a href="javascript:history.back(-1);">返回</a>');
     //  }
      if(!preg_match('/^1[34578]{1}\d{9}$/', $mobile)){
        exit('错误：不是正确的手机号。<a href="javascript:history.back(-1);">返回</a>');
      }
      // if(!preg_match('/^[_0-9a-z]{6,16}$/i',$password)){
      //   exit('错误：密码为6-16为数字字母下划线组成。`');
      // }
      
        //实例化模型
      $User = M('user');
      
       //检测用户名是否已经存在
      // $res=$User->register_select($username);
      // if(!empty($res)){
      //   exit('错误：用户名'.$username.'已存在。<a href="javascript:history.back(-1);">返回</a>');
      // }
       //检测手机号是否已经存在
      $ree=$User->where('user_tel='.$mobile)->find();
      if(!empty($ree)){
        echo '1';die;
        // exit('错误：手机号'.$mobile.'已存在。<a href="javascript:history.back(-1);">返回</a>');
      }
      $mobile_codes = $_SESSION['mobile_code'];
      if($mobile_code!=$mobile_codes){
        // exit('错误：验证码错误。<a href="javascript:history.back(-1);">返回</a>');
         echo '2';die;
      }
 //写入数据
      $data=[
         	// 'user_password'=>MD5($password),
         	'user_addtime'=>time(),
         	// 'user_name'=>$username,
          'user_tel' =>$mobile
            ];
     
      $user=M("user");
      $res=$user->add($data);
      if($res){	 
      $this->redirect('Register/nickname',array('mobile'=>$mobile));
      }else{
          
           echo "0";  
      }  
      }
        //添加昵称
    public function nickname(){
         $mobile=$_GET['mobile'];
        // print($mobile);die;
      $this->assign('mobile',$mobile);
      $this->display('nickname');
    }

     public function nickname_go(){
        $user_tel=I('post.user_tel');
        $user_name=I('post.user_name');
        $user_password=I('post.user_name');
        $data=[
           'user_name'=>$user_name,
           'user_password'=>MD5($user_password)

        ];
       // print_r($user_tel);die;
        // $ree=M('user')->where("user_tel='$user_tel'")->find();
        // print_r($ree);die;

        $res=M('user')->where("user_tel=".$user_tel)->save($data);
        //print_r($res);die;
        if($res){
            $re=M('user')->where("user_tel=".$user_tel)->find();
             cookie('user_name',$user_name,3600*24*15); 
             cookie('user_tel',$user_tel);
             cookie('user_id',$re['user_id']);
             
          $this->success('添加成功',U('Index/index'));
        }else{
          $this->error('添加错误');
        }
    }
       //手机验证码
      public function shouji(){
        // echo 123123;die;
        $shouji = I('post.mobile');
         //print_r($shouji);die;
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

  


    //找回密码
    public function get_back(){
      $this->display('retrieve');
    }
    public function get_back_go(){
      $mobile=I('post.mobile');
      $mobile_code=I('post.mobile_code');
      if(empty($mobile)){
      exit('错误：手机号不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
      }
      if(!preg_match('/^1[34578]{1}\d{9}$/', $mobile)){
      exit('错误：不是正确的手机号。<a href="javascript:history.back(-1);">返回</a>');
      }
      if(empty($mobile_code)){
      exit('错误：验证码不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
      }
      $mobile_codes = $_SESSION['mobile_code'];
      if($mobile_code!=$mobile_codes){
      exit('错误：验证码错误。<a href="javascript:history.back(-1);">返回</a>');
      }
      $User = D('Register');
      $res=$User->tel_select($mobile);
      $this->assign('res',$res);
      $this->display('rest');
    }
    public function rest(){
      $data=I('post.');
      $user_id=$data['id'];
      $user_pass=$data['l_password'];
      if(empty($user_pass)){
      exit('错误：密码不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
      }
      if(!preg_match('/^[_0-9a-z]{6,16}$/i',$user_pass)){
        exit('错误：密码为6-16为数字字母下划线组成。');
      }
      $user_password=MD5($user_pass);
      $User = D('Register');
      $data['user_password']=$user_password;
      $res=$User->where("user_id='$user_id'")->save($data);
      
      if($res){
        $this->success('重置成功',U('index/index'));
      }else{
        $this->success('重置失败',U('Register/get_back'));
      }
    }
}//结束
?>
