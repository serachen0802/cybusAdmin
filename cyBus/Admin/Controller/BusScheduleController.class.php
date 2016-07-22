<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

class BusScheduleController extends Controller
{

  
    public function busSchedule(){
        
		$BusSchedule=M('schedule');
		//search
		$page = $_POST['page'];//第幾頁
		$pageSize = $_POST['rows'];//顯示幾筆
		$first = $pageSize*($page- 1); 

		if($_POST['sid']!=""){
		$con['sid'] = array('eq',$_POST['sid']);
		$result=$BusSchedule->where($con)->select();
		$count=count($result);
		}
		if($_POST['start']!="") {
		$con['start']=array('like',$_POST['start']);
		$result=$BusSchedule->where($con)->select();
		$count=count($result);
		}
		if($_POST['end']!=""){
		$con['end'] = array('like',$_POST['end']);
		$result=$BusSchedule->where($con)->select();
		$count=count($result);
		}else{
		$result =$BusSchedule->limit($first,$pageSize)->select();
		$count = $BusSchedule->count();
		}
		$data['rows'] = $result;
		$data['total'] = $count;//將總筆數存進資料

		$this->ajaxReturn($data);

	}


	public function insert(){
		$BusSchedule=M('schedule');
		
		$data['start'] = $_POST['start'];
		$data['end'] = $_POST['end'];
		$data['onePrice'] = $_POST['oneprice'];
		$data['halfFare'] = $_POST['halffare'];
		$data['backAndForth'] = $_POST['backandforth'];
		$data['remark'] = $_POST['remark'];
			
		$BusSchedule->add($data);
	  	$this->ajaxReturn($data);
		
	}
  
	public function edit(){
		$BusSchedule=M('schedule');
		$id['sid']=$_GET['id'];
		
		$data['start'] = $_POST['start'];
		$data['end'] = $_POST['end'];
		$data['onePrice'] = $_POST['oneprice'];
		$data['halfFare'] = $_POST['halffare'];
		$data['backAndForth'] = $_POST['backandforth'];
		$data['remark'] = $_POST['remark'];
					
		$BusSchedule-> where($id)-> save($data);
		$this-> ajaxReturn($data);
	  }
  
  
	public function remove(){
  		$BusSchedule=M('schedule');
  		$sid['sid']=$_POST['id'];
  		$result = $BusSchedule-> where($sid)-> delete();
			//傳值
			if($result){
				$this->ajaxReturn(1);
			} else {
				$this->ajaxReturn(0);
			}
		}
  
  
}
?>