<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

          <title></title>
          <link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css"/>
          <link rel="stylesheet" type="text/css" href="/Public/Index/css/common.css"/>
          <script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
          <script type="text/javascript" src="/Public/Index/js/common.js"></script>

     </head>
     <body class="body">
     <!-- 引入头部 -->
     <div id="footer">
          <div class="center">
          <div class="logo">
                <a href="<?php echo U('Index/index');?>"><img src="/Public/Index/img/logo.jpg"/></a>   
          </div>
          <div class="navigation">
                  <span><a href="<?php echo U('Question/quiz');?>">问答</a></span>
                    <span><a href="<?php echo U('Topic/index');?>">话题</a></span>
                    <span><a href="<?php echo U('Note/index');?>">笔记</a></span>
               
                    </div>
          <div class="login">
          <table>
               <tr>
               
                    
                    <td class="t1"><img src="/Public/Index/img/fangda_03.png"  id="t1" /></td>
                    <td ><div><a href="<?php echo U('Login/login');?>">登陆</a></div><div><a href="<?php echo U('Register/register');?>">注册</a></div></td>
               </tr>
          </table>  
          </div>
          </div>
               <div id="search">
                    <input type="text"  id="sou" name="search" class="length"  value=""/>
                    <img  src="/Public/Index/img/serch_03.jpg" id="fdj" class="sear_1"/>
                    <img src="/Public/Index/img/serch_06.jpg" id="xx"/>
                    <div id="xiala">
                         <p class="p1">快速链接</p>
                         <ul class="uls">
                         
                         
                         </ul>
                         <p class="p2">查看「<span class="kuohao" style="color:red"></span>」的搜索结果</p>
                    </div>
               </div>    
     </div>
     <div class="bj"></div>
     
     <div id="footers"></div>
     
     <div class="all">
          <div class="content">
          <div class="question">        
          <ul id="uls">
              <?php foreach( $da as $key =>$val){?>
               <li  id="<?php echo $val['n_addtime']?>">

               <table>
               
               <tr>
                    <td rowspan="2" class="d1"><div class="tx_out">
                         <?php if(!$val['user_face']){?>
                    <img src="/Public/Index/img/touxiang.jpg" class="wh"/>
                    <?php }else{?>
                    <img src="/<?php echo $val['user_face']?>" width="70"  hight="70" alt="">

                    <?php }?>
                    </div>
                    </td>
                    <td class="problem" colspan="2">

                       <a href="/index.php/Home/Note/note_page?id=<?php echo $val['n_id']?>"><?php echo $val['n_title'];?></a>
                   </td>
               </tr>
               <tr>
                    <td class="d2">
                         <span class="name"><?php echo $val['user_name'];?></span>
                         <span class="time"> 
                         <?php
 echo jishuantime($val['n_addtime']); ?>
                         </span>

                         <div class="gn">
                              <span><img src="/Public/Index/img/ll.jpg"/>
                                   <kbd><?php echo $val['n_click'];?></kbd>
                              </span>
                         </div>
                    </td>
               </tr>
               </table>  
               <img src="/Public/Index/img/bj.jpg" class="status"/>
               </li>
          <?php  }; ?>
          

          </ul>
          <div><img src="/Public/Index/img/timg.gif" style="width: 350px;margin-left: 100px;display: none;" id="load"/></div>
          </div>
          <div class="listsAll">
          <div class="lists">
               <div class="title_1">
                    <p>热门话题</p>    
                    <img src="/Public/Index/img/photo_17.jpg"/>
               </div>
               <ul>
                    <li>以太坊钱包 <img src="/Public/Index/img/huo.png" class="huo"/><div class="right"><span class="right_1"><img src="/Public/Index/img/whd.jpg"/><kbd>20</kbd><span class="right_2"><img src="/Public/Index/img/bj2.jpg"/><kbd>20</kbd></span> </span> </div></li>
                   <li>去中心化交易算<div class="right"><span class="right_1"><img src="/Public/Index/img/whd.jpg"/><kbd>20</kbd><span class="right_2"><img src="/Public/Index/img/bj2.jpg"/><kbd>20</kbd></span> </span> </div></li>
               </ul>

          </div>    
          <div class="lists" id="list2">
               <div class="title_1">
                    <p>链客榜</p>
                    <img src="/Public/Index/img/photo_17.jpg"/>
                    <button type="button">周榜</button>
               </div>
          <div class="tab">
               <table>
                    <tr><td class="b1" rowspan="2"><div class="pm"><p>1</p></div><img src="/Public/Index/img/touxiang.jpg" class="tx"/></td><td class="b2" colspan="2">滑差花痴 <span><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/></span></td><td class="b3"><span style="color:#FF9900;">33323k</span></td></tr>
                    <tr><td class="b4"><img src="/Public/Index/img/whd.jpg"/><span>20</span></td><td class="b5"><img src="/Public/Index/img/bj2.jpg"/><span>40</span> </td><td class="b6"><img src="/Public/Index/img/dz.jpg"/><span>1000</span></td> </tr>
               </table>
               <table>
                    <tr><td class="b1" rowspan="2"><img src="/Public/Index/img/touxiang.jpg" class="tx"/></td><td class="b2" colspan="2">滑差花痴 <span><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/></span></td><td class="b3"><span style="color:#FF9900;">33323<img src="/Public/Index/img/k_03.jpg"/>
                </span></td></tr>
                    <tr><td class="b4"><img src="/Public/Index/img/whd.jpg"/><span>20</span></td><td class="b5"><img src="/Public/Index/img/bj2.jpg"/><span>40</span> </td><td class="b6"><img src="/Public/Index/img/dz.jpg"/><span>1000</span></td> </tr>
               </table>
               <table>
                    <tr><td class="b1" rowspan="2"><img src="/Public/Index/img/touxiang.jpg" class="tx"/></td><td class="b2" colspan="2">滑差花痴 <span><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/></span></td><td class="b3"><span style="color:#FF9900;">33323k</span></td></tr>
                    <tr><td class="b4"><img src="/Public/Index/img/whd.jpg"/><span>20</span></td><td class="b5"><img src="/Public/Index/img/bj2.jpg"/><span>40</span> </td><td class="b6"><img src="/Public/Index/img/dz.jpg"/><span>1000</span></td> </tr>
               </table>
               <table>
                    <tr><td class="b1" rowspan="2"><img src="/Public/Index/img/touxiang.jpg" class="tx"/></td><td class="b2" colspan="2">滑差花痴 <span><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/><img src="/Public/Index/img/flower.jpg"/></span></td><td class="b3"><span style="color:#FF9900;">33323k</span></td></tr>
                    <tr><td class="b4"><img src="/Public/Index/img/whd.jpg"/><span>20</span></td><td class="b5"><img src="/Public/Index/img/bj2.jpg"/><span>40</span> </td><td class="b6"><img src="/Public/Index/img/dz.jpg"/><span>1000</span></td> </tr>
               </table>
          </div>    
          </div>
          </div>
          </div>
          
     </div>
     
     
     
     <img src="/Public/Index/img/top.jpg" id="top"/>
     </body>

