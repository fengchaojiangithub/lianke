<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑个人资料</title>
</head>
<body>
<h2 align="center">编辑个人资料</h2>
 <form action="<?php echo U('Login/personal_go');?>" method="post" role="form" enctype="multipart/form-data">
    <table align="center">
    	<tr>
    		<td>头像</td>
    		<td><input type="file" name="user_fullname"></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>昵称</td>
    		<td><input type="text" name="user_name" value=""></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>性别</td>
    		<td>
            <input type="radio" name="user_sex" value="0">女
            <input type="radio" name="user_sex" value="1">男
            </td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>职业</td>
    		<td><input type="text" name="user_occupation" value=""></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>个人简介</td>
    		<td><textarea name="usar_introduce" id="" cols="30" rows="10"></textarea></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td><input type="submit" value="保存"></td>
    		<td></td>
    	</tr>
    </table>

	</form>
</body>
</html>