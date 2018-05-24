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

                             	       
                                   var str='<li id='+msg[i].id+'><table><tr><td rowspan="2" class="d1"><div class="tx_out">'+user_face+face+'</div></td><td class="problem" colspan="2"><a href="/index.php/Home/Question/question_page?id='+msg[i].id+'">'+msg[i].title+'</a>'+xuanshang+'</td></tr><tr><td class="d2"><span class="name">'+msg[i].user_name+'</span><span class="time">'+quiz_time+'</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>'+msg[i].click+'</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>'+msg[i].answer_count+'</kbd></span></div></td></tr></table><img src="/Public/Index/img/wh.png" class="status"/></li>';
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
						   <?php if($ques['user_face'] != ''): ?><img src="/<?php echo ($ques["user_face"]); ?>" width="70"  hight="70"/>

						     <?php else: ?> 
							<img src="/Public/Index/img/touxiang.jpg" /><?php endif; ?>
						</div>
						</div>
                        <div class="wt_right">

                        	<ul>
                        	     <input type="hidden" class="id" value="<?php echo ($ques["id"]); ?>">
                        		<li class="wt1"><?php echo ($ques["title"]); ?></li>
                        		<li class="wt2"><?php echo ($ques["content"]); ?></li>
                        	    <li class="wt3">
                        	    	<div class="wt_name"><span class="wt_names"><?php echo ($ques["user_name"]); ?><img src="/Public/Index/img/ly.jpg"/><img src="/Public/Index/img/ly.jpg"/> </span><span class="wt_time"><?php echo jishuantime($ques['quiz_time']);?></span></div> 
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

                                  <span class="Collection"><?php echo ($ques["colle_num"]); ?></span>

                                  </span><span class="wt_span2"><img src="/Public/Index/img/ll.jpg"/><span><?php echo ($ques["click"]); ?></span></span><span class="wt_span3"><img src="/Public/Index/img/pl.jpg"/><span><?php echo ($ques["answer_count"]); ?></span></span> 
                        	    	</div>
                        	    </li>

                        	    <li class="wt4">
                                    <?php if(is_array($label)): foreach($label as $key=>$vo): ?><span><?php echo ($vo["lab_name"]); ?></span><?php endforeach; endif; ?>
                              </li>
                        	    <li class="wt5">
                        	     <button type="button" class="but">我来回答</button>
                                <button type="button" class="invitation">邀请他人</button>
                        	    </li>
                              
                        	</ul>
                        </div>
					</div>
                    <div class="wt top" id="text" style="display:none">
                    	<div class="texts">
                    	  <!-- <textarea name="info" class="info" id="info" cols="30" rows="10"></textarea>  -->
                      <div class="info" id="info" style="width:100%,height:300px"></div>           		
                    	</div>
                    	<div class="true"><button type="button">确 认</button></div>
                    </div> 
                    <!--问题列表-->
                    <?php if(is_array($answer_caina)): foreach($answer_caina as $k=>$cai): ?><div class="wt top">
             
              <div class="wt_left">
              <?php if($cai['user_face'] != ''): ?><img src="/<?php echo ($cai["user_face"]); ?>" width="70"  hight="70"/>
                  <?php else: ?> 
                  <img src="/Public/Index/img/touxiang.jpg" /><?php endif; ?>
						  </div>	
						<div class="wt_pl">
						    <p class="wt1"><?php echo ($cai["user_name"]); ?></p>
						    <p class="wt2"><?php echo ($cai["answer_content"]); ?></p>
						    <p class="play"><span class="play_1"><img src="/Public/Index/img/dz.jpg"/><?php echo ($cai["answer_fabulous"]); ?></span><span class="play_2"><img src="/Public/Index/img/pl.jpg"/><?php echo ($cai["answer_fabulous"]); ?></span></p>
						</div>

						<div class="cn">已采纳</div>
            </div><?php endforeach; endif; ?>
                      <?php if(is_array($answer)): foreach($answer as $k=>$vo): ?><div class="wt top">
                        <div class="wt_left">
                            <div class="tx_out">
	                <?php if($vo['user_face'] != ''): ?><img src="/<?php echo ($vo["user_face"]); ?>" width="70"  hight="70"/>
							    <?php else: ?> 
								  <img src="/Public/Index/img/touxiang.jpg" /><?php endif; ?>
							</div>
						</div>	
						<div class="wt_pl">
                <input type="hidden" class="a_id" value="<?php echo ($vo["id"]); ?>">
						    <p class="wt1"><?php echo ($vo["user_name"]); ?></p>
						    <p class="wt2"><?php echo ($vo["answer_content"]); ?></p>
               
                  
                
                  <?php if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] == $ques["quid"]): ?><a href="<?php echo U('Answer/adopt', array('id' => $vo['id'], 'qid' => $ques['id'], 'auid' => $vo['user_id']));?>">采纳</a><?php endif; ?>
             
            
						    <p class="play"><span class="play_answer">
                <img src="/Public/Index/img/dz.jpg"/>

               <span class="anfabulous"> <?php echo ($vo["answer_fabulous"]); ?> </span>












               </span><span class="play_2"><img src="/Public/Index/img/pl.jpg"/>

               <?php echo count($vo['comment']);?></span></p>

						</div>
                    </div>
                    <div class="next">

                      <?php foreach($vo['comment'] as $key => $val){?>
                       <hr>
                      <div class="wt">

                        <div class="wt_left">
                        	<div class="tx_out">
	                            <?php if($val['user_face'] != ''): ?><img src="/<?php echo $val['user_face'];?>" width="70"  hight="70"/>

							     <?php else: ?> 
								<img src="/Public/Index/img/touxiang.jpg" /><?php endif; ?>
							</div>
							
						</div>	
						<div class="wt_pl">
















            <input type="hidden" class="c_id" value="<?php echo $val['id']?>">










						    <p class="wt1"> <?php echo $val['id']?> 
                <?php echo $val['user_name'];?></p>
						    <p class="wt2"><?php echo $val['comment_content'];?></p>
						    <p class="play">
                <span class="play_comment">
                <img src="/Public/Index/img/dz.jpg"/>
                <span class="comment_fabulous">
                <?php echo $val['comment_fabulous'];?>
                </span>
                </span>
                <span class="play_2">
                <img src="/Public/Index/img/pl.jpg"/>12</span>
                </p>

						</div>
                      </div>
                     <?php }?>
                     
                    </div><?php endforeach; endif; ?>
                    
                    
                     
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

        <div class="bj"></div>


        <div id="tc" style="width:600px;height:500px;background-color:#ffffff;position:fixed;top:50%;left:50%;margin-left:-300px;margin-top:-250px;z-index:9;display:none">
        <div id="gb">×</div>
        <span class="yq"></span>
        <table class="tab"></table>



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

