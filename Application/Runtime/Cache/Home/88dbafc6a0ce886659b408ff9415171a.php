<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章详情页</title>
</head>
<link href="/Public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" rel="stylesheet" type="text/css" />  

<script type="text/javascript" src="/Public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>  


<body>
<h3 align="center"><?php echo ($data["n_title"]); ?></h3>
<table align="right">
	<tr>
		<td>所属分类：</td>
		<td><?php echo ($cat_name["cate_name"]); ?></td>
		<td>标签：</td>
		<td><?php foreach($lab_name as $k =>$v){ echo $v['lab_name']; } ?></td>
		<td>发布人：</td>
		<td><?php echo ($data["user_name"]); ?></td>
	</tr>
	
</table>
<br>
<div align="center" width="50%"><?php echo ($data["n_content"]); ?></div>
	
</body>
</html>
<script type="text/javascript">      

SyntaxHighlighter.all();       

</script>