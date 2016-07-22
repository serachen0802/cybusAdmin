<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    <!--<h2>Basic Form</h2>-->
    <!--<p>Fill the form and submit it.</p>-->
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
                    <td><input class="easyui-textbox" type="text" name="pwd" data-options="required:true"></input></td>
                </tr>
               
                
            </table>
        </form>
        <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">確認</a>
            
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
        </div>
        </div>
    </div>
    </div>
    <script>
    
        function submitForm(){
            var url= '<?php echo U('Login/check');?>';
             $('#ff').form('submit',{
                url:url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    console.log(result);
                   // var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');     // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
           
        }
        function clearForm(){
            $('#ff').form('clear');
        }
    </script>
    
</body>
</html>