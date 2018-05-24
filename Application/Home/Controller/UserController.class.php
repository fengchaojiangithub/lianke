<?php

namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    /**展示用户列表
     * [invitation description]
     * @return [type] [description]
     */
    public function invitation(){
  	    if(empty($_COOKIE['user_id'])){
  	    		$this->ajaxReturn('1');die;
  	    }else{
		  	    $where['user_id']= array('NEQ',$_COOKIE['user_id']);
		    	$data=M('user')
		    	->where($where)
		    	->field("user_id,user_name,user_face")
		        ->select();
		       	$this->ajaxReturn($data);


  	    }         
    }
    /**执行邀请操作
     * [invite_go description]
     * @return [type] [description]
     */
    public function yaoqing(){
    	$yao_id=I('post.yao_id');
    	$q_id=I('post.q_id');
    	//print_r($yao_id);die;
    	$where['user_id']=$_COOKIE['user_id'];
    	$map['yao_id']=$yao_id;
    	$qid['q_id']=$q_id;
    	$yaoqing=M('invite')
    	->where($where)
    	->where($map)
    	->where($qid)
    	->select();
    	if(empty($yaoqing)){
	    		//echo "1";die;
		    	$data['yao_id']=$yao_id;
		    	$data['q_id']=$q_id;
		    	$data['user_id']=$_COOKIE['user_id'];
		    	$da=M('invite')->add($data);
		    	   if($da){
		    	   	$username=M('user')
                // ->join('lk_invite on lk_invite.user_id=lk_user.user_id')
		            ->where('user_id='.$yao_id)
		            ->find();
		          // print_r($username);die;
		           $arr = array('status'=>1,'username'=>$username['user_name']);
		           $this->ajaxReturn($arr);
		    	   	
		    	   }else{
		    	   	$arr = array('status'=>2,'username'=>$username['user_name']);
		    	   	$this->ajaxReturn($arr);
		    	   }
	            
	            // print_r($username);die;

            
    	}else{
    		 //根据邀请人，被邀请人，问题id 删除数据
	         $where['user_id']=$_COOKIE['user_id'];
	    	 $map['yao_id']=$yao_id;
	    	 $qid['q_id']=$q_id;
    		 $da=M('invite')
    		 ->where($where)
    		 ->where($map)
    		 ->where($qid)
    		 ->delete();
	    		 if($da){
	                //获取被邀请人的名字
	              	$uname=M('user')
		            ->where('user_id='.$yao_id)
		            ->find();
		            $arr = array('status'=>3,'username'=>$uname['user_name']);
		    	   	$this->ajaxReturn($arr);
	    		 }else{
	    		 	$arr = array('status'=>4,'username'=>$uname['user_name']);
		    	   	$this->ajaxReturn($arr);
	    		 }
    	}

    	
    	

    }

    public function myzoe(){
    	
    	$this->display();
    }

        
}//结束
?>
