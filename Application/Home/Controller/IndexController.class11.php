<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
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
      
        $this->assign('list',$da);
  
      $result = M("comment")
        ->join("lk_user on lk_comment.cuid=lk_user.user_id")
        ->order("comment_time desc")
        ->select();
      // print_r($result);die;
        $this->assign('data',$result);
        $this->display();
    }

    //获取一次请求的数据 
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

    public function question_page(){
        $id=$_GET['id'];
        //print_r($id);die;
        //问题
        $ques=M('question')
        ->join('lk_user on lk_user.user_id=lk_question.quid')
        ->where("id=$id")
        ->find();
         //查询标签id
         //
         
         $answer=M('answer')->where('qid='.$ques['id'])->select();
         $ques['answer_count']=count($answer);
        //print_r($ques);die;
        $qu['click']=$ques['click']+1;
        //print_r($qu);die;
        M('question')->where("id=$id")->save($qu);
    
        $answer = M('answer')
                ->where("lk_answer.qid=".$id)
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
                ->field("comment_content,comment_time,cuid,user_name,user_face,id,qid,aid")
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

       // print_r($answer);die;
        //问题详情
        $this->assign('ques',$ques);
        //回复和
        $this->assign('answer',$answer);
     
        $this->display('Question/question_page');

    }
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
     // print_r($keys);die;
      
       if($keys==""){
        echo "0";die;
       }
       if(!$_COOKIE['user_id']){
        echo '1';die;
       }
       
        $wh=[
          'k_name'=>$keys
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


    }
 
}//结束
?>