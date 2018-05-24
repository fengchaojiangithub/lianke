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
        <input type="text" placeholder="手机号" name="mobile" class="sjh"/>
        <div class="yzms">
        <input type="text" placeholder="验证码" name="mobile_code" class="yzm"/>  
        <button type="button" class="yzm_bnt" id="bnt">获取验证码</button>
        </div>  
        <div class="bodys_2">
            <div class="left"><a href="<?php echo U('Login/index');?>">密码登陆</a></div>
            <div class="left"><a href="<?php echo U('Register/get_back');?>">忘记密码?</a></div>
        </div>
        <button type="button" id="bd" class="bd" style="margin-top: 0;">登 陆</button>
        <p>点击登陆即同意<a href="#">链客服务条款</a></p>
        
        <div class="img">
            <img src="/Public/Index/img/qq.png" class="qq"/>
            <img src="/Public/Index/img/weixin.png"/>
        </div>
        </div>      
        </div>
        <div class="logins">还没有账号<a href="<?php echo U('Register/register');?>">注册</a></div>
    </body>
    <script type="text/javascript" src="/Public/Index/js/yzm.js"></script>
    <script type="text/javascript" src="/Public/Index/js/verification.js"></script>
    <script type="text/javascript">
    //  var sjh = document.getElementsByClassName("sjh")[0];
    //  $('.sjh').blur(function (){
    //     checkPhone(sjh.value);
    // }); 
         $(".yzm_bnt").click(function(){
　　    var mobile = $(".sjh").val();
            //alert(mobile);
        $.ajax({
           type: 'POST',
           url: '/index.php/Home/Login/shouji',
           data: {mobile:mobile},
           datatype: 'JSON',
           success: function(msg){
             // console.log(msg);
            alert(msg);
           }
        });

        })
         $(".bd").click(function(){
             var mobile = $(".sjh").val();
             var mobile_code = $(".yzm").val();
               $.ajax({
                       type: 'POST',
                       url: "<?php echo U('login/login_tel_go');?>",
                       data: {mobile:mobile,mobile_code:mobile_code},
                       //datatype: 'JSON',
                       success: function(msg){
                           if(msg==0){
                            alert('手机号不能为空');
                           }
                            if(msg==1){
                            alert('手机格式不正确');
                           }
                            if(msg==3){
                            alert('验证码不能为空');
                           }
                            if(msg==4){
                            alert('验证码错误');
                           }
                            if(msg==5){
                            alert('手机号不存在');
                           }
                           if(msg==6){
                            window.location.href="<?php echo U('Index/index');?>";
                           }
                        
                         // console.log(msg);
                    //        if(msg==1){
                    //        alert('手机号已存在');
                    //        }
                    //        if(msg==2){
                    //        alert('验证码错误');
                    //        }
                    //          if(msg){
                    //          $(".body").html(msg);  
                    // }
                         }
                          
                        })
                })

    </script>
</html>