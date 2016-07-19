<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8"/>
<title>cyBus</title>
<!-- jQuery easyui 參用 -->
<!--<link rel="stylesheet" type="text/css" href="http://www.wistrend.com/prototype/easyui/themes/default/easyui.css">-->
<!--<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">-->
<!--<link rel="stylesheet" type="text/css" href="http://www.wistrend.com/prototype/easyui/demo/demo.css">-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>-->
<!--<script type="text/javascript" src="http://www.wistrend.com/prototype/easyui/jquery.easyui.min.js"></script>-->
<!--<script type="text/javascript" src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>-->
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/<?php echo ((isset($_COOKIE["easyuiThemeName"]) && ($_COOKIE["easyuiThemeName"] !== ""))?($_COOKIE["easyuiThemeName"]):"default"); ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="/cyBus2/Public/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/cyBus2/Public/jquery-easyui/jquery.easyui.min.js"></script>
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
    		$('#tt').tabs('select',name);  //不會重覆開啟
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
<style>
	/*#wt_logo img{*/
	/*	max-height:40px;*/
	/*	max-width:400px;*/
	/*}*/
</style>
</head>

<body class="easyui-layout">
    <div data-options="region:'north',split:false,border:false" style="height:76px;background-color:#AFD6FF">
    	<div style="height:40px; width:100%; background-color:#AFD6FF;">
        	<div style="width:400px; height:40px;padding:10px 0 0 10px; background-color:#AFD6FF; float:left;" id="wt_logo">
				<!-- <sapn><strong style="font-size:32px;">資訊網後台</strong></sapn> -->
				<img alt="" src="/cyBus2/Public/images/cybus.png" style="height:60px">
        	</div>
            <div style="width:200px; height:40px;padding:10px 10px 0 10px; background-color:#AFD6FF; float:right;" id="wt_usrinfo">
            	<span style="color:blue;">使用者您好！</span><a href="" class="easyui-linkbutton" data-options="plain:false" onclick="javascript:window.open('index.html', '_self')">登出</a>
            </div>
        </div>
    	<div style="height:20px; width:100%; background-color:#AFD6FF;" id="wt_marquee">
    		<marquee align="midden" scrollamount="1" behavior="scroll" direction="left" onMouseOver="this.stop()" onMouseOut="this.start()" color="#FF0000"><font color="#FF0000"> HI~~ </font></marquee>
    	</div>
    </div>
    <div data-options="region:'west',title:'功能選單',split:true" style="width:200px;">
	    <div class="easyui-accordion" data-options="multiple:true" style="width:193px;" border="false">
	        <div title="車次管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
	                <li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('路線管理','busSchedule.html');"><span style="font-size:16px;">路線管理</span></a></li>
	            	<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('班次管理','busDate.html');"><span style="font-size:16px;">班次管理</span></a></li>
                    <li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('測試1','menu4.html');"><span style="font-size:16px;">測試1</span></a></li>
	            </ul>
	        </div>
	        <div title="票劵管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('售出票劵管理','salsTicket.html');"><span style="font-size:16px;">售出票劵管理</span></a></li>
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('查詢剩餘票劵','searchTicket.html');"><span style="font-size:16px;">查詢剩餘票劵</span></a></li>

					<!--<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('帳號管理','account.html');"><span style="font-size:16px;">帳號管理</span></a></li>-->
				</ul>
			</div>
	        <div title="文章管理" style="overflow:auto;padding:10px;">
		        <ul style="list-style-type:none;">
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('最新消息','news.html');"><span style="font-size:16px;">最新消息</span></a></li>
					<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('訂票須知','knows.html');"><span style="font-size:16px;">訂票須知</span></a></li>
				</ul>
			</div>
	       <!--  <div title="系統管理" style="padding:10px;">
		        <ul style="list-style-type:none">
	            	<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('帳號管理','account.html');"><span style="font-size:16px;">帳號管理</span></a></li>
	            	<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('角色管理','character.html');"><span style="font-size:16px;">角色管理</span></a></li>
	            	<li><a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:addPanel('系統記錄','syslog.html');"><span style="font-size:16px;">系統記錄</span></a></li>
	            </ul>
			</div> -->
    	</div>
	</div>
    <div data-options="region:'center'" style="padding:5px;background:#eee;" href="">
    	<div id="tt" class="easyui-tabs" border="true" data-options="tabWidth:160,fit:true">
    		<!-- <div title="每日食材" style="padding:10px" closable="true">
    			<iframe src="dailyfoods.html" style="width:100%;height:99%;border:0;"></iframe>
    		</div> -->
    	</div>
    	
    	<!-- <div id="store" class="easyui-pannel" style="width:100%;heigh:100%;" data-option="href='stores.html',closed:true"></div> -->
    	<!-- <iframe id="target" src="countries.html" style="width:100%;height:99%;border:0;"></iframe> -->
    </div>
</body>
</html>