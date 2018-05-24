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
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/jscss/admin/design/index" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="70">标题:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>

                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Category/insert_first"><i class="icon-font"></i>新增分类</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>分类编号</th>
                            <th>分类名称</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr id="tr<?php echo ($vo["id"]); ?>">
                            <td><input type="checkbox"></td>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["cate_name"]); ?></td>
                            <td><a class="link-del" href="javascript:void(0)" num="<?php echo ($vo["id"]); ?>">删除</a></td>
                        </tr><?php endforeach; endif; ?>
                    </table>

                    <div class="list-page"><?php echo ($page); ?></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
<script>
    $(function(){
        $('.link-del').click(function(){
        var id=$(this).attr('num');
        //alert(id);
        if(confirm('确认删除！')){
           $.ajax({
            type: "POST",
            url: "<?php echo U('Category/delete');?>",
            data: "id="+id,
            success: function(msg){
            	//alert(msg);
                if(msg=='ok'){
                   $("#tr"+id).remove(); 
                }
            }
            });
            }

        }); 
    });
</script>