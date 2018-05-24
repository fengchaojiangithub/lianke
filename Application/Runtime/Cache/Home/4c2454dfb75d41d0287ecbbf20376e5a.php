<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人资料</title>
</head>
<body>
<h2 align="center">个人资料</h2>
<a href="{U:('User/myzoe')}">个人中心</a>

    <table align="center">
    	<tr>
    		<td>头像</td>
    		<td><img src="/<?php echo ($data['user_face']); ?>" alt="" width="50" height="50"></td>
    		<td></td>
    	</tr>
    
    	<tr>
    		<td>昵称</td>
    		<td><?php echo ($data['user_name']); ?></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>性别</td>
    		<td><?php if($data['user_sex']==0){echo '女';}else{echo '男';}?></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>职业</td>
    		<td><?php echo ($data['user_occupation']); ?></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>注册时间</td>
    		<td><?php echo date('Y-m-d H:i:s', $data['user_addtime'])?></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td>个人简介</td>
    		<td><?php echo ($data['usar_introduce']); ?></td>
    		<td></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td><a href="<?php echo U('Login/personalupdate');?>">编辑</a></td>
    		<td></td>
    	</tr>
    </table>
    <hr>
    <table><tr>
        <td>我的金币：</td>
        <td><?php echo ($data['user_money']); ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

	
</body>
</html>