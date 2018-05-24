<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加管理员</title>
</head>
<body>
<form action="<?php echo U('User/user_add_go');?>" method="post">
      <table>
      	<tr>
      		<td>账号</td>
      		<td><input type="text" name="account"></td>
      		<td></td>
      	</tr>
      	<tr>
      		<td>密码</td>
      		<td><input type="password" name="password"></td>
      		<td></td>
      	</tr>
      	<tr>
      		<td>等级</td>
      		<td></td>
      		<td></td>
      	</tr>
      	<tr>
      		<td><input type="submit" value="添加"><input type="reset" value="重置"></td>
      		<td></td>
      		<td></td>
      	</tr>
      	<tr>
      		<td></td>
      		<td></td>
      		<td></td>
      	</tr>
      </table>
      </form>
	
</body>
</html>