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
		$result1=$Busdate->where($con)->limit($first,$pageSize)->select();
		$count=count($result);
		}
		if($_POST['date']!="") {
		$con['date']=array('like',$_POST['date']);
		$result=$Busdate->where($con)->select();
		$result1=$Busdate->where($con)->limit($first,$pageSize)->select();
		$count=count($result);
		}
		if($_POST['time']!=""){
		$con['time'] = array('like',$_POST['time']);
		$result=$Busdate->where($con)->select();
		$result1=$Busdate->where($con)->limit($first,$pageSize)->select();
		$count=count($result);
		}
		else{

		$result1 =$Busdate->limit($first,$pageSize)->select();
		$count = $Busdate->count();
		}
		
		$data['rows'] = $result1;
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
        $data['last_editor'] = session('username');
        $Busdate->add($data);
        $this->ajaxReturn($data);
  		}else{
  		    $this->ajaxReturn("nono");
  		}
    }
    public function edit(){
		$Busdate=M('date');
		$id['did']=$_GET['id'];
		
		$data = $Busdate->create();
		$data['last_editor'] = session('username');
		$Busdate-> where($id)-> save($data);
		$this-> ajaxReturn($data);
	  }
	  
  public function remove(){
  		$Busdate=M('date');
  		$did['did']=$_POST['id'];
  		$result = $Busdate-> where($did)-> delete();
			//傳值
			if($result){
				$this->ajaxReturn(1);
			} else {
				$this->ajaxReturn(0);
			}
		}
		//刪除今日以前全部資料
	public function removeAll(){
		$Busdate=M('date');
		$today=date('Y-m-d');
		// $today='2016-07-16';
		$con['date']=array('lt',$today);
		
		$data=$Busdate->where($con)->delete();
		$this->ajaxReturn(1);
	}
}
?>