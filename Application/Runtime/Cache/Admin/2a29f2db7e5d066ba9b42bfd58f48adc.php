<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表</title>
</head>
<body>
<h2 align="center">用户列表</h2>
<a href="<?php echo U('User/user_add');?>">添加用户</a>
<table align="center">
	<tr>
		<td>id</td>
		<td>账号</td>
		<td>是否锁定</td>
		<td>删除</td>
		<td></td>
	</tr>
	 <?php foreach($data as $k=>$v){ ?>

	 	
	<tr>
		<td><?php echo $v['id']?></td>
		<td><?php echo $v['account']?></td>
		<td><?php if($v['lock']==1){echo "已锁定";}else{ echo"未锁定"; }?></td>
		<td><a href="<?php echo U('User/user_delete');?>?id=<?php echo $v['id']?>">删除</a></td>
		<td></td>
	</tr>
	<?php }?>
	<tr>
		<td></td>
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
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
	
</body>
</html>