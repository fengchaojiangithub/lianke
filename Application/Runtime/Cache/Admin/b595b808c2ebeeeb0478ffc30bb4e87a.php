<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
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
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到链客行后台管理</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>快捷操作</h1>
            </div>
            <div class="result-content">
                <div class="short-wrap">
                    <a href="<?php echo U('Design/insert_first');?>"><i class="icon-font">&#xe001;</i>新增作品</a>
                    <a href="<?php echo U('Text/insert_first');?>"><i class="icon-font">&#xe005;</i>新增博文</a>
                    <a href="<?php echo U('Type/insert_first');?>"><i class="icon-font">&#xe048;</i>新增分类</a>
                    <a href="<?php echo U('Comment/index');?>"><i class="icon-font">&#xe01e;</i>作品评论</a>
                </div>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>系统基本信息</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">当前登录用户</label><span class="res-info">WINNT</span>
                    </li>
                    <li>
                        <label class="res-lab">运行环境</label><span class="res-info">Apache/2.2.21 (Win64) PHP/5.3.10</span>
                    </li>
                    <li>
                        <label class="res-lab">PHP运行方式</label><span class="res-info">apache2handler</span>
                    </li>
                    <li>
                        <label class="res-lab">静静设计-版本</label><span class="res-info">v-0.1</span>
                    </li>
                    <li>
                        <label class="res-lab">上传附件限制</label><span class="res-info">2M</span>
                    </li>
                    <li>
                        <label class="res-lab">北京时间</label><span class="res-info"></span>
                    </li>
                    <li>
                        <label class="res-lab">服务器域名/IP</label><span class="res-info">localhost [ 127.0.0.1 ]</span>
                    </li>
                    <li>
                        <label class="res-lab">Host</label><span class="res-info">127.0.0.1</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>使用帮助</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">官方交流网站：</label><span class="res-info"><a href="http://user.qzone.qq.com/913737303/infocenter?ptsig=fwuIGucgSq7VB3N8vMjtbG8F-lEbvyN44NaOi-8MrHw_" title="有主机上线设计" target="_blank">jscss.me</a></span>
                    </li>
                    <li>
                        <label class="res-lab">官方交流QQ群：</label><span class="res-info"><a class="qq-link" target="_blank" href="http://user.qzone.qq.com/913737303/infocenter?ptsig=fwuIGucgSq7VB3N8vMjtbG8F-lEbvyN44NaOi-8MrHw_"><img border="0" src="#" alt="JS-前端开发" title="JS-前端开发"></a> </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>