<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/Index/css/common.css"/>
		<script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
	</head>
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

                             	       
                                   var str='<li id='+msg[i].id+'><table><tr><td rowspan="2" class="d1"><div class="tx_out">'+user_face+face+'</div></td><td class="problem" colspan="2"><a href="/index.php/Home/Topic/question_page?id='+msg[i].id+'">'+msg[i].title+'</a>'+xuanshang+'</td></tr><tr><td class="d2"><span class="name">'+msg[i].user_name+'</span><span class="time">'+quiz_time+'</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>'+msg[i].click+'</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>'+msg[i].answer_count+'</kbd></span></div></td></tr></table><img src="/Public/Index/img/wh.png" class="status"/></li>';
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
		<ul id="ulz">
			<li>全部</li>
			<li>问题</li>
			<li>笔记</li>
			<li>话题</li>
		</ul>	
		<div id="biaoti">
			<table class="ble1">
				<tr><td><img src="/Public/Index/img/touxiang.png"/></td><td><?php echo ($label["lab_name"]); ?></td></tr>
			</table>
			<p><?php echo ($label["lab_introduce"]); ?></p>
			<table class="ble2">
				<tr>
				     <input type="hidden" class="lab_id" value="<?php echo ($label["lab_id"]); ?>">
					<td class="td1"><span class="td1_a"><img src="/Public/Index/img/wh3_03.png"/>240</span><span class="td1_b"><img src="/Public/Index/img/bj3_03.png"/>150</span></td>
					<td class="td2"><span class="blue">已有<span class="attent_number"><?php echo ($label["attent_number"]); ?></span>人关注</span><button class="ps_right">关注</button></td> 
				</tr>
			</table>
		</div>
		
		<ul id="uls">
		           <?php foreach($question as $key => $val){?>


			<li>
			<table>
			<tr>
				<td rowspan="2" class="d1">
				<div class="tx_out">

				<?php if(!$val['user_face']){?>
				<img src="/Public/Index/img/touxiang.jpg" class="wh"/>
				<?php }else{?>
				<img src="/<?php echo $val['user_face']?>" width="70"  hight="70" alt="">

				<?php }?>
				</div>
				</td>
				<td class="problem" colspan="2"><?php echo $val['title']?><!-- <div class="xuanshang"><div class="xs_left">悬赏</div><div class="xs_right"><span>10</span><img src="/Public/Index/img/k_03.jpg"/></div></div>	 -->				
				</td>
			</tr>
			<tr><td class="d2"><span class="name"><?php echo $val['user_name']?></span><span class="time"><?php echo jishuantime($val['quiz_time']); ?></span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/wh.png" class="status"/>
			</li>



			<?php }?>

			
			<li>
			<table>
			<tr><td rowspan="2" class="d1">
			<img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/whd.jpg" class="status"/>
			</li>
			
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.png" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
			
			<li>
			<table>
			<tr><td rowspan="2" class="d1"><img src="/Public/Index/img/touxiang.jpg" class="wh"/></td><td class="problem" colspan="2">区块链技术是什么？未来应用于哪些方向？</td></tr>
			<tr><td class="d2"><span class="name">画插画差</span><span class="time">3小时前</span><div class="gn"><span><img src="img/ll.jpg"/><kbd>12</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd>12</kbd></span></div></td></tr>
			</table>	
			<img src="/Public/Index/img/bj.jpg" class="status"/>
			</li>
		</ul>
		<div><img src="/Public/Index/img/timg.gif" style="width: 350px;margin-left: 100px;display: none;" id="load"/></div>
		</div>
		
		<div class="listsAll">
		<div class="lists">
			<div class="title_1">
				<p>热门话题</p>
			</div>
			<ul>
				<li>1.以太坊钱包 </li>
			    <li>2.去中心化交易算</li>
			</ul>
		</div>	
		</div>
	</div>
	<img src="img/top.jpg" id="top"/>
	<div class="bj"></div>
	</body>
	<script src="/Public/Index/js/common.js" type="text/javascript"></script>
	<script type="text/javascript">
	$('#ulz li').click(function (){
		$('#ulz li').css('color','#333333');
		$(this).css('color','#4DBDD7');
	});

		$('.ps_right').click(function(){
			
		 
          var lab_id=$('.lab_id').val();
		  //alert(lab_id);
		  $.ajax({
                  type:"post",
                  url:"<?php echo U('Topic/attention');?>",
                  data:{lab_id:lab_id},
                  success: function(msg){
                     //alert(msg);
                          if(msg==0){
                            alert('请先登录！');
                          }
                          if(msg==1){
                            alert('您已经关注啦！');
                          }
                          
                          if(msg==2){
                            alert('关注失败');
                          }
                          if(msg['status']==3){

                          var str = '<span>'+msg['attent_number']+'</span>';
                          
                           $('.attent_number').html(str);
                          }
                            
                        

                   }
                          
                          
                          
            })
			

	})
	
	</script>
</html>