</html>
     <script type="text/javascript">
         //瀑布流加载
          window.onscroll =function (){       
           var t = document.documentElement.scrollTop||document.body.scrollTop;
           var ht = document.getElementsByClassName('all')[0].offsetHeight+111;
//         console.log(t);
         var wt = t+$(this).height();
          
         if(wt >= ht){
          $('#load').show();
//        页面到达底部时
         // $('#load').show();
         // $('#uls').children('li:last-child').css('background-color','red');
        var lasttime = $('#uls').children('li:last-child').attr('id');
               //alert(lasttime );
          $.ajax({
                        type:"get",
                            url:"<?php echo U('note/getmore');?>",
                            data:{lasttime:lasttime},
                            //datatype: 'JSON',
                            success: function(msg){
                            
                             for (var i = 0; i < msg.length; i++) {
                              
                                 var time=msg[i].time;
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

                                     
                                   var str='<li id='+msg[i].n_addtime+'><table><tr><td rowspan="2" class="d1"><div class="tx_out">'+user_face+face+'</div></td><td class="problem" colspan="2"><a href="/index.php/Home/Note/note_page?id='+msg[i].n_id+'">'+msg[i].n_title+'</a></td></tr><tr><td class="d2"><span class="name">'+msg[i].user_name+'</span><span class="time">'+time+'</span><div class="gn"><span><img src="/Public/Index/img/ll.jpg"/><kbd>'+msg[i].n_click+'</kbd></span><span><img src="/Public/Index/img/pl.jpg"/><kbd></kbd></span></div></td></tr></table><img src="/Public/Index/img/bj.jpg" class="status"/></li>';
                              $('#uls').append(str);
                             }


                            }
                        });
          


         } else if(t>=400){
          $('#top').show(100);
         }
          
          console.log("浏览器高："+ht);
          console.log("滚动条高："+wt);
     }
     
     $('#top').click(function (){
          document.documentElement.scrollTop = 0;
          document.body.scrollTop=0;    
          $('#top').hide(100);
          
     });


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
     <!-- 搜索公共文件 -->