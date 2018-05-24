<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function user(){
    	$db=M('admin');
    	$data=$db->select();
    	//print_r($data);die;
    	$this->assign('data',$data);
        $this->display();
    }
    public function user_add(){
        $this->display('user_add');
    }
    public function user_add_go(){
        $da=I('post.');
        $data['account']=$da['account'];
        $data['password']=md5($da['password']);
        $res=M('admin')->add($data);
        if($res){
        	$this->success('添加成功',U('User/user'));
        }else{
        	$this->success('添加失败',U('User/user'));
        }
       // print_r($data);die;
    }
    public function user_delete(){
    	$id=I('get.id');
    	//print_r($id);die;
    	$res=M('admin')->where("id=$id")->delete();
    	if($res){
    		$this->success('删除成功',U('User/user'));
    	}else{
    		$this->success('删除失败',U('User/user'));
    	}


    }
}