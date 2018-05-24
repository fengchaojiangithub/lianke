<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/Index/css/loginAll.css"/>
        <script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
    </head>
    <body class="body">
        <div id="footer">
        <div class="center">
        <div class="logo">
            <img src="/Public/Index/img/logo.png"/>
           
        </div>  
        </div>  
        </div>
        
        <div id="bodys">
        <div class="title">注册</div> 
        <div class="box_bj box_bj2">
        <input type="text" placeholder="手机号" name="mobile" class="sjh"/>
        <div class="yzms">
        <input type="text" placeholder="验证码" name="mobile_code" class="yzm"/>  
        <button type="button" class="yzm_bnt" id="bnt">获取验证码</button>
        </div>  
        <button type="button" class="but" id="bd">注 册</button>
        <p>点击绑定即同意<a href="#">链客服务条款</a></p>
        </div>      
        </div>
        <div class="logins">已有账号<a href="http://127.0.0.1:8020/%E9%93%BE%E5%AE%A2PC/login.html?__hbt=1525685028779#">登陆</a></div>
    </body>
    <script type="text/javascript" src="/Public/Index/js/yzm.js"></script>
    <script type="text/javascript" src="/Public/Index/js/verification.js"></script>
    <script type="text/javascript">
           $(".yzm_bnt").click(function(){
　　    var mobile = $(".sjh").val();
            //alert(mobile);
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
            $(".but").click(function(){
             var mobile = $(".sjh").val();
             var mobile_code = $(".yzm").val();
               $.ajax({
                       type: 'POST',
                       url: "<?php echo U('Register/reg_go');?>",
                       data: {mobile:mobile,mobile_code:mobile_code},
                       //datatype: 'JSON',
                       success: function(msg){
                         // console.log(msg);
                           if(msg==1){
                           alert('手机号已存在');
                           }
                           if(msg==2){
                           alert('验证码错误');
                           }
                             if(msg){
                             $(".body").html(msg);  
                    }
                        }
                          
                        })
                })

       
    </script>
</html>