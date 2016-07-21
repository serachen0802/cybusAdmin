<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

class SearchticketController extends Controller
{
    
    public function search(){
        $order=M('Corder');
        $data=$order->query(' SELECT *, (SELECT GROUP_CONCAT(seat) FROM bus_corder where 
        sid=bus_date.sid AND did=bus_date.did) AS Seated FROM bus_date
        INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid ');
 
        //   for($i=1;$i<=30;$i++){
        //     $arr[]="$i";
        //   }
        //     for($k=0;$k<=count($data);$k++){
        //     // $h=explode(",",$data[0]['seated']);//陣列
        //     $r=$data[$k]['seated'];
        //     $arrseat=explode("," , $r);
        //     }
            
        //     for( $ii=0; $ii <30; $ii++){
        //     if(! strcmp($arr[$ii],$arrseat) ) unset($arr[$ii]);
        //     // return $arr;
        //         }
            
            
            // $x=var_dump($data[0]['seated']);
            
            // 每筆資料迴圈
            for ($c = 0; $c < count($data); $c++){
                // 將字串轉陣列
                $seatedArray = explode(",",$data[$c]['seated']);
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
                $data[$c]['seated'] = implode(",", $unSeatedArray);
            } 
            
            $this->ajaxReturn($data);
            
            
           
    }
    
}
?>
