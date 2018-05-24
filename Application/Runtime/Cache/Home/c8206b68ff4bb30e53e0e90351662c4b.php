<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/Index/css/loginAll.css"/>
		<script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<div id="footer">
		<div class="center">
		<div class="logo">
			<img src="/Public/Index/img/logo1.png"/>
			<img src="/Public/Index/img/logo2.png"/>
		</div>	
		</div>	
		</div>
		
		<div id="bodys">
		<div class="title">给自己起个昵称</div>	
		<div class="box_bj box_bj2">
		<form action="<?php echo U('Register/nickname_go');?>" method="post">

	    <input type="hidden" class="mobile" name="user_tel" value="<?php echo $mobile;?>">
		<input type="text" placeholder="昵称" name="user_name" class="sjh"/>
		<input type="password" placeholder="密码" name="user_password" class="psd"/>
		<button type="submit" class="yes" id="bd">确 定</button>
		</form>
		</div>
		
		</div>
	</body>
	<script type="text/javascript" src="/Public/Index/js/yzm.js"></script>
	<script type="text/javascript" src="/Public/Index/js/verification.js"></script>
	<script type="text/javascript">
	    // $(".yes").click(function(){
	    // 	var user_tel=$('.mobile').val();
	    // 	var user_name=$('.sjh').val();
	    // 	var user_password=$('.psd').val();
	    // 	//alert(user_tel);
	    // 	$.ajax(function(){
	    // 		  type: 'POST',
		   //         url: '/index.php/Home/Register/shouji',
		   //         data: {mobile:mobile},
		        
		   //         success: function(msg){
		   //           // console.log(msg);
		   //          if(msg==1)
		   //              location.href="<?php echo U('Index/index');?>";
		   //         }else{
		   //         	alert('添加失败');
		   //         }
	    // 	})
	    	 
	    // })
	</script>
</html>