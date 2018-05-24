<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

    <title></title>
    <link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Index/css/questionsAndanswers.css" />  

    <script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
  </head>

	    <!-- JQuery 引用百度编辑器 -->  
	<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script> 
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->  
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->  

  <script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>  
    <link href="/Public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" rel="stylesheet" type="text/css" />  

<script type="text/javascript" src="/Public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>   
	<body>
		<!-- 引入头部 -->
  

<div id="footer">
		<div class="center">
		<div class="logo">
			 <a href="<?php echo U('Index/index');?>"><img src="/Public/Index/img/logo.png"/></a> 	
		</div>
		<div class="navigation">
		        <span><a href="<?php echo U('Question/index');?>">问答</a></span>
				<span><a href="<?php echo U('Topic/index');?>">话题</a></span>
				<span><a href="<?php echo U('Note/index');?>">笔记</a></span>
			
				</div>
		<div class="login">
		<table>
			<tr>
			
			     
				<td class="t1"><img src="/Public/Index/img/fangda2_03.png"  id="t1" />
                 
				</td>
				
          <?php if($_COOKIE['user_name'] == ''): ?><td class="t2"><div><a href="<?php echo U('Login/login');?>">登陆</a></div><div><a href="<?php echo U('Register/register');?>">注册</a></div></td>
                
			   <?php else: ?>
                <td class="t3"><img src="/Public/Index/img/person_03.gif"/>
                <span><a href="<?php echo U('Login/personal');?>"><?php echo $_COOKIE['user_name']?> </a></span> <div><a href="<?php echo U('Login/quit');?>">注销</a></div></td><?php endif; ?>


    
        

			</tr>
		</table>	
		</div>
		</div>
			<div id="search">
				<input type="text"  id="sou" name="search" class="length"  value=""/>
				<img  src="/Public/Index/img/serch_03.png" id="fdj" class="sear_1"/>
				<img src="/Public/Index/img/serch_06.png" id="xx"/>
				<div id="xiala">
					<p class="p1">快速链接</p>
					<ul class="uls">
					
					
					</ul>
					<p class="p2">查看「<span class="kuohao" style="color:red"></span>」的搜索结果</p>
				</div>
			</div>	
	</div>
	<div class="bj"></div>

	<script>
	<!-- 搜索公共文件 -->
	    //搜索js

	  $('#t1').click(function (){
    	$('.navigation').hide();
    	$('.login').hide();
    	$('#search').show();
    	$('.bj').show();
    });
    
    $('#xx').click(function (){
    	$('.navigation').show();
    	$('.login').show();
    	$('#search').hide();
    	$('.bj').hide();
    });
    


