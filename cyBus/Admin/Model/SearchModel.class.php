<?
namespace Admin\Model;
use Think\Model;  
    class SeachModel extends Model  
    { 
        public function search(){
            $Model = M('Corder');
            $Model
            ->join('bus_date ON bus_Corder.did = bus_date.did')
            ->join('bus_schedule ON bus_Corder.sid = bus_schedule.sid')
            ->select();
            
        }
        
        
        
    }
    ?>