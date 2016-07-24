<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
public function check(){
    $member=M('member');
    $user=$_POST['user'];
    $pwd=$_POST['pwd'];
    $con['user']=$user;
    $con['pwd']=$pwd;
    $result= $member-> where($con)->select();
    
    if($result){
        session('mid',$result[0]['mid']);
         $data['mid']=session('mid');
        session('username',$result[0]['username']);
         $data['username']=session('username');
        cookie('uname',$data['username']);
        $this->ajaxreturn($data);
    }else{
        $this->ajaxreturn(0);
        }
    }
}
    
?>

