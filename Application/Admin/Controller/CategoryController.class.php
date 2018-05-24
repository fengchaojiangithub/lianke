<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
    public function category(){
    	$User = M('category');
        $p=empty($_GET['p'])?1:$_GET['p'];
        $list = $User->page($p.',5')->select();
        $this->assign('list',$list);
        $count      = $User->count();
        $Page       = new \Think\Page($count,5);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();
        $this->assign('page',$show);
        $this->display();
      
    }
    public function category_add(){
        $this->display('category_add');
    }
     public function category_add_go(){
        $arr=I('post.');
        //print_r($arr);die;
        $obj=M('category'); 
        $re=$obj->add($arr);
        
        if($re){
            $this->redirect('Category/category');
        }else{
            $this->error('添加失败');
        }
    }
    /**
     * 删除方法
     */
    public function delete(){
        $id=I('post.id');
        //print_r($id);die;
        $obj=M('category');
        $re=$obj->delete($id);
        if($re){
            echo ok;
        }else{
            echo no;
        }
    }
}