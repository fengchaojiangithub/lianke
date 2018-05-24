<?php
namespace Home\Controller;
use Think\Controller;
class QuestionController extends Controller {
    public function index(){
         $da=M('question')
          ->join('lk_user on lk_question.quid=lk_user.user_id')
          ->where($where)
          ->order('id desc')
          ->limit(5)
          ->select();
          
        foreach($da as $k =>$v){
             $answer=M('answer')->where('qid='.$v['id'])->select();
                $da[$k]['answer_count']=count($answer);
        }
   // print_r($da);die;
      
        $this->assign('list',$da);
  
      $result = M("comment")
        ->join("lk_user on lk_comment.cuid=lk_user.user_id")
        ->order("comment_time desc")
        ->select();
      // print_r($result);die;
        $this->assign('data',$result);
        $this->display();
    }


    /**
     * 获取一次请求的数据
     * @return [type] [description]
     */
         public function getmore(){  
      //获取最后一个id 
      $lastid=I('get.lastid');
        // print_r($lastid);
      if(!empty($lastid)){
        $where['id'] = array('lt', $lastid);  
      

        $data=M('question')
          ->join('lk_user on lk_question.quid=lk_user.user_id')
          ->where($where)
          ->order('id desc')
          ->limit(5)
          ->select();
            }


        foreach($data as $key =>$val){
                $data[$key]['quiz_time']=jishuantime($val['quiz_time']);
        }
           foreach($data as $k =>$v){
             $answer=M('answer')->where('qid='.$v['id'])->select();
                $data[$k]['answer_count']=count($answer);
        }
          //print_r($data);die;
        
      $this->ajaxReturn($data); 
      }


    /**
     * 问题详情
     * [question_page description]
     * @return [type] [description]
     */
    public function question_page(){
        $id=$_GET['id'];
        //print_r($id);die;
        //问题
        $ques=M('question')
        ->join('lk_user on lk_user.user_id=lk_question.quid')
        ->where("id=$id")
        ->find();
          //查询标签
         $lab=M('question')->where("id=$id")->find();
          $lab_id=explode(',', $lab['lab_id']);
          $aa['lab_id']=$lab_id;
        // print_r($aa);die;
        foreach ($aa as $key => $value) {
          // print_r($value);die;
          $where['lab_id'] = array('in',$value);
          $label=M('label')->where($where)->select();
        }
        // print_r($label);die;
        // 
           //已采纳
          $where_cai = array('qid' => $id, 'lk_answer.adopt' => 1);
          $answer_caina = M('answer')
                ->where($where_cai)
                ->join('lk_user on lk_user.user_id=lk_answer.auid')
                ->field("answer_fabulous,user_id,user_name,user_face,id,qid,answer_content,lk_answer.adopt")
                ->select();

             //  print_r($answer_caina);die;
          
         $answer=M('answer')->where('qid='.$ques['id'])->select();
         $ques['answer_count']=count($answer);
        //print_r($ques);die;
    
         //点击量
         M('question')->where("id=$id")->setInc('click');

        $where_adopt=array('qid' => $id, 'lk_answer.adopt' => 0);
        $answer = M('answer')
                ->where($where_adopt)
                ->join('lk_user on lk_user.user_id=lk_answer.auid')
                ->select();
                //print_r($answer);die;
        $wherestr="";

        foreach($answer as $key=>$val){
        $wherestr=",".$val['id'];
        }
        $wherestr=trim($wherestr,",");
       // print_r($wherestr);die;
        $comment=M("comment")
                ->join('lk_user on lk_user.user_id=lk_comment.cuid')
                ->where(array("aid"=>array("in",$wherestr)))
                ->field("comment_fabulous,comment_content,comment_time,cuid,user_name,user_face,id,qid,aid")
                ->select();

        //print_r($comment);die;
        $comment_temp=[];
        foreach($comment as $com=>$ment){
                $comment_temp[$ment['aid']][]=$ment;
        }
        foreach($answer as $keys=>$vals){
                if(isset($comment_temp[$vals['id']])){
                  $answer[$keys]['comment']=$comment_temp[$vals['id']];
                }else{
                  $answer[$keys]['comment']="";
                }
         }

       //print_r($answer);die;
        //问题详情
        $this->assign('ques',$ques);
        //标签
        $this->assign('label',$label);
        $this->assign('answer_caina',$answer_caina);
        //回复和评论
        $this->assign('answer',$answer);
     
        $this->display();

    }

    


