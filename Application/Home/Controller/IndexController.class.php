<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

  public function index(){
      //组合查询问题和笔记表
     //  $res = M('question')
     //       ->field('id,title,content,quiz_time,click')
     //       ->group('field')
     //       ->union('select n_id,n_title,n_content,n_addtime,n_click from lk_note group by n_id')
     //       ->select();
     //  foreach ( $res as $key => $row ){
     //    $quiz_time[$key] = $row ['quiz_time'];
     // }
     //  array_multisort($quiz_time, SORT_DESC, $res);

     //    print_r($res);die;
 //    // $zong = array_merge($question,$note);
  $sql1 = M()

  ->field('id,title')
  ->table('lk_question')
  ->group('id')
  ->buildSql();

  //$ree=M('question')->group('id')->select();

  $sql2 = M()
  ->field('n_id,n_title')
  ->table('lk_note')
  ->group('n_id')
  ->buildSql();
   

 $sql=$sql1.'UNION ALL'.$sql2;
 $result=M() ->query($sql);
 // print_r($sql1);die;
 // print_r($result);die;
       $this->assign('res',$result);
       $this->display();
  }
   //  public function index(){
   //    // $search=I('post.keys');
   //    // if(!empty($search)){
   //    //   $where['title'] = array('like', "%$search%");
   //    // }
      
  
   //    $da=M('question')
   //        ->join('lk_user on lk_question.quid=lk_user.user_id')
   //        ->where($where)
   //        ->order('id desc')
   //        ->limit(5)
   //        ->select();
          
   //      foreach($da as $k =>$v){
   //           $answer=M('answer')->where('qid='.$v['id'])->select();
   //              $da[$k]['answer_count']=count($answer);
   //      }
   // // print_r($da);die;
      
   //      $this->assign('list',$da);
  
   //    $result = M("comment")
   //      ->join("lk_user on lk_comment.cuid=lk_user.user_id")
   //      ->order("comment_time desc")
   //      ->select();
   //    // print_r($result);die;
   //      $this->assign('data',$result);
   //      $this->display();
   //  }

   //  //获取一次请求的数据 
   //    public function getmore(){  
   //    //获取最后一个id 
   //    $lastid=I('get.lastid');
   //      // print_r($lastid);
   //    if(!empty($lastid)){
   //      $where['id'] = array('lt', $lastid);  
      

   //      $data=M('question')
   //        ->join('lk_user on lk_question.quid=lk_user.user_id')
   //        ->where($where)
   //        ->order('id desc')
   //        ->limit(5)
   //        ->select();
   //          }


   //      foreach($data as $key =>$val){
   //              $data[$key]['quiz_time']=jishuantime($val['quiz_time']);
   //      }
   //         foreach($data as $k =>$v){
   //           $answer=M('answer')->where('qid='.$v['id'])->select();
   //              $data[$k]['answer_count']=count($answer);
   //      }
   //        //print_r($data);die;
        
   //    $this->ajaxReturn($data); 
   //    }

   //  public function question_page(){
   //      $id=$_GET['id'];
   //      //print_r($id);die;
   //      //问题
   //      $ques=M('question')
   //      ->join('lk_user on lk_user.user_id=lk_question.quid')
   //      ->where("id=$id")
   //      ->find();
   //        //查询标签
   //       $lab=M('question')->where("id=$id")->find();
   //        $lab_id=explode(',', $lab['lab_id']);
   //        $aa['lab_id']=$lab_id;
   //      // print_r($aa);die;
   //      foreach ($aa as $key => $value) {
   //        // print_r($value);die;
   //        $where['lab_id'] = array('in',$value);
   //        $label=M('label')->where($where)->select();
   //      }
   //      // print_r($label);die;
   //      // 
   //         //已采纳
   //        $where_cai = array('qid' => $id, 'lk_answer.adopt' => 1);
   //        $answer_caina = M('answer')
   //              ->where($where_cai)
   //              ->join('lk_user on lk_user.user_id=lk_answer.auid')
   //              ->field("answer_fabulous,user_id,user_name,user_face,id,qid,answer_content,lk_answer.adopt")
   //              ->select();

   //           //  print_r($answer_caina);die;
          
   //       $answer=M('answer')->where('qid='.$ques['id'])->select();
   //       $ques['answer_count']=count($answer);
   //      //print_r($ques);die;
    
   //       //点击量
   //       M('question')->where("id=$id")->setInc('click');

   //      $where_adopt=array('qid' => $id, 'lk_answer.adopt' => 0);
   //      $answer = M('answer')
   //              ->where($where_adopt)
   //              ->join('lk_user on lk_user.user_id=lk_answer.auid')
   //              ->select();
   //              //print_r($answer);die;
   //      $wherestr="";

   //      foreach($answer as $key=>$val){
   //      $wherestr=",".$val['id'];
   //      }
   //      $wherestr=trim($wherestr,",");
   //     // print_r($wherestr);die;
   //      $comment=M("comment")
   //              ->join('lk_user on lk_user.user_id=lk_comment.cuid')
   //              ->where(array("aid"=>array("in",$wherestr)))
   //              ->field("comment_fabulous,comment_content,comment_time,cuid,user_name,user_face,id,qid,aid")
   //              ->select();

   //      //print_r($comment);die;
   //      $comment_temp=[];
   //      foreach($comment as $com=>$ment){
   //              $comment_temp[$ment['aid']][]=$ment;
   //      }
   //      foreach($answer as $keys=>$vals){
   //              if(isset($comment_temp[$vals['id']])){
   //                $answer[$keys]['comment']=$comment_temp[$vals['id']];
   //              }else{
   //                $answer[$keys]['comment']="";
   //              }
   //       }

   //     //print_r($answer);die;
   //      //问题详情
   //      $this->assign('ques',$ques);
   //      //标签
   //      $this->assign('label',$label);
   //      $this->assign('answer_caina',$answer_caina);
   //      //回复和评论
   //      $this->assign('answer',$answer);
     
   //      $this->display('Question/question_page');

      // }
    /**搜索提示
     * [search description]
     * @return [type] [description]
     */
    public function search(){

       $k_name =I('post.keys');
        //print_r($k_name);die;
         $where['k_name'] = array('like', "%$k_name%");
         $res=M('keyword')->where($where)->select();
       
         echo json_encode($res);
       }
      /**
       * 添加搜索关键字
       * [addkeyword description]
       * @return [type] [description]
       */
    
    public function addkeyword(){
      $keys=I('post.keys');
      if (empty($keys)) {
            echo 1;die;
      }else{
        if(!$_COOKIE['user_id']){
        echo '1';die;
       }
       $wh=[
            'k_name'=>keys
           ];
       
       $res=M('keyword')->where($wh)->find();
          // print_r($res);die;
           
       if(!empty($res)){
          $da['k_number']=$res['k_number']+1;
           $whe=[
            'k_id'=>$res['k_id']
           ];
          $g=M('keyword')->where($whe)->save($da);
       }else{
              $ree=[
                'k_name'=>$keys
              ];

              $keyda=M('keyword')->add($ree);
              //组合数据
              $key_data['s_time']=time();
              $key_data['k_id']=$keyda['id'];
              $key_data['u_id']=$_COOKIE['user_id'];
              $result=M('key_user')->add($key_data);
              if($result && $keyda){
                echo '2';

              }else{
                echo '3';die;
              }

      }
     
      
       // if($keys==""){
       //  echo "0";die;
       // }
       

       // }


    }
  }
  function indexss(){
    $search=I('post.keys');
     if(!empty($search)){
        $where['title'] = array('like', "%$search%");
      }
      
  
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
      
        $this->ajaxReturn($da);
  }
}//结束

 