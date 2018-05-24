<?php
namespace Home\Model;
use Think\Model;
class RegisterModel extends Model {    
	protected $trueTableName = 'lk_user'; 

    //查询用户
    function register_select($user){
	   $data=M('user');//实例化表
	   return $data->where("user_name='$user'")->find();//带条件查询一条并返回
    }
      //查询表
    function tel_select($mobile){
       $data=M('user');//实例化表
       return $data->where("user_tel='$mobile'")->find();//带条件查询一条并返回
    }
    //添加数据
    function register_add($data){
    	return M('user')->add($data);
    }
    //修改密码
   // function pass_rest($user_id,$user_password){   
      //$User = M('User'); // 实例化User对象 
      // 更改用户的name值 
     // return $User-> where("user_id='$id'")->setField('user_password','$user_password');

} 
?>	