	//提问视图
    public function Quiz(){
         //获取用户的金币
         $where=[
           'user_id'=>$_COOKIE['user_id']
           ];
           $data=M('user')->where($where)->find();
           //print_r($data);die;
           $this->assign('data',$data);

        $this->display();
    }
    public function save_info(){  
    $ueditor_config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("./Public/Ueditor/php/config.json")), true);  
    $action = $_GET['action'];  
        switch ($action) {  
            case 'config':  
        $result = json_encode($ueditor_config);  
            break;  
                    /* 上传图片 */  
                case 'uploadimage':  
                    /* 上传涂鸦 */  
                case 'uploadscrawl':  
        
                    /* 上传文件 */  
                case 'uploadfile':  
                    $upload = new \Think\Upload();  
                    $upload->maxSize = 553145728;  
                    $upload->rootPath = './Public/Uploads/';  
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg',"flv", "swf", "mkv", "avi", "rm", "rmvb", "mpeg", "mpg",
        "ogg", "ogv", "mov", "wrmv", "mp4", "webm", "mp3", "wav", "mid");  
                    $info = $upload->upload();  
                    if (!$info) {  
                        $result = json_encode(array(  
                                'state' => $upload->getError(),  
                        ));  
                    } else {  
                        $url = __ROOT__ . "/Public/Uploads/" . $info["upfile"]["savepath"] . $info["upfile"]['savename'];  
                        $result = json_encode(array(  
                                'url' => $url,  
                                'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES),  
                                'original' => $info["upfile"]['name'],  
                                'state' => 'SUCCESS'  
                        ));  
                    }  
                    break;  
                default:  
                    $result = json_encode(array(  
                    'state' => '请求地址出错'  
                            ));  
                            break;  
            }  
            /* 输出结果 */  
            if (isset($_GET["callback"])) {  
                if (preg_match("/^[\w_]+$/", $_GET["callback"])) {  
                    echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';  
                } else {  
                    echo json_encode(array(  
                            'state' => 'callback参数不合法'  
                    ));  
                }  
            } else {  
                echo $result;  
            }  
        }

    public function quiz_go(){
        $data=I('post.');
        
            $content=I('post.info');
        $data['content']=htmlspecialchars_decode($content);
        //print_r($data['lab_name']);die;
        if(empty($data['title'])){
        exit('错误：标题不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
        }  
          if(empty($content)){
        exit('错误：描述 不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
        }          
           $lenth = strlen($data['title']);
          // print_r($lenth);die;
            if($lenth<'6'){
        exit('标题必须大于6个字符。<a href="javascript:history.back(-1);">返回</a>'); 
                }
                        
        if($_COOKIE['user_id']==""){
            exit('您还没有登录，请登录后再继续。<a href="javascript:history.back(-1);">返回</a>');        
        }else{

            if($data['money']>'0'){


                     $res=M('user')->where('user_id='.$_COOKIE['user_id'])->find();
                     if($res['user_money']<$data['money']){
                        exit('金币不足。<a href="javascript:history.back(-1);">返回</a>');  
                     }else{

                            $money['user_money']=$res['user_money']-$data['money'];
                            $jinbi=M('user')->where('user_id='.$_COOKIE['user_id'])->save($money);
                            if(!$jinbi){
                            exit('金币计算错误。<a href="javascript:history.back(-1);">返回</a>');
                            }
                                     $datas=[
                                    'title'=>$data['title'],
                                    'content'=>$content,
                                    'quiz_time'=>time(),
                                    'quid' =>$_COOKIE['user_id'],
                                    'money'=>$data['money']
                                    ];   
                     }

            }else{
                     $datas=[
                                    'title'=>$data['title'],
                                    'content'=>$content,
                                    'quiz_time'=>time(),
                                    'quid' =>$_COOKIE['user_id'],
                                    ];
            }
         
      
        }
           //判断标签
           if(empty($data['lab_name'])){
             exit('错误:标签不能为空。<a href="javascript:history.back(-1);">返回</a>'); 
           }
           //标签入库
           //组合标签数据
             $where['lab_name']=$data['lab_name'];
            // print_r($where);die;
             $lab_yuan=M('label')->where($where)->find();
             //print_r($lab_yuan);die;
             if(!$lab_yuan){
                $lab_data=[
                'lab_name'=>$data['lab_name'],
                'lab_addtime'=>time(),
            ];
            $lab_res=M('label')->add($lab_data);

             }
            
           

        $lastInsId =M("question")->add($datas);
   
        //echo $lastInsId;die;
        if($lastInsId){ 

             // $labuser=M('label')->where('lab_name'==$data['lab_name'])->find();
             // print_r($labuser);die;
             $lab_user_data=[
                'user_id'=> $_COOKIE['user_id'],
                'lab_id'=>$lab_yuan['lab_id'],
                'q_id'=>$lastInsId
             ];
             $lab_user_res=M('lab_user')->add($lab_user_data);
             if(!$lab_user_res){
                $this->error('标签添加失败'); 
             }


        $this->success('提交成功',U('Index/index'));    
        }else{
        echo "抱歉！添加数据失败点击此处 <a href='javascript:history.back(-1);'>返回</a> 重试";    
      }  
        }

    /**
     * /查看标签并返回
     * @return [type] [description]
     */
    public function label_select(){
        $label=M('label')->select();
        $this->ajaxReturn($label); 
    }
    /**搜索标签并返回
     * [label_select_one description]
     * @return [type] [description]
     */
    public function label_select_sou(){
            $lab_name=I('post.lab_name');
            if(!empty($lab_name)){
               $where['lab_name'] = array('like', "%$lab_name%");
               $lab=M('label')->where($where)->select();
                   if($lab){
                    $this->ajaxReturn($lab);
                   }else{
                    $this->ajaxReturn('1');
                   }
            }else{
                $this->ajaxReturn('0');
            }

    }
    /**添加标签
     * [label_add description]
     * @return [type] [description]
     */
    public function label_add(){
        $lab_name =I('post.lab_name');
         if(!empty($lab_name)){
              $data['lab_name']=$lab_name;
              $data['lab_addtime']=time();
              $res=M('label')->add($data);
              if($res){
                echo "1";
              }else{
                echo "0";
              }
         }
        
    }
    /*
        问题提交
     */
    public function question_add()
    {
        $data = I('post.');
        $lab_id = I('post.lab_id');
        $lab_id1 = implode(',',$lab_id);
        // print_r($lab_id1);die;
        $data['quiz_time'] = time();
        $data['lab_id'] = $lab_id1;
    
        
        $where=[
           'user_id'=>$_COOKIE['user_id']
           ];
           $arr=M('user')->where($where)->find();
        if($data['money']>$arr['user_money']){
            echo "0";
        }else{
            $res = M('question')->add($data);
            if ($res) {
                echo '1';
            }else{
                echo '2';
            }
        }
    }
  /*
        查询是金币是多少
   */
  public function whole(){
         //获取用户的金币
         $where=[
           'user_id'=>$_COOKIE['user_id']
           ];
           $data=M('user')->where($where)->find();
           //print_r($data);die;
           
           
        $this->ajaxReturn($data);
    }
    /**收藏
     * [Collection description]
     */
    public function Collection(){
        $q_id=I('post.q_id');
        if(empty($_COOKIE['user_id'])){
            echo '3';die;
        }
        $ree=M('question')->where('id='.$q_id)->find();
        if($ree['quid']==$_COOKIE['user_id']){
            echo "4";
        }else{
            //  print_r($ree['quid']); 
            // print_r($_COOKIE['user_id']); 
        

            // echo "1";
            // $where=[

            // ];
             $colle=M('Collection')
                   ->where('user_id='.$_COOKIE['user_id'])
                   ->select();
                  // print_r($colle); 


            if(!$colle){

                $data['q_id']=$q_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['create_time']=time();
                $res=M('Collection')->add($data);
                if($res){

                     $da=M('question')->where('id='.$q_id)->setInc('colle_num');
                     $sc=M('question')->where('id='.$q_id)->find();
                     $arr = array('status'=>1,'colle_num'=>$sc['colle_num']);
                    $this->ajaxReturn($arr);
                     
                }

            }else{

                 $del=M('Collection')
                       ->where('user_id='.$_COOKIE['user_id'])
                       ->delete();
                       $colle=M('question')->where('id='.$q_id)->find();
                           if($colle['colle_num'] !=0){
                              $da=M('question')->where('id='.$q_id)->setDec('colle_num');
                           }
                       
                       if($del && $da){
                          $sc=M('question')->where('id='.$q_id)->find();
                        $arr = array('status'=>2,'colle_num'=>$sc['colle_num']);
                        $this->ajaxReturn($arr);
                                }
       
        }
        

        
    }
}
}//结束