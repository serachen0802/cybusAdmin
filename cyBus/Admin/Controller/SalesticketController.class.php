<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

class SalesticketController extends Controller
{
    public function sales(){
        $order = M('Corder');
        $page = $_POST['page'];//第幾頁
		$pageSize = $_POST['rows'];//顯示幾筆
		$first = $pageSize*($page- 1); 
		
		if($_POST['clientId']!=""){
		$con['clientId'] = array('eq',$_POST['clientId']);
		$result = $order-> where($con)-> select();
		$result1 = $order-> where($con)-> limit($first,$pageSize)->select();
		$count = count($result);
		}
		if($_POST['clientPhone']!="") {
		$con['clientPhone'] = array('like',$_POST['clientPhone']);
		$result = $order-> where($con)-> select();
		$result1 = $order-> where($con)-> limit($first,$pageSize)->select();
		$count = count($result);
		}
		if($_POST['type']!=""){
		$con['type'] = array('like',$_POST['type']);
		$result = $order-> where($con)-> select();
		$result1 = $order-> where($con)-> limit($first,$pageSize)->select();
		$count = count($result);
		}
		if($_POST['ticrand']!=""){
		$con['ticrand'] = array('like',$_POST['ticrand']);
		$result = $order-> where($con)-> select();
		$result1 = $order-> where($con)-> limit($first,$pageSize)->select();
		$count = count($result);
		}
		else{

		$result1 = $order-> limit($first,$pageSize)-> select();
		$count = $order-> count();
		}
		
		$data['rows'] = $result1;
		$data['total'] = $count;//將總筆數存進資料

		$this-> ajaxReturn($data);
    }
    public function insert(){
    	$Busdate=M('date');
        $con['did']=array('eq',$_POST['did']);
  		$data1=$Busdate->where($con)->select();
  		
  		$BusSchedule=M('schedule');
  		$co['sid']=array('eq',$_POST['sid']);
  		$data2=$BusSchedule->where($co)->select();
  		$type=$_POST['type'];
  		if($_POST['type']=="全票"){
  			$price=$data2[0]['oneprice'];
  		}
  		if($_POST['type']=="半票"){
  			$price=$data2[0]['halffare'];
  		}
  		if($_POST['type']= array('like',"來回票")){
  			$price=$data2[0]['backandforth'];
  		}
  		// var_dump($data2);
  		// echo $price;
  		if($data1){
        $order = M('Corder');
        $data = $order->create();
        $date=date("Y-m-d H:i");
        $data['type']=$type;
        $data['ticrand'] =substr(strtotime($date),-7).substr($_POST['clientId'],-3);
        $data['total'] = $price*$_POST['number'];
        $data['orderTime'] = date('Y-m-d H:i:s');
        $data['buyfor'] = 'admin';
        $order->add($data);
        $this->ajaxReturn($data);
  		}else{
  		    $this->ajaxReturn("nono");
  		}
    }
    public function edit(){
    	$order = M('Corder');
    	$id['oid']=$_GET['id'];
		
		$data = $order->create();
					
		// $order-> where($id)-> save($data);
		$this-> ajaxReturn($data);
    }
    public function remove(){
  		$order = M('Corder');
  		$oid['oid']=$_POST['id'];
  		$result = $order-> where($oid)-> delete();
			//傳值
			if($result){
				$this->ajaxReturn(1);
			} else {
				$this->ajaxReturn(0);
			}
		}
}


