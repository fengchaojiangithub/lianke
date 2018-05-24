<?php

namespace Home\Controller;
use Think\Controller;
class AnswerController extends Controller {
  /**
     * 提交回答
     * @return [type] [description]
     */
    public function answer(){
        $id=I('post.id');
        $info=I('post.info');
        //print_r($da);die;
        $data['answer_content']=htmlspecialchars_decode($info);
        $data['answer_time']=time();
        $data['qid']=$id;
        $q=M('question')->where("id=$id")->find();
        //print_r($user);die;
        if($q['quid']==$_COOKIE['user_id']){
           echo '5';die;
        }
        if($_COOKIE['user_name']==""){
          echo '4';die;
         }
        $data['auid']=$_COOKIE['user_id'];
             $where=[
            'uid'=>$data['auid'],
            'qid'=>$data['qid']
          ];
            $res=M('answer')->where($where)->find();
            if($res){
                echo "3";
            }else{
            $db=M('answer')->add($data);
              if($db){
              echo "1";
              }else{
              echo "2";
              }
            }
      }
/**回答点赞
 * [fabulous description]
 * @return [type] [description]
 */
  public function fabulous(){
          $a_id=I('post.a_id');
          //是否登录
        if(empty($_COOKIE['user_id'])){
            echo '0';die;
        }
        //是否自己回答
        $ree=M('answer')->where('id='.$a_id)->find();
       // print_r($answer_user);die;
        if($ree['auid']==$_COOKIE['user_id']){
          echo "1";die;
        }

        //查看是否已点赞
        $fabulous=M('fabulous')->where('user_id='.$_COOKIE['user_id'])->find();
        if(empty($fabulous)){
                $data['a_id']=$a_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['add_time']=time();
                $res=M('fabulous')->add($data);
                if($res){
                      $da=M('answer')->where('id='.$a_id)->setInc('answer_fabulous');
                      $sc=M('answer')->where('id='.$a_id)->find();
                      $arr = array('status'=>2,'answer_fabulous'=>$sc['answer_fabulous']);
                      $this->ajaxReturn($arr);
                }

        }else{
                            //判断点赞数量不能为负数
                            $nofu=M('answer')->where('id='.$a_id)->find();
                            if($nofu['answer_fabulous'] > '0'){
                            $del=M('fabulous')->where('user_id='.$_COOKIE['user_id'])
                             ->delete();
                            $da=M('answer')->where('id='.$a_id)->setDec('answer_fabulous');
                               if($del && $da){
                                     $sc=M('answer')->where('id='.$a_id)->find();
                                     $arr = array('status'=>3,'answer_fabulous'=>$sc['answer_fabulous']);
                                      $this->ajaxReturn($arr);
                                }
                         
                            }else{
                              echo '4';die;
                            }
                            
                }


     

  }
  //采纳
      public function adopt(){

        $id = I('get.id');
        $qid = I('get.qid');
        $auid = I('get.auid');

        // $data['id']=$id;
        // $data['qid']=$qid;
        // $data['auid']=$auid;
        // print_r($data);die;

        $data = array(
          'id' => $id,
          'adopt' => 1
          );
         $answer=M('answer')->save($data);
         if($answer){
          M('question')->save(array('id' => $qid, 'solve' => 1));

          $user = M('user');
          $user->where(array('id' => $auid))->setInc('user_adopt');
          $user->where(array('id' => $auid))->setInc('user_exp', C('LE_ADOPT'));

          $this->success('已采纳', $_SERVER['HTTP_REFERER']);

         }else{
          $this->error('采纳失败，请重试...');
         }
      
          
 

  }
  
}//结束
?>
