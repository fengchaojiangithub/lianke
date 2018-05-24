<?php

namespace Home\Controller;
use Think\Controller;
class TopicController extends Controller {
    /**
     * 话题首页
     * @return [type] [description]
     */
    public function index(){
    	$data=M('label')->select();
    	//print_r($data);die;
        //查询标签内的问题数量
        $question_count="select lk_label.lab_name,count(lk_label.lab_name)from lk_question,lk_label where find_in_set(lk_label.lab_id,lk_question.lab_id) group by lk_label.lab_name";
        $q_count=M()->query($question_count);
        $this->assign('q_count',$q_count);
    	$this->assign('data',$data);
        $this->display();
    }
    /**
     * 话题列表
     * [topic_list description]
     * @return [type] [description]
     */
    public function topic_list(){
         $lab_id=I('get.id');
         //print_r($lab_id);die;
         //
        //查询所有标签问题
        $where="find_in_set(lk_label.lab_id,lk_question.lab_id)";
          $qqq=M('label')
              ->join('lk_question on '.$where)
              //->where($where)
              ->select();
  
          

         //$abc=M()->query($qqq);
        // print_r($qqq);die;

         //查询标签内容
         $label=M('label')->where('lab_id='.$lab_id)->find();
         //查询当前标签下所有问题
         $where_q="find_in_set($lab_id,lab_id)";
          // $sql= "SELECT * from  lk_question  where find_in_set($lab_id,lab_id)";
          $question=M('question')
                   ->join('lk_user on lk_user.user_id=lk_question.quid')
                   ->where($where_q)
                   ->select();
        //  $question=M()->query($sql);
        //print_r($question);die;
        //当前标签下问题
        $this->assign('question',$question);
        //标签
        $this->assign('label',$label);
    	$this->display();

    }
    /**话题关注
     * [attention description]
     * @return [type] [description]
     */
    public function attention(){
        $lab_id=I('post.lab_id');
        //print_r($lab_id);die;
         //是否登录
        if(empty($_COOKIE['user_id'])){
            echo '0';die;
        }
        //判断是否已关注
          $ree=M('topic_attention')->where('lab_id='.$lab_id,'user_id='.$_COOKIE['user_id'])->find();
        if($ree['user_id']==$_COOKIE['user_id']){
               echo "1";die;
        }else{
                $data['lab_id']=$lab_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['addtime']=time();
                $res=M('topic_attention')->add($data);

                if($res){
                $da=M('label')->where('lab_id='.$lab_id)->setInc('attent_number');
                      if($da){
                         $sc=M('label')->where('lab_id='.$lab_id)->find();
                         $arr = array('status'=>3,'attent_number'=>$sc['attent_number']);
                         $this->ajaxReturn($arr);
                      }

                }else{
                    echo "2";die;
                }
           
        }

    }

    

        
}//结束
?>