//百度编辑器
    window.UEDITOR_HOME_URL = "/Public/ueditor/";  
    $(document).ready(function () {  
      UE.getEditor('info', {  
       initialFrameHeight: 200,  
      // initialFrameWidth: 800,  
      serverUrl: "<?php echo U('Question/save_info');?>"    
    });  
  }); 
    //点击展示输入框
    $('.but').click(function(){

    	$('#text').toggle();
    	$('.true').click(function(){
           var id =$('.id').val();
           var info=UE.getEditor('info').getContent()
           
             $.ajax({
            type:"post",
                url:"<?php echo U('Answer/answer');?>",
                data:{id:id,info:info},
                success: function(msg){
                     	  if(msg=="5"){
                		   alert('这是您自己提问的问题，不能回答');
             	          }	
		             	  if(msg=="4"){
		             	  	alert('请先登录');
		             	  }
		                  if(msg=="3"){
		                   alert('您已回答过');
		                  }
		                  if(msg=='1'){
		                  	alert('回答成功')
		                      location.href="<?php echo U('Index/index');?>";
		                  }else{
		                      alert("回答失败");
                              window.history.back(-1);
		                }
              }
            // });
    })
    })
    	})
    //邀请回答
      //弹出邀请回答
$('.invitation').click(function(){
$('#tc').show();
$('.bj').show(); 
    $.ajax({
      type:"post",
      url:"<?php echo U('User/invitation');?>",
      success: function(msg){
                 //alert(msg);    
            if(msg==1){
            alert('请先登录');
            }
            var table="";
            table+="<table border='1' align='center'>";
            for (var i = 0; i < msg.length; i++){
            var user_face='<img src="/'+msg[i].user_face+'" width="70"  hight="70" alt="">';
            table+="<tr>";
            table+='<td><input type="hidden" class="user_id" value="'+msg[i].user_id+'" /></td>';
            table+='<td>'+user_face+'</td>';
            table+="<td>"+msg[i]['user_name']+"</td>";
            table+="<td><span class='yao'>邀请回答</span></td>";
            table+="</tr>"
                         // alert(msg[i]['user_name']);
            }
            table+="</table>";
            $('.tab').html(table);
                          

        }

               


    })  
})

