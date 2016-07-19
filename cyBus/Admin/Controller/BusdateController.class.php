<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

class BusdateController extends Controller
{
    public function busdate(){
        $Busdate=M('date');
		//search
		$page = $_POST['page'];//第幾頁
		$pageSize = $_POST['rows'];//顯示幾筆
		$first = $pageSize*($page- 1); 
		if($_POST['sid']!=""){
		$con['sid'] = array('eq',$_POST['sid']);
		$result=$Busdate->where($con)->select();
		$count=count($result);
		}
		if($_POST['date']!="") {
		$con['date']=array('like',$_POST['date']);
		$result=$Busdate->where($con)->select();
		$count=count($result);
		}
		if($_POST['time']!=""){
		$con['time'] = array('like',$_POST['time']);
		$result=$Busdate->where($con)->select();
		$count=count($result);
		}else{
		$result =$Busdate->limit($first,$pageSize)->select();
		$count = $Busdate->count();
		}
		$data['rows'] = $result;
		$data['total'] = $count;//將總筆數存進資料

		$this->ajaxReturn($data);
    }
    
    public function insert(){
        $BusSchedule=M('schedule');
        $con['sid']=array('eq',$_POST['sid']);
  		$data1=$BusSchedule->where($con)->select();
  		
  		if($data1){
        $Busdate=M('date');
        $data = $Busdate->create();
        $data['last_edit']=date('Y-m-d H:i:s');
        $data['last_editors'] = 'admin';
        // $Busdate->add($data);
        $this->ajaxReturn($data);
  		}else{
  		    $this->ajaxReturn("123");
  		}
  	 	
    }
}
?>