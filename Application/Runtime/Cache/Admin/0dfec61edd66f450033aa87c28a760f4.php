<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <script src="/Public/Admin/js/jquery-3.3.1.min.js"></script>
    <link href="/Public/Admin/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>管理员登录</h1>
    <div class="adming_login_border">
        <div class="admin_input">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" id="user" size="40" class="admin_input_style" />
                    </li><span id="user_id"></span>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="pwd" id="pwd" size="40" class="admin_input_style" />
                        <span id="pwd_id"></span>
                    </li>
                    <li>
                        <label for="code">验证码：</label>
                        <input type="text" name="code" id="code" size="40" class="admin_input_style" />
                        <span id="code_id"></span>
                        <img style="margin-top: 10px;" id="m_code"  src="<?php echo U('Login/verify');?>" class="m" onclick="One(this)">
                    </li>
                    <li>
                        <input type="button" tabindex="3" value="提交" class="btn btn-primary" id="sub" />
                        <span id="button_id"></span>
                    </li>
                </ul>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="<?php echo U('Index/index');?>">返回首页</a> &copy; 2018<a href="#" target="_blank"></a></p>
</div>
</body>
</html>
<script>
    $('#user').blur(function user(){
        var user=$('#user').val();
        if(user==""){
            $('#user_id').html('不能为空');
            $('#user_id').css('color','red');
        }else{
            $('#user_id').html('√');
            $('#user_id').css('color','green');
        }
    });
    $('#pwd').blur(function pwd(){
        var pwd=$('#pwd').val();
        if(pwd==""){
            $('#pwd_id').html('不能为空');
            $('#pwd_id').css('color','red');
        }else{
            $('#pwd_id').html('√');
            $('#pwd_id').css('color','green');
        }
    });
    $('#code').blur(function code(){
        var code=$('#code').val();
        if(code==""){
            $('#code_id').html('不能为空');
            $('#code_id').css('color','red');
        }else{
            $('#code_id').html('√');
            $('#code_id').css('color','green');
        }
    });
    $('#sub').click(function(){   
        var user=$('#user').val();
        var pwd=$('#pwd').val();
        var code=$('#code').val();
        if(user!=""&pwd!=""){
            $.ajax({
                type:"post",
                url:"<?php echo U('Login/login_go');?>",
                data:{user:user,pwd:pwd,code:code},
                //alert(msg);
                success: function(msg){
                    if(msg=='ok'){
                        location.href="<?php echo U('Index/index');?>";
                    }else{
                        alert('登录失败');
                    }
                }
            });
        }else{
            $('#button_id').html('输入有误');
            $('#button_id').css('color','red');
        }
    });


    function One(obj){
    obj.src="/index.php/Admin/Login/Verify/"+Math.random();
    }  


</script>