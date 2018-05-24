<?php
namespace Home\Controller;
use Think\Controller;
class NoteController extends Controller {
	/**
	 * [Index description]
	 * 展示笔记模块首页
	 */
	public function Index(){
		//查询一次查
		 $where['n_islock']='1';
		 $da=M('note')
          ->join('lk_user on lk_note.n_uid=lk_user.user_id')
          ->where($where)
          ->order('n_addtime desc')
          ->limit(5)
          ->select();
     $this->assign('da',$da);
     $this->display();
	}


     //获取一次请求的数据 
      public function getmore(){  
      //获取最后一个id 
      $lasttime=I('get.lasttime');
        // print_r($lastid);
      if(!empty($lasttime)){
        $where['n_addtime'] = array('lt', $lasttime);  
      

        $data=M('note')
          ->join('lk_user on lk_note.n_uid=lk_user.user_id')
          ->where($where)
          ->order('n_addtime desc')
          ->limit(5)
          ->select();
            }


        foreach($data as $key =>$val){
                $data[$key]['time']=jishuantime($val['n_addtime']);
        }
      
       
        
      $this->ajaxReturn($data); 
      }
	/**
	 * [note_add description]
	 * @return [type] [description]
	 * 笔记添加
	 */
	public function note_add_go(){
        if(empty($_COOKIE['user_id'])){
          echo '0';die;
        }else{
              $info=I('post.n_title');
              $n_islock=I('post.n_islock');
              $la_id = I('post.lab_id');

              $lab_id = implode(',',$la_id);
          
              $data['lab_id'] = $lab_id;
              $data['n_title'] = I('post.n_title');
              $data['n_addtime'] = time();
              $data['n_content'] = htmlspecialchars_decode($info);
              $data['n_uid']=$_COOKIE['user_id'];
              $data['n_islock']=$n_islock;
              // print_r($data);die;
              // //验证
              if(empty($data['n_title'])){
                 echo '1';die;
               }
              if(empty($la_id)){
                 echo '2';die;
              }
              if(empty($data['n_content'])){
                 echo '3';die;
              }
              $res=M('note')->add($data);
              if($res){
                 echo '4';die;
              }else{
                echo '5';die;
              }

      }     

		$this->display();

	}
    /**
     * 笔记详情
     * [page description]
     * @return [type] [description]
     */
    public function note_page(){
         $n_id=I('get.id');
          // print_r($n_id);die;
         //点击量
         M('note')->where("n_id=$n_id")->setInc('n_click');
         //展示文章详情
         $note=M('note')
              ->join('lk_user on lk_user.user_id=lk_note.n_uid')
              ->where("n_id=$n_id")
              ->find();
        //标签
         $lab=M('note')->where("n_id=$n_id")->field('lab_id')->find();
         //print_r($lab);die;
          $lab_id=explode(',', $lab['lab_id']);
          $aa['lab_id']=$lab_id;
        // print_r($aa);die;
        foreach ($aa as $key => $value) {
          // print_r($value);die;
          $where['lab_id'] = array('in',$value);
          $label=M('label')->where($where)->select();
        }
        //print_r($label);die;
        $this->assign('label',$label);
        $this->assign('note',$note);
        $this->display();
        

    }

