<?php

namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {

    public function com_add(){
        if($_COOKIE['user_id']==""){
          echo "no";
        }else{
          $content=I('post.content');
          $qid=I('post.id');
          // print_r($qid);die;
          $comment_time=time();
          $data=[
          'comment_content'=>$content,
          'comment_time'=>time(),
          'cuid'=>$_COOKIE['user_id'],
          'qid'=>$qid
          ];
          $where=[
            'cuid'=>$data['uid'],
            'qid'=>$qid
          ];

          $re=M('comment')->where($where)->find();
          //print_r($re);die;
          if(!$re){
              $res=M('comment')->add($data);
             if($res){
              echo "1";
          // $this->success('评论成功',U('Index/index'));
             }else{
          // $this->error('评论失败');
             echo "0";
             }
          }else{
            echo "2";
          }
          //print_r($data);die;
          
        }
        



  }  
  /**
   * 评论点赞
   * [fabulous description]
   * @return [type] [description]
   */
   public function fabulous(){
          $c_id=I('post.c_id');
          //print_r($c_id);die;
          //是否登录
        if(empty($_COOKIE['user_id'])){
            echo '0';die;
        }
        //是否自己评论
        $ree=M('comment')->where('id='.$c_id)->find();
       // print_r($answer_user);die;
        if($ree['cuid']==$_COOKIE['user_id']){
          echo "1";die;
        }

        //查看是否已点赞
        $fabulous=M('fabulous')->where('c_id='.$c_id)->find();
       // print_r($fabulous);die;
        if(empty($fabulous)){
                $data['c_id']=$c_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['add_time']=time();
                $res=M('fabulous')->add($data);
                if($res){
                      $da=M('comment')->where('id='.$c_id)->setInc('comment_fabulous');
                      $sc=M('comment')->where('id='.$c_id)->find();

                      $arr = array('status'=>2,'comment_fabulous'=>$sc['comment_fabulous']);
                      $this->ajaxReturn($arr);
                }

        }else{
                            //判断点赞数量不能为负数
                            $nofu=M('comment')->where('id='.$c_id)->find();
                            if($nofu['comment_fabulous'] > '0'){
                            $del=M('fabulous')->where('user_id='.$_COOKIE['user_id'] && 'c_id='.$c_id)
                             ->delete();
                            $da=M('comment')->where('id='.$c_id)->setDec('comment_fabulous');
                               if($del && $da){
                                     $sc=M('comment')->where('id='.$c_id)->find();
                                     $arr = array('status'=>3,'comment_fabulous'=>$sc['comment_fabulous']);
                                      $this->ajaxReturn($arr);
                                }
                         
                            }else{
                              echo '4';die;
                            }
                            
                }


     

  }
}//结束
?>
