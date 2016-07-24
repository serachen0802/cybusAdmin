<?php
namespace Admin\Controller;

use Think\Controller;

class NewsController extends Controller
{
    public function news(){
        $news=M('news');
		//search
		$page = $_POST['page'];//第幾頁
		$pageSize = $_POST['rows'];//顯示幾筆
		$first = $pageSize*($page- 1);
		
		if($_POST['nid']!=""){
		$con['nid'] = array('eq',$_POST['nid']);
		$result=$news->where($con)->select();
		$count=count($result);
		}
		if($_POST['date']!="") {
		$con['date']=array('like',$_POST['date']);
		$result=$news->where($con)->select();
		$count=count($result);
		}
		if($_POST['newsed']!=""){
		$con['newsed'] = array('like',$_POST['newsed']);
		$result=$news->where($con)->select();
		$count=count($result);
		}else{
		
		$result =$news->limit($first,$pageSize)->select();
		$count = $news->count();
		}
		$data['rows'] = $result;
		$data['total'] = $count;//將總筆數存進資料

		$this->ajaxReturn($data);

	
    }
    public function insert(){
    	$news=M('news');
        $data = $news->create();
        $data['date']=date('Y-m-d');
        $data['newsed'] = session('username');
        $news->add($data);
        $this->ajaxReturn($data);
  	
    }
    public function edit(){
    	$news=M('news');
		$id['nid']=$_GET['id'];
		
		$data = $news-> create();
		 $data['newsed'] = session('username');			
		$news-> where($id)-> save($data);
		$this-> ajaxReturn($data);
    }
     public function remove(){
    	$news=M('news');
  		$nid['nid']=$_POST['id'];
  		$result = $news-> where($nid)-> delete();
			//傳值
			if($result){
				$this->ajaxReturn(1);
			} else {
				$this->ajaxReturn(0);
			}
		
    }
    
}
?>