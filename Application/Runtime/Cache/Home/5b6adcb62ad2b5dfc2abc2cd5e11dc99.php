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
			<img src="/Public/Index/img/logo.png"/>
			
		</div>	
		</div>	
		</div>
		
		<div id="bodys">
		<div class="title">登陆</div>	
		<div class="box_bj">
		<input type="text" placeholder="手机号" name="user_tel" class="sjh"/>
		<input type="password" placeholder="密码" name="user_password" class="psd"/>
		<div class="bodys_2">
			<div class="left"><a href="<?php echo U('Login/login_tel');?>">手机验证登陆</a></div>
			<div class="right"><a href="<?php echo U('Register/get_back');?>">忘记密码?</a></div>
		</div>
		<button type="button" id="bd" class="bd" style="margin-top: 0;">登 陆</button>
		<p>点击登陆即同意<a href="#">链客服务条款</a></p>
		
		<div class="img">
			<img src="/Public/Index/img/qq.png" class="qq"/>
			<img src="/Public/Index/img/weixin.png"/>
		</div>
		</div>		
		</div>
		<div class="logins">还没有账号<a href="<?php echo U('Register/index');?>">注册</a></div>
	</body>
	<!-- <script src="/Public/Index/js/verification.js" type="text/javascript"></script> -->
    <script type="text/javascript">
   // var sjh = document.getElementsByClassName("sjh")[0];
   // $('.sjh').blur(function (){
   //    	checkPhone(sjh.value);
   //  });
   //  var psd = document.getElementsByClassName("psd")[0];
   // $('.psd').blur(function (){
   //    	checkePWD(psd.value);
   //  });
     $('.bd').click(function(){
     	var tel=$('.sjh').val();
     	var password=$('.psd').val();
     	  $.ajax({
            type:"post",
                url:"<?php echo U('Login/login_go');?>",
                data:{tel:tel,password:password},
                success: function(msg){
                	if(msg==0){
                		alert('用户名和密码不能为空');
                	}
                	if(msg==1){
                		alert('手机号错误');
                	}
                	if(msg==2){
                		alert('密码错误');
                	}
                	if(msg==3){
                		 window.location.href="<?php echo U('Index/index');?>";
                	}
                }
        })
     	  })
     
    </script>
</html>