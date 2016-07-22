<?php
namespace Admin\Controller;

use Think\Controller;

// use Think\Upload;

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

    $this->success('登入成功', U('Index/index'));
    }else{
         $this->error('登入失败');
    }
    
}


}
   //  $this->redirect("Index/index");
?>