//关键字提示

	$('#sou').keyup(function(){
            $('.uls').children('li').remove();
            //$('.lenght').children().remove();
		    var lengths = $('.length').val().length;
                  //alert(lengths);
		      if(lengths>=2){
		      	 var keys=$('.length').val();
		         $('.kuohao').text(keys);
		        $.ajax({
	                type:"post",
	                url:"<?php echo U('Index/search');?>",
	                data:{keys:keys},
	                            //datatype: 'JSON',
	                success: function(msg){
	                	 var msgs=JSON.parse(msg);
	                	 var after = "";
	                	 for(var i=0;i<msgs.length;i++){
                           after +="<li>"+msgs[i]['k_name']+"</li>";
                                }
                        
	                     $('.uls').append(after);
	                        }

	          })
	    	}
	      })	
	                //选择提示内容
	                $('.uls').on('click','li',function (){
                    $('.length').val($(this).text());
                    $('.uls').children('li').remove();
               });
	//添加关键字并搜索
	       $('.sear_1').click(function(){
      	    var keys=$('.length').val();
             
            $.ajax({
            type:"post",
                url:"<?php echo U('Index/addkeyword');?>",
                data:{keys:keys},
                success: function(msg){
                      // alert(msg);
                      if(msg==0){
                       alert('请输入');
                      }
                      if(msg==1){
                       alert('请登录');
                      }
                      if(msg==2){
                        $.ajax({
                          type:"post",
                          url:"<?php echo U('Index/indexss');?>",
                          data:{keys:keys},
                          success: function(msg){
                          	// alert(shousuo)
                          	for (var i = 0; i < msg.length; i++) {

                             	   var xuanshang='<div class="xuanshang"><div class="xs_left">悬赏</div><div class="xs_right"><span>10</span><img src="/Public/Index/img/k_03.jpg"/></div></div>';
                             	   if(msg[i].money == 0){
                             	   	   xuanshang='';
                             	   }

                             	   var quiz_time=msg[i].quiz_time;
                             	  // var host= window.location.host;
                             	      //alert(host);
                                   var user_face='<img src="/'+msg[i].user_face+'" width="70"  hight="70" alt="">';
                             	
                             	   var face='<img src="/Public/Index/img/touxiang.jpg" class="wh"/>';
                             	  // alert(user_face);
                             	   if(msg[i].user_face == ""){
                             	   		 user_face ="";
                             	   }
                             	   if(msg[i].user_face != ""){
                             	     	face ="";
                             	   }

                             	       
                                   var str='<li id='+msg[i].id+'><table><tr><td rowspan="2" class="d1"><div class="tx_out">'+user_face+face+'</div></td><td class="problem" colspan="2"><a href="/index.php/Home/Note/question_page?id='+msg[i].id+'">'+msg[i].title+'</a>'+xuanshang+'</td></tr><tr><td class="d2"><span class="name">'+msg[i].user_name+'</span><span class="time">'+quiz_time+'</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>'+msg[i].click+'</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>'+msg[i].answer_count+'</kbd></span></div></td></tr></table><img src="/Public/Index/img/wh.png" class="status"/></li>';
                             	$('.question').html(str);
                             }
                                // $('#search').hide();
                                //  if(sousuo){
                                //  $(".question").html(sousuo);  
                                //   }else{
                                //     $(".question").html('没有您要找的内容，请进行提问');
                                //   }
                          }
                            //alert(msg);

                      })

                      }else{
                        alert('重新搜索');
                      }


                          

              }
          
            })
              

      	     
    });

</script>

	
	

    

	


  
		<div id="footers"></div>
		<div class="all">
			<div class="content">
				<div class="question">
					<div class="wt">
						<div class="wt_left"><div class="tx_out">
						  <?php if($note['user_face'] != ''): ?><img src="/<?php echo ($note["user_face"]); ?>" width="70"  hight="70"/>

						  <?php else: ?> 
							<img src="/Public/Index/img/touxiang.jpg" /><?php endif; ?>
						</div>
						</div>
                        <div class="wt_right">

                        	<ul>
                        	     <input type="hidden" class="id" value="<?php echo ($note["n_id"]); ?>">
                        		<li class="wt1"><?php echo ($note["n_title"]); ?></li>
                        		<li class="wt2"><?php echo ($note["n_content"]); ?></li>
                        	    <li class="wt3">
                        	    	<div class="wt_name"><span class="wt_names"><?php echo ($note["user_name"]); ?><img src="/Public/Index/img/ly.jpg"/><img src="/Public/Index/img/ly.jpg"/> </span><span class="wt_time"><?php echo jishuantime($note['n_addtime']);?></span></div> 
                        	    	<div class="wt_paly">
                                <script type="text/javascript">
(function(){
var p = {
url:location.href, /*获取URL，可加上来自分享到QQ标识，方便统计*/
desc:'', /*分享理由(风格应模拟用户对话),支持多分享语随机展现（使用|分隔）*/
title:'', /*分享标题(可选)*/
summary:'', /*分享摘要(可选)*/
pics:'', /*分享图片(可选)*/
flash: '', /*视频地址(可选)*/
site:'', /*分享来源(可选) 如：QQ分享*/
style:'103',
width:50,
height:16
};
var s = [];
for(var i in p){
s.push(i + '=' + encodeURIComponent(p[i]||''));
}
document.write(['<a class="qcShareQQDiv" href="http://connect.qq.com/widget/shareqq/index.html?',s.join('&'),'" target="_blank">分享到QQ</a>'].join(''));
})();
</script>
<script src="http://connect.qq.com/widget/loader/loader.js" widget="shareqq" charset="utf-8"></script>


                        	    		<!-- <img src="/Public/Index/img/fx_03.jpg" id="fx"/> --><span class="wt_span1">
                                  <img src="/Public/Index/img/shoucang_03.jpg"/>

                                  <span class="Collection"><?php echo ($note["n_colle_num"]); ?></span>

                                  </span><span class="wt_span2"><img src="/Public/Index/img/ll.jpg"/><span><?php echo ($note["n_click"]); ?></span></span> 
                                  <span class="play_note">
                                  <img src="/Public/Index/img/dz.jpg"/>
                                      <span class="note_fabulous">
                                      <?php echo ($note["n_fabulous"]); ?>
                                      </span>
                                  </span>
                        	    	</div>
                        	    </li>

                        	    <li class="wt4">
                                    <?php if(is_array($label)): foreach($label as $key=>$vo): ?><span><?php echo ($vo["lab_name"]); ?></span><?php endforeach; endif; ?>
                              </li>
                        	
                        	</ul>
          </div>
			</div> 
	  </div>
  </div>  
  <a href="<?php echo U('note/note_add');?>">我也写一篇</a>                                                          
