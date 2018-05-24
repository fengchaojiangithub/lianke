<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <script src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>
    <!-- 顶部 -->
    <div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="/Home" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="<?php echo U('Index/self');?>">个人资料</a></li>
                <li><a href="<?php echo U('Index/alter');?>">修改密码</a></li>
                <li><a href="<?php echo U('Login/quit');?>">退出</a></li>
            </ul>
        </div>
    </div>
</div>
    <!-- 顶部结束 -->
<div class="container clearfix">
    <!-- 左侧 -->
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                       <!--  <li><a href="<?php echo U('Design/index');?>"><i class="icon-font">&#xe008;</i>作品管理</a></li>
                        <li><a href="<?php echo U('Text/index');?>"><i class="icon-font">&#xe005;</i>博文管理</a></li> -->
                     <!--    <li><a href="<?php echo U('Type/index');?>"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="<?php echo U('Message/index');?>"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="{<?php echo U('Category/category_add');?>"><i class="icon-font">&#xe012;</i>评论管理</a></li> -->
                        <li><a href="<?php echo U('User/user_add');?>"><i class="icon-font">&#xe017;</i>添加用户</a></li>
                        <li><a href="<?php echo U('User/user');?>"><i class="icon-font">&#xe033;</i>用户列表</a></li>
                        <li><a href="<?php echo U('Category/category_add');?>"><i class="icon-font">&#xe033;</i>添加分类</a></li>
                        <li><a href="<?php echo U('Category/category');?>"><i class="icon-font">&#xe033;</i>分类列表</a></li>
                        <li><a href="<?php echo U('Reward/index');?>"><i class="icon-font">&#xe033;</i>金币奖励规则</a></li>
                        <li><a href="<?php echo U('Reward/level');?>"><i class="icon-font">&#xe033;</i>经验级别规则</a></li>


                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu"><!-- <i class="icon-font">&#xe037;</i> -->
                        <li><a href="<?php echo U('Role/index');?>"><i class="icon-font">&#xe046;</i>身份管理</a></li>
                        <li><a href="<?php echo U('AddUser/manage');?>"><i class="icon-font">&#xe046;</i>分配权限</a></li>
                        <li><a href="<?php echo U('AddUser/nodel');?>"><i class="icon-font">&#xe046;</i>节点管理</a></li>
                        <li><a href="#"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧结束 -->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Index/index');?>">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?php echo U('index');?>">分类管理</a><span class="crumb-step">&gt;</span><span>新增分类</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="<?php echo U('Category/category_add_go');?>" method="post">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>分类名称：</th>
                                <td>
                                    <input class="common-text required" size="50" type="text" name="cate_name" id="type"><span id="con_id"></span>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <span id="sub_id"></span>
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
<script>
    $(function(){
        var fal=false;
        $('#type').blur(function(){
            var cat=$(this).val();
            if(cat==""||cat==null){
                $('#con_id').html("不能为空！");
                $('#con_id').css("color","red");
                fal=false;
            }else{
                $('#con_id').html("√");
                $('#con_id').css("color","green");
                fal=true;
            }
        });
        $('form').submit(function(){
            if(fal){
                return true;
            }else{
                $('#sub_id').html("内容有误！");
                $('#sub_id').css("color","red");
                return false;
            }
        });
    });
</script>