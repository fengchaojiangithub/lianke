<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }
    public function login_go(){
    	$arr=I('post.');
    	$obj=M('admin');
    	$ar=$obj->where('account'==$arr['user'])->find();
       // print_r($ar);die;
    	if($ar['account']==$arr['user']){
    		if($ar['password']==MD5($arr['pwd'])){
                if($this->check_verify($arr['code'])){
                    if($ar['lock']=='0'){
                       $data=array(
                            'id'=> $ar['id'],
                            'login_time'=>time(),
                            'login_ip'=>get_client_ip()
                        );
                       $arr=$obj->save($data);
                       
                        if($arr){
                            cookie('id',$ar['id']);
                            cookie('account',$ar['account']); 
                            cookie('login_time',date('Y-m-d H:i', $ar['login_time']));
                            cookie('login_ip',$ar['login_ip']);
                            echo ok; 
                        }else{
                            echo no;
                        }    
                    }else{
                     echo no;   
                    }
                   
                }else{
                   echo no;
                }

    		}else{
    		echo no;
    		}
    	}else{
    	echo no;
    	}
    }
    /**
     * [verify 展示验证码
     * @return [type] [description]
     */
    public function verify(){
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 20;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }
    /**
     * [check_verify 验证]
     * @param  [type] $code [description]
     * @param  string $id   [description]
     * @return [type]       [description]
     */
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    public function quit(){
       

        cookie('account',null);
        $this->success('退出成功',U('Login/login')); 
    
       
    }

}//结束