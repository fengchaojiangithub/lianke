<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>金币奖励规则</title>
</head>
<body>
<form action="<?php echo U('reset');?>" method="post">
<table align="center">
	<tr>
		<th colspan="2">金币奖励规则设置</th>
	</tr>
	<tr>
		<td align="right">回答：</td>
		<td>+<input type="text" name="answer" value="<?php echo (C("answer")); ?>"></td>
	</tr>
	<tr>
		<td align="right">回答被采纳：</td>
		<td>+<input type="text" name="adopt" value="<?php echo (C("adopt")); ?>"></td>
	</tr>
	<tr>
		<td align="right">回答被删除：</td>
		<td>-<input type="text" name="del_answer" value="<?php echo (C("del_answer")); ?>"></td>
	</tr>
	<tr>
		<td align="right">提问被删除：</td>
		<td>-<input type="text" name="del_quiz" value="<?php echo (C("del_quiz")); ?>"> </td>
	</tr>
	<tr>
		<td align="right">采纳回答被删除：</td>
		<td>提问者-<input type="text" name="del_adopt_quiz" value="<?php echo (C("del_adopt_quiz")); ?>">
			回答者-<input type="text" name="del_adopt_answer" value="<?php echo (C("del_adopt_answer")); ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" value="保存修改"></td>
		
	</tr>
</table>
</form>

	
</body>
</html>