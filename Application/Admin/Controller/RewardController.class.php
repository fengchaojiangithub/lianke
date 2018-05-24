<?php
namespace Admin\Controller;
use Think\Controller;
class RewardController extends Controller {
    //金币奖励规则视图
    public function index(){
        $config=include'./Application/Common/Conf/config.php';
        //echo C('del_quiz');
        //print_r($config);die;
        $this->display();
    }
    //修改奖励设置
    public function reset(){
        //dump($_POST);die;
        $file='./Application/Common/Conf/config.php';
    
        $config=array_merge(include $file,array_change_key_case($_POST,CASE_UPPER));
      // print_r($config);
         $str="<?php\r\nreturn\r\n".var_export($config,true).";\r\n?>";
         //echo $str;
        if(file_put_contents($file, $str)){
            $this->success('修改成功',$SERVER['HTTP_REFERER']);
        }else{
            $this->error('修改失败');
        }
    }
    //经验级别规则视图
    public function level(){
        $this->display('level');
    }


}//结束
   