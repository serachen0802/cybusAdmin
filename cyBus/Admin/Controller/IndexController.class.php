<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
    $this->display();
    }
    
    public function logout(){
        session(null);
        cookie('uname',null);
        $this->ajaxreturn(1);
    }
   
}

