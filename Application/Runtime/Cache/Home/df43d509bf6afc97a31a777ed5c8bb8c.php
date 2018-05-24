<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>重置密码</title>
</head>
<script type="text/javascript" src="/liankexing/Public/js/jquery-3.3.1.min.js"></script>
<body>
<h1 align="center">重置密码</h1>
	<form id="form1" action="<?php echo U('Register/rest');?>" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $res['user_id']?>">
                <div class="form-group" align="center">
                    <label>手机号</label>
                    <input id="mobile" name="mobile" type="text" size="25" value="<?php echo $res['user_tel'];?>" />
                  
                </div>
                <div class="form-group" align="center">
                    <label>用户名:</label>
                    <input type="text" name="l_name" value="<?php echo $res['user_name'];?>" />
                </div>
                <div class="form-group" align="center">
                    <label>新密码:</label>
                    <input type="text" name="l_password" />
                </div>          
                
                <div align="center">
                <input  type="submit" class="btn btn-primary" value="确定修改" />
                <input id="btnClear" type="reset" class="btn btn-default" value="重置" /><a href="<?php echo U('Index/index');?>">返回首页</a>
                </div>

   
</form>	
</body>
</html>