//执行邀请回答
$('#tc').on('click','.yao',function(){
  var t =  $(this).index('.yao');
  var yao_id=$('.user_id:eq('+t+')').attr('value');
  var q_id=$('.id').val();

    // alert(q_id);
$.ajax({
      type:"post",
      url:"<?php echo U('User/yaoqing');?>",
      data:{yao_id:yao_id,q_id:q_id},
      success: function(m){
      // alert(m);
                if(m['status']==1){
                  var str='<span style="color:red">您成功邀请了'+m['username']+',请等待回答</span>';
                  $('.yq').html(str);
                }
                if(m['status']==2){
                  var str='<span style="color:red">邀请'+m['username']+'失败</span>';
                  $('.yq').html(str);
                }
                if(m['status']==3){
                  var str='<span style="color:red">你取消了对'+m['username']+'邀请</span>';
                  $('.yq').html(str);
                }
                if(m['status']==4){
                  var str='<span style="color:red">取消失败</span>';
                  $('.yq').html(str);
                }
               
                          }
                            
      })
});


       $('#gb').click(function(){
         $('#tc').hide();
         $('.bj').hide(); 
         
      })
    
    //收藏
     $('.wt_span1').click(function(){
        var q_id = $('.id').val();
        //alert(q_id);
        $.ajax({
            type:"post",
                url:"<?php echo U('Question/Collection');?>",
                data:{q_id:q_id},
                success: function(msg){
                 // alert(msg['status'])
                    if(msg==3){
                         alert('您还没有登录，不能收藏');
                       }
                       if(msg==4){
                         alert('这是您自己提问的问题，不能收藏');
                       }
                       if(msg['status']==1){
                         //alert('收藏成功');
                        
                         var str = '<span>'+msg['colle_num']+'</span>';
                         $('.Collection').html(str);

                       }
                       if(msg['status']==2){
                        
                        var str = '<span>'+msg['colle_num']+'</span>';
                         $('.Collection').html(str);
                       }
                      // $('.Collection').text(msg);
                       
                    }
             
             })
    })

    //回答点赞
     $('.play_answer').click(function(){
         // var a_id=$('.a_id').val();
          var t =  $(this).index('.play_answer');
          var a_id=$('.a_id:eq('+t+')').attr('value');
          //alert(a_id);
           $.ajax({
            type:"post",
                url:"<?php echo U('Answer/fabulous');?>",
                data:{a_id:a_id},
                success: function(msg){
                    
                    if(msg==0){
                      alert('请先登录');
                    }
                    if(msg==1){
                      alert('这是您自己的回答，不能点赞');
                    }
                    if(msg['status']==2){
                        var str = '<span>'+msg['answer_fabulous']+'</span>';
                        //alert(123);
                     $('.anfabulous:eq('+t+')').html(str);
                    }
                    if(msg['status']==3){
                      var str = '<span>'+msg['answer_fabulous']+'</span>';
                    $('.anfabulous:eq('+t+')').html(str);
                    }
                      if(msg==4){
                      alert('您还没有点过赞');
                    }
                }
            })
     })

     //评论点赞
     $('.play_comment').click(function(){
     

       // var c_id = $('.play_comment').attr('c_id');
       //alert(c_id);
       //循环获取id
      var t =  $(this).index('.play_comment');
      var c_id=$('.c_id:eq('+t+')').attr('value');
            $.ajax({
            type:"post",
                url:"<?php echo U('Comment/fabulous');?>",
                data:{c_id:c_id},
                success: function(msg){
                     if(msg==0){
                      alert('请先登录');
                    }
                    if(msg==1){
                      alert('这是您自己的评论，不能点赞');
                    }
                    if(msg['status']==2){
                        var str = '<span>'+msg['comment_fabulous']+'</span>';
                        //alert(123);
                     $('.comment_fabulous:eq('+t+')').html(str);
                    }
                    if(msg['status']==3){
                      var str = '<span>'+msg['comment_fabulous']+'</span>';
                    $('.comment_fabulous:eq('+t+')').html(str);
                    }
                      if(msg==4){
                      alert('您还没有点过赞');
                    }
                }   
         
     })
            })
    

    
     
    
 
    </script>
</html>