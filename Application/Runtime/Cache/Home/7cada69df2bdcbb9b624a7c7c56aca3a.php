<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>添加笔记</title>
    <link rel="stylesheet" type="text/css" href="/Public/Index/css/footer.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Index/css/addQuestion.css" />
    <!-- <link rel="stylesheet" type="text/css" href="/Public/Index/css/notes.css" /> -->
    <script type="text/javascript" src="/Public/Index/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script> 
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->  
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->  

  <script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script> 

  </head>
  <body>
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
        <td class="t1"><img src="/Public/Index/img/fangda_03.png" id="t1"/></td>
        <td class="t2"><div><a>登陆</a></div><div><a>注册</a></div></td>
      </tr>
    </table>  
    </div>
    </div>  
    <div id="search">
        <input type="text"/>
        <img src="/Public/Index/img/serch_03.jpg" id="fdj"/>
        <img src="/Public/Index/img/serch_06.jpg" id="xx"/>
        <div id="xiala">
          <p class="p1">快速链接</p>
          <ul>
            <li>以太坊钱包？</li>
            <li>以太坊的工作原理？</li>
            <li>以太坊技术框架？</li>
          </ul>
          <p class="p2">查看「<span>以太坊</span>」的搜索结果</p>
        </div>
      </div>
  </div>
  <div class="bj"></div>
  <div id="footers"></div>
  
  <div class="all">
    <div class="content">
      <div class="content_new">
        <div class="inpt">
          <input type="text" placeholder="问题标题" class="inpt1"/><br />
          <!--添加话题-->
          <div class="inpt2" id="kg">
            <div class="inpt3"></div>
            <input type="text" placeholder="至少添加1个话题" name="lab_name[]" class="ht"/><img src="/Public/Index/img/sousuo_03.png" class="sousuo"/>
              <ul id="choose" class="biaoqian">
               
              </ul>
              
              <div class="ycz">
                <div><p>钱包</p><span>问题：11&nbsp;笔记：11</span></div>
                <div><p>冷钱包</p><span>问题：11&nbsp;笔记：11</span></div>
              </div>
              <div class="yzz">
                <div><span class="biao_qian">联盟链</span><button class="tjxbq">添加新标签</button></div>
              </div>
          </div>  
          

          
          <!--搜索下拉框-->
          <div class="xiala">
            <p>你可能是在找以下问题： <button type="button">关闭推荐</button> </p> 
            <ul>
              <li><p>以太坊的前途在哪？</p><span>15回答</span></li>
              <li><p>EOS,以太坊哪个更适合落地应用？</p><span>20回答</span></li>
            </ul>
            </div>
        </div>
        
        <div class="editor">
        <!-- <textarea name="info" id="info" cols="50" rows="5"></textarea> -->
         <div name="info" id="info" style="width:100%;height:300px"></div> 
        </div>
        <div class="xl">
        <img src="/Public/Index/img/jiantou_03.png" id="jiantou" />
        <span class="n_islock">展示方式</span>
        <div class="bottom">
          <p>公开笔记</p>
          <p>隐藏笔记</p>
        </div>
        
      </div>
       <img src="/Public/Index/img/true_03.jpg" id="true"  class="tianjia" style="margin:20px 0 10px 280px;"/>
        
       
      </div>
    </div>
  </div>
  </body>
  <script src="/Public/Index/js/common.js"></script>
    
  <script type="text/javascript">
    $('.navigation span:eq(2)').css('color','#00B9EF');   
    $('#jiantou').click(function (){
    $('.bottom').toggle();
  });
  $('.bottom p').click(function (){
    $('.xl span').text($(this).text());
    $('.bottom').hide();
  });


    $('.ht').click(function (event){
     event.stopPropagation();
     // 展示标签
      $('.biaoqian').children('li').remove();
            $.ajax({
                  type:"post",
                  url:"<?php echo U('Question/label_select');?>",
                              //datatype: 'JSON',
                  success: function(msg){
                           //alert(msg);
                           for (var i = 0; i < msg.length; i++) {
                               str="";
                               str+='<li id="'+msg[i].lab_id+'">'+msg[i].lab_name+'</li>';

                               $('.biaoqian').append(str);

                           }
                            
                          }

            })



      $('#choose').show();
    });



    //隐藏标签展示搜索
      $('.ht').keyup(function(){
      $('#choose').hide();
      $('.ycz').children('div').remove();
      //获取文本框长度
       var leng=$('.ht').val().length;
      // alert(leng);
          if(leng >=2){
               var lab_name=$('.ht').val();
               //alert(lab_name);
               //请求数据库
                  $.ajax({
                  type:"post",
                  url:"<?php echo U('Question/label_select_sou');?>",
                              //datatype: 'JSON',
                            data:{lab_name:lab_name},
                            success: function(m){
                             if(m){
                                for (var i = 0; i < m.length; i++) {
                                     str="";
                                     str+='<div><p>'+m[i].lab_name+'</p><span>问题：11&nbsp;笔记：11</span></div>';

                                     $('.ycz').append(str);
                                     $('.ycz').show();
                       
                                     }
                             }
                             if(m==1){
                                $('.ycz').hide();
                                //展示添加新标签
                                $('.yzz').show();
                                //展示在相应位置
                                $('.biao_qian').text(lab_name);
                              


                             }
                           
                           }

                  })

                

          }
     })
    
  


     $('body:not(.ht)').click(function (){
      $('.ycz').hide();                     
      $('.yzz').hide();
     });
    $('body:not(#kg)').click(function (){
      $('#choose').hide();
    });
      //执行添加标签
       $('.yzz').on('click','button', function (){
      // var t =$(this).index('button');
         var lab_name=$('.ht').val();
         $.ajax({
                  type:"post",
                  url:"<?php echo U('Question/label_add');?>",
                  data:{lab_name:lab_name},
                  success: function(label){
                          if(label==1){
                            alert('添加成功');
                          }
                          if(label==0){
                            alert('添加失败');
                          }
                        
                        
                            
                          }

            })
            
     
     });

  $('#kg').on('click','li',function (event){
      event.stopPropagation();
      
      $('#choose').hide();
      var bt = document.getElementsByClassName('inpt2')[0].getElementsByTagName('button');

      // alert($(this).attr('id'));
      if(bt.length == 1){
        $('.inpt3').append('<button type="button" id="lab_1" value='+$(this).attr('id')+'>'+$(this).text()+'<img src="/Public/Index/img/xx.png"/></button>');
      $('.ht').css('width','390px');
      $('.ht').attr('placeholder','点击添加第二个话题');
      }else if(bt.length == 2){
        $('.inpt3').append('<button type="button" id="lab_2" value='+$(this).attr('id')+'>'+$(this).text()+'<img src="/Public/Index/img/xx.png" /></button>');
        $('.ht').css('width','290px');
        $('.ht').attr('placeholder','点击添加第三个话题');
      }else if(bt.length == 3){
        $('.inpt3').append('<button type="button" id="lab_3" value='+$(this).attr('id')+'>'+$(this).text()+'<img src="/Public/Index/img/xx.png"/></button>');
        $('.ht').css('width','190px');
        $('.ht').attr('placeholder','');
      }     
  });
  
  $('.inpt3').on('click','button',function (){
    $(this).remove();

    var bt = document.getElementsByClassName('inpt2')[0].getElementsByTagName('button');
    if(bt.length == 1){
      $('.ht').attr('placeholder','至少添加一个话题');
      $('.ht').css('width','495px');
    }else if(bt.length == 2){
      $('.ht').attr('placeholder','点击添加第二个话题');
      $('.ht').css('width','390px');
    }else if(bt.length == 3){
        $('.ht').css('width','290px');
        $('.ht').attr('placeholder','点击添加第三个话题');
      }     
  });

  //提交数据
  $('.tianjia').click(function(){
      alert('1');    
      var n_title = $('.inpt1').val();
      var lab_1=$('#lab_1').val();
      var lab_2=$('#lab_2').val();
      var lab_3=$('#lab_3').val();
      var lab_id=new Array(lab_1,lab_2,lab_3);
      var info=UE.getEditor('info').getContent();
       var n_islock=$('.n_islock').val();
      // alert(n_islock);
     
      if ($('.xl span').text() == '公开笔记') {
          var n_islock = '1' ;
      }  
       if ($('.xl span').text() == '隐藏笔记') {
          var n_islock = '0';
      } 

    
      $.ajax({
                  type:"post",
                  url:"<?php echo U('Note/note_add_go');?>",
                  data:{n_title:n_title,lab_id:lab_id,info:info,n_islock:n_islock},
                  success: function(msg){
                     alert(msg);
                          if(msg==0){
                            alert('请先登录！');
                          }
                           if(msg==1){
                            alert('笔记标题不能为空！');
                          }
                          
                           if(msg==2){
                            alert('标签不能为空！');
                          }
                          
                           if(msg==3){
                            alert('笔记内容不能为空！');
                          }
                          
                           if(msg==4){
                            window.location.href="<?php echo U('note/index');?>";
                          }
                          
                           if(msg==5){
                            alert('添加失败！');
                          }

                        }
                          
                          
                          
            })
  })

 // 百度编辑器
   window.UEDITOR_HOME_URL = "/Public/ueditor/";  
    $(document).ready(function () {  
      UE.getEditor('info', {  
      // initialFrameHeight:300,  
      // initialFrameWidth: 500,  
      serverUrl: "<?php echo U('Note/save_info');?>"    
    });  
  }); 
  $('.whole').click(function(){
    $.ajax({
                  type:"post",
                  url:"<?php echo U('Question/whole');?>",
                  success: function(msg){
                          var money = msg['user_money'];
                          // alert(money)
                          var str = '<input type="text" id="money" name="money" class="money1" value="'+money+'"/>'
                          $('.money1').html(str);
                          }
            })
  })
  </script>
</html>