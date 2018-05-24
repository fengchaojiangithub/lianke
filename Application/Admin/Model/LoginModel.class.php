<?php
namespace Admin\Model;
use Think\Model;
Class LoginModel extends Model{   
 	protected $tableName = 'admin';
	/*
	*查询用户
	 */
	function login($arr){
		$obj=M($this->tableName);
		return $obj->where("account='$arr'")->find();
	}
	/**
	 * 查询身份
	 */
	function nodel_select($id){
		$obj=M('role_nodel');
		return $obj->alias('a')->join('nodel ON nodel.nodel_id= a.nodel_id')
		->where("role_id in($id)")
		->select();
	}
}
?>