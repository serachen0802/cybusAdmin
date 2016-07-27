<?php if (!defined('THINK_PATH')) exit(); session_start(); if(!isset($_COOKIE['uname'])){ ?>
<!DOCTYPE html>
<!-------------------------------------------------------------------------登入頁---------------------------------------------------------------->
<html>
<head>
    <meta charset="UTF-8">
    <title>cyBus</title>
	<script src="//cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script>
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/<?php echo ((isset($_COOKIE["easyuiThemeName"]) && ($_COOKIE["easyuiThemeName"] !== ""))?($_COOKIE["easyuiThemeName"]):"default"); ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <div data-options="region:'north',split:false,border:false" style="height:76px;background-color:#AFD6FF">
    	<div style="height:40px; width:100%; background-color:#AFD6FF;">
        	<div style="width:400px; height:40px;padding:10px 0 0 10px; background-color:#AFD6FF; float:left;" id="wt_logo">
			
				<img alt="" src="/cyBusAdmin/Public/images/cybus.png" style="height:60px">
        	</div>
            <div style="width:200px; height:40px;padding:10px 10px 0 10px; background-color:#AFD6FF; float:right;" id="wt_usrinfo">
            	<span style="color:blue;">使用者您好！</span>
            </div>
        </div>
    <div style="margin:20px 0;"></div>
    <div  title="登入" style="display: block;width: 400px;position: fixed;top: 35%;left: 35%;">
        <div style="padding:10px 60px 20px 60px">
        <form id="ff" method="post" action="">
            <table cellpadding="5">
                <tr>
                    <td>帳號:</td>
                    <td><input class="easyui-textbox" type="text" name="user" data-options="required:true"></input></td>
                </tr>
                <tr>
                    <td>密碼:</td>
                    <td><input class="easyui-textbox" type="password" name="pwd" data-options="required:true"></input></td>
                </tr>
            </table>
        </form>
        <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">確認</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
        </div>
        <div>帳號:aaa123   密碼:123</div>
        </div>
    </div>
    </div>
    <script>
    // 判斷登入狀態
        function submitForm(){
            var url= '<?php echo U('Login/check');?>';
             $('#ff').form('submit',{
                url:url,
                success: function(result){
                    console.log(result);
                    if(result){
                        window.location.assign("https://lab-sera-chen.c9users.io/cyBusAdmin/index.php/Admin/Index/index");
                        JSON.parse(result,function(k,v){
                            console.log(v);
                            if(k=="username"){
                            alert('登入成功 hi!   '+ v);
                            }
                        });                       
                    }else{
                        alert('登入失敗');
                    }
                }
            });
        }
        //清除
        function clearForm(){
            $('#ff').form('clear');
        }
    </script>
</body>
</html>
<?php
}else{ ?>
<!DOCTYPE html>
<!------------------------------------------------------------------------登入後的畫面---------------------------------------------------------------->
<html>
<head>
<meta charset="utf-8"/>
<title>cyBus</title>
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/<?php echo ((isset($_COOKIE["easyuiThemeName"]) && ($_COOKIE["easyuiThemeName"] !== ""))?($_COOKIE["easyuiThemeName"]):"default"); ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript">
    var index = 0;
    function addPanel1(){
        index++;
        $('#tt').tabs('add',{
            title: 'Tab'+index,
            content: '<div style="padding:10px">Content'+index+'</div>',
            closable: true
        });
    }
    function addPanel(name,url){
    	if($('#tt').tabs('exists',name)){
    		$('#tt').tabs('select',name); 
    	}else{
    	    $('#tt').tabs('add',{
                title: name,
                content: '<iframe style="width:100%;height:99%;border:0;" src="'+ url + '"></iframe>',
                style:{padding:'10px',background:'#fff'},
                closable: true
            });
    	}
    }
    function removePanel(){
        var tab = $('#tt').tabs('getSelected');
        if (tab){
            var index = $('#tt').tabs('getTabIndex', tab);
            $('#tt').tabs('close', index);
        }
    }
</script>
</head>

<body class="easyui-layout">
    <div data-options="region:'north',split:false,border:false" style="height:76px;background-color:#AFD6FF">
    	<div style="height:40px; width:100%; background-color:#AFD6FF;">
        	<div style="width:400px; height:40px;padding:10px 0 0 10px; background-color:#AFD6FF; float:left;" id="wt_logo">
			
				<img alt="" src="/cyBusAdmin/Public/images/cybus.png" style="height:60px">
        	</div>
            <div style="width:200px; height:40px;padding:10px 10px 0 10px; background-color:#AFD6FF; float:right;" id="wt_usrinfo">
            	<span style="color:blue;">
            	   welcome! <?php echo ($_SESSION['username']); ?>
           </span><a  class="easyui-linkbutton" data-options="plain:false" onclick="logout()">登出</a>
            </div>
        </div>
    	<div style="height:20px; width:100%; background-color:#AFD6FF;" id="wt_marquee">
    		<marquee align="midden" scrollamount="1" behavior="scroll" direction="left" onMouseOver="this.stop()" onMouseOut="this.start()" color="#000080"><font color="#000080"> HI~~ <?php echo ($_SESSION['username']); ?></font></marquee>
    	</div>
    </div>
    <div data-options="region:'west',title:'功能選單',split:true" style="width:200px;">
	    <div class="easyui-accordion" data-options="multiple:true" style="width:193px;" border="false">
	        <div title="車次管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
	                <li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('路線管理','busSchedule.html');"><span style="font-size:16px;">路線管理</span></a></li>
	            	<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('班次管理','busDate.html');"><span style="font-size:16px;">班次管理</span></a></li>
	            </ul>
	        </div>
	        <div title="票劵管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('售出票劵管理','salesTicket.html');"><span style="font-size:16px;">售出票劵管理</span></a></li>
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('查詢剩餘票劵','searchTicket.html');"><span style="font-size:16px;">查詢剩餘票劵</span></a></li>
				</ul>
			</div>
	        <div title="文章管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('最新消息','news.html');"><span style="font-size:16px;">最新消息</span></a></li>
				</ul>
			</div>
    	</div>
	</div>
    <div data-options="region:'center'" style="padding:5px;background:#eee;" href="">
    	<div id="tt" class="easyui-tabs" border="true" data-options="tabWidth:160,fit:true">
    	</div>
    </div>
    <script>
    //清除session
        function logout(){
            var url= '<?php echo U('Index/logout');?>';
            $.ajax({
                url:url,
                success: function(result){
                    alert("確認後登出");
                    window.location.reload();
                    }
                })
             }
</script>
</body>
</html>
<?php }?>