     /**收藏
     * [Collection description]
     */
    public function collection(){
        $n_id=I('post.n_id');
        if(empty($_COOKIE['user_id'])){
            echo '3';die;
        }
        $ree=M('note')->where('n_id='.$n_id)->find();
        if($ree['n_uid']==$_COOKIE['user_id']){
            echo "4";
        }else{
                 $where_n_id=array('n_id'=>$n_id,'user_id'=>$_COOKIE['user_id']);
                 $colle=M('collection')
                   ->where($where_n_id)
                   ->select();
                   //print_r($colle);die;
       


            if(!$colle){

                $data['n_id']=$n_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['create_time']=time();
                $res=M('collection')->add($data);
                if($res){

                     $da=M('note')->where('n_id='.$n_id)->setInc('n_colle_num');
                     $sc=M('note')->where('n_id='.$n_id)->find();
                     $arr = array('status'=>1,'n_colle_num'=>$sc['n_colle_num']);
                    $this->ajaxReturn($arr);
                     
                }

            }else{
                    $where_n_id=array('n_id'=>$n_id,'user_id'=>$_COOKIE['user_id']);
                   // $colle_del=M('collection')
                   // ->where($where_n_id)
                   // ->select();

                  $del=M('collection')
                       ->where($where_n_id)
                       ->delete();
                       $colle=M('note')->where('n_id='.$n_id)->find();
                           if($colle['n_colle_num'] !=0){
                              $da=M('note')->where('n_id='.$n_id)->setDec('n_colle_num');
                           }
                       
                       if($del && $da){
                          $sc=M('note')->where('n_id='.$n_id)->find();
                        $arr = array('status'=>2,'n_colle_num'=>$sc['n_colle_num']);
                        $this->ajaxReturn($arr);
                                }
       
        }
        

        
    }
}

/**笔记点赞
 * [fabulous description]
 * @return [type] [description]
 */
  public function fabulous(){
          $n_id=I('post.n_id');

          //是否登录
        if(empty($_COOKIE['user_id'])){
            echo '0';die;
        }
        $ree=M('note')->where('n_id='.$n_id)->find();
        if($ree['n_uid']==$_COOKIE['user_id']){
            echo "1";
        }else{
                 $where_n_id=array('n_id'=>$n_id,'user_id'=>$_COOKIE['user_id']);
                 $colle=M('note_fabulous')
                   ->where($where_n_id)
                   ->select();
                   //print_r($colle);die;
       


            if(!$colle){

                $data['n_id']=$n_id;
                $data['user_id']=$_COOKIE['user_id'];
                $data['create_time']=time();
                $res=M('note_fabulous')->add($data);
                if($res){

                     $da=M('note')->where('n_id='.$n_id)->setInc('n_fabulous');
                     $sc=M('note')->where('n_id='.$n_id)->find();
                     $arr = array('status'=>2,'n_fabulous'=>$sc['n_fabulous']);
                    $this->ajaxReturn($arr);
                     
                }

            }else{
                    $where_n_id=array('n_id'=>$n_id,'user_id'=>$_COOKIE['user_id']);
              

                  $del=M('note_fabulous')
                       ->where($where_n_id)
                       ->delete();
                       $colle=M('note')->where('n_id='.$n_id)->find();
                           if($colle['n_fabulous'] !=0){
                              $da=M('note')->where('n_id='.$n_id)->setDec('n_fabulous');
                           }
                       
                       if($del && $da){
                          $sc=M('note')->where('n_id='.$n_id)->find();
                        $arr = array('status'=>3,'n_fabulous'=>$sc['n_fabulous']);
                        $this->ajaxReturn($arr);
                                }
       
        }
        

        
    }

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
	// public function note_add_go(){
	// 	//$data=I('post.');
	// 	$lab_id=I('post.lab_id');
	// 	//print_r($lab_id);die;
	// 	$data['n_addtime']=time();
	// 	$data['n_title']=I('post.title');
	// 	$n_content=I('post.info');
	// 	$data['n_content']=htmlspecialchars_decode($n_content);
	// 	$data['n_cid']=I('post.cid');
	// 	$data['n_islock']=I('post.n_islock');
	// 	$data['n_uid']=$_COOKIE['user_id'];
	// 	if(empty($data['n_uid'])){
	// 	exit('您还没有登录，请登录后再继续。<a href="javascript:history.back(-1);">返回</a>');  
	// 	}

	// 	$res=M('note')->add($data);
	//     //
	//         //定义一个空数组
 //        $re=array();
 //        //循环数组中的t_id
 //        foreach ($lab_id as $key => $val) {
 //            $re[]=array('n_id'=>$res,'lab_id'=>$val,'user_id'=>$_COOKIE['user_id']);
 //            //print($kong);die;
 //        }
 //        //print_r($re);die;
 //        //执行添加这个数组
 //        $result=M("lab_user")->addAll($re);
 //        if($res > 0 && $result > 0){
 //        	$this->success('发布成功', U('Note/index'));
 //        }else{
 //        	$this->error('发布失败');
 //        }






	
}//结束
?>