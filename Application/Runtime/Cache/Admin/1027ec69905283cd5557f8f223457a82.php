<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>经验级别规则设置</title>
</head>
<body>
<form action="<?php echo U('reset');?>" method="post">
	<table align="center">
	    <tr>
			<th colspan="2">经验级别规则设置</th>
			
		</tr>
		<tr>
			<td>登录：</td>
			<td>+<input type="text" name="le_login" value="<?php echo (C("le_login")); ?>"></td>
			<td></td>
		</tr>
		<tr>
			<td>提问：</td>
			<td>+<input type="text" name="le_quiz" value="<?php echo (C("le_quiz")); ?>"></td>
			<td></td>
		</tr>
		<tr>
			<td>回答：</td>
			<td>+<input type="text" name="le_answer" value="<?php echo (C("le_answer")); ?>"></td>
			<td></td>
		</tr>
		<tr>
			<td>采纳：</td>
			<td>+<input type="text" name="le_adopt" value="<?php echo (C("le_adopt")); ?>"></td>
			<td></td>
		</tr>
		<tr>
			<td>被赞：</td>
			<td>+<input type="text" name="le_good" value="<?php echo (C("le_good")); ?>"></td>
			<td></td>
		</tr>
	
	</table>
	<table align="center">
	    <tr>
			<th colspan="10">各等级所需经验</th>
	    </tr>
		<tr>
			<td>LV1:</td>
			<td><input type="text" name="LV1" value="<?php echo (C("LV1")); ?>"></td>
			<td>LV2:</td>
			<td><input type="text" name="LV2" value="<?php echo (C("LV2")); ?>"></td>
		
			<td>LV3:</td>
			<td><input type="text" name="LV3" value="<?php echo (C("LV3")); ?>"></td>	
			<td>LV4:</td>
			<td><input type="text" name="LV4" value="<?php echo (C("LV4")); ?>"></td>
			<td>LV5:</td>
			<td><input type="text" name="LV5" value="<?php echo (C("LV5")); ?>"></td>
		</tr>
		<tr>
			<td>LV6:</td>
			<td><input type="text" name="LV6" value="<?php echo (C("LV6")); ?>"></td>
			<td>LV7:</td>
			<td><input type="text" name="LV7" value="<?php echo (C("LV7")); ?>"></td>
			<td>LV8:</td>
			<td><input type="text" name="LV8" value="<?php echo (C("LV8")); ?>"></td>
			<td>LV9:</td>
			<td><input type="text" name="LV9" value="<?php echo (C("LV9")); ?>"></td>
			<td>LV10:</td>
			<td><input type="text" name="LV10" value="<?php echo (C("LV10")); ?>"></td>
		</tr>
		<tr>
			<td colspan="10" align="center">
				<input type="submit" value="保存修改">
			</td>
		</tr>

 

	</table>
</form>
</body>
</html>