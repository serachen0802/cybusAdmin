<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

class SearchticketController extends Controller
{
    
    public function search(){
        $order = M('Corder');

		// 篩選did sql
		if($_POST['did']!=""){
            $searchdid = "WHERE did = ".$_POST['did'];
		}
        $db = $order->query(' SELECT *, (SELECT GROUP_CONCAT(seat) FROM bus_corder where 
        sid=bus_date.sid AND did=bus_date.did) AS Seated FROM bus_date
        INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid '. $searchdid.$searchstart.$searchend.$searchdate); 
        
        $page = $_POST['page'];//第幾頁
		$pageSize = $_POST['rows'];//顯示幾筆
		$first = $pageSize*($page- 1); 
		
		// ThinkPHP 塞選陣列前幾筆

        // 原生 array_slice(陣列,從第幾筆開始,取幾筆)
        $result = array_slice($db, $first, $pageSize);
        $count = count($db);

        // 每筆資料迴圈
        for ($c = 0; $c < count($result); $c++){
                // 將字串轉陣列
                $seatedArray = explode(",",$result[$c]['seated']);
                // 宣告空陣列
                $unSeatedArray = array();
                
                // 1-30迴圈(位置總數)
                for ($i = 1; $i <= 30; $i++) {
                    // 如果$seatedArray陣列不包含$i
                    if (!in_array(strval($i), $seatedArray)) {
                        //$unSeatedArray則加入$i strval 將int轉字串
                        array_push($unSeatedArray, strval($i));
                    }
                }
                //將陣列轉回字串
                $result[$c]['seated'] = implode(",", $unSeatedArray);
        } 
        
        
        $final['rows'] = $result;
    	$final['total'] = $count; //將總筆數存進資料
           
        $this->ajaxReturn($final);
    }
    
}
?>