</div>
				<div class="lists">
					<div class="title_1">
						<p>相关问题</p>
					</div>
					<ul id="about">
						<li><p>区块链技术是什么？未来可能应用于哪些？</p><div><span class="xh"><img src="/Public/Index/img/xh1_03.jpg"/>10</span><span><img src="/Public/Index/img/pl.jpg"/>20</span> </div></li>
						<li><p>区块链技术是什么？未来可能应用于哪些？</p><div><span class="xh"><img src="/Public/Index/img/xh1_03.jpg"/>10</span><span><img src="/Public/Index/img/pl.jpg"/>20</span> </div></li>
					    <li><p>区块链技术是什么？未来可能应用于哪些？</p><div><span class="xh"><img src="/Public/Index/img/xh1_03.jpg"/>10</span><span><img src="/Public/Index/img/pl.jpg"/>20</span> </div></li>
					    <li><p>区块链技术是什么？未来可能应用于哪些？</p><div><span class="xh"><img src="/Public/Index/img/xh1_03.jpg"/>10</span><span><img src="/Public/Index/img/pl.jpg"/>20</span> </div></li>
					    <li><p>区块链技术是什么？未来可能应用于哪些？</p><div><span class="xh"><img src="/Public/Index/img/xh1_03.jpg"/>10</span><span><img src="/Public/Index/img/pl.jpg"/>20</span> </div></li>
					</ul>
				</div>
			</div>
		</div>

      
 
       

	</body>
    <script type="text/javascript">
    
    $('#t1').click(function (){
    	$('.navigation').hide();
    	$('.login').hide();
    	$('#search').show();
    	$('.bj').show();
    });
    
    $('#xx').click(function (){
    	$('.navigation').show();
    	$('.login').show();
    	$('#search').hide();
    	$('.bj').hide();
    });


   
    //笔记收藏
     $('.wt_span1').click(function(){
        var n_id = $('.id').val();
        //alert(n_id);
        $.ajax({
            type:"post",
                url:"<?php echo U('Note/collection');?>",
                data:{n_id:n_id},
                success: function(msg){
                 // alert(msg);
                    if(msg==3){
                         alert('您还没有登录，不能收藏');
                       }
                       if(msg==4){
                         alert('这是您自己的笔记，不能收藏');
                       }
                       if(msg['status']==1){
                         //alert('收藏成功');
                        
                         var str = '<span>'+msg['n_colle_num']+'</span>';
                         $('.Collection').html(str);

                       }
                       if(msg['status']==2){
                        
                        var str = '<span>'+msg['n_colle_num']+'</span>';
                         $('.Collection').html(str);
                       }
                      // $('.Collection').text(msg);
                       
                    }
             
             })
    })

    //笔记点赞
     $('.play_note').click(function(){
         var n_id = $('.id').val();
              
          //alert(n_id);
           $.ajax({
            type:"post",
                url:"<?php echo U('note/fabulous');?>",
                data:{n_id:n_id},
                success: function(msg){
                    //alert(msg);
                    if(msg==0){
                      alert('请先登录');
                    }
                    if(msg==1){
                      alert('这是您自己的文章，不能点赞');
                    }
                    if(msg['status']==2){
                        var str = '<span>'+msg['n_fabulous']+'</span>';
                        //alert(123);
                     $('.note_fabulous').html(str);
                    }
                    if(msg['status']==3){
                      var str = '<span>'+msg['n_fabulous']+'</span>';
                    $('.note_fabulous').html(str);
                    }
                      if(msg==4){
                      alert('您还没有点过赞');
                    }
                }
            })
     })

SyntaxHighlighter.all();  
    

    
     
    
 
    </script>
</html>