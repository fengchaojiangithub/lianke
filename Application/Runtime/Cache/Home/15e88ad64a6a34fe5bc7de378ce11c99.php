<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>找回密码</title>
</head>
<script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
<body>
<h1 align="center">找回密码</h1>
	<form id="form1" action="<?php echo U('Register/get_back_go');?>" method="post" role="form" enctype="multipart/form-data">
       
               <div class="form-group" align="center">
                    <label>手机号</label>
                    <input id="mobile" name="mobile" type="text" size="25" class="inputBg" /><span style="color:#FF0000"> *</span> 
                  <input id="dian" type="button" value=" 点击发送验证码 ">
                </div>
                <div class="form-group" align="center">
                    <label>验证码</label>
                <input type="text" size="8" name="mobile_code" class="input" />
                </div>
                <div align="center">
                <input  type="submit" class="btn btn-primary" value="确定" />
                <input id="btnClear" type="reset" class="btn btn-default" value="重置" /><a href="<?php echo U('Login/login');?>">放弃找回</a>
                </div>

   
</form>	
</body>
<script>
    $("#dian").click(function()

{
　　var mobile = $("#mobile").val();
             //alert(tel);
        $.ajax({
           type: 'POST',
           url: '/index.php/Home/Register/shouji',
           data: {mobile:mobile},
           datatype: 'JSON',
           success: function(msg){
             // console.log(msg);
            alert(msg);
           }
        });

})
    $(".btn").click(function(){
        if($('.input').val()==""){
         alert('验证码不能为空');
        }
    });
</script>
</html>