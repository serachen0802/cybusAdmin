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
    <script type="text/javascript">
        var url;
        //新增
        function newSchedule(){
            $('#dlg').dialog('open').dialog('setTitle','新增路線');
            $('#fm').form('clear');
            url='<?php echo U('BusSchedule/insert');?>';
        }
        //修改
        function editSchedule(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','編輯路線');
                $('#fm').form('load',row);
                url = '<?php echo U('BusSchedule/edit');?>?id=' + row.sid;
            }
        }
        function saveSchedule(){
            $('#fm').form('submit',{
                url: url,
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
                        $('#dg').datagrid('reload');    // reload the Schedule data
                    }
                }
            });
        }
        //刪除資料
    function destroy(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','確定要刪除這筆資料嗎？',function(r){
                    if (r){
                        $.post('<?php echo U('BusSchedule/remove');?>',{id:row.sid},function(result){
                            console.log(result);
                            if (result == 1){
                                $('#dg').datagrid('reload'); 
                                   // reload the Schedule data
                            } else {

                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result//.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
        //搜尋
        function searchf(){
            $('#dg').datagrid('load',{
                sid:$('input[name="sid"]').val(),
                start:'%'+$.trim($('input[name="start"]').val()) + '%',
                end:'%'+$.trim($('input[name="end"]').val())+'%',
            });
        }
        //清除
        function clf(){
            $('#shfm').form('clear');
             $('#dg').datagrid('load',{
             });
        }
        //圖片格式
        function formatPicture(val,row){
            if (val!=""){
                return '<a href="images/'+ val + '" target="_blank"><img src="images/' + val + '" style="max-width:70px; max-height:70px;"></a>';
            }else{
                return '無'
            }
        }  

        //日期格式調整
        function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'/'+(m<10?('0'+m):m)+'/'+(d<10?('0'+d):d);
        }

        //右側關閉時，清空查詢欄位
		function searchopen(){
			$('#cc').layout('expand','east');
		}
        
        $(function(){
            $('#dg').datagrid({
                url :'<?php echo U('BusSchedule/busSchedule');?>',
                toolbar:'#toolbar',
                pagination:true,
                rownumbers:true,
                fit:true,
                fitColumns:false,
                singleSelect:true,
                frozenColumns:[[
                    {field:'sid',title:'車次編號',width:100,halign:'center',align:'center'},
                    {field:'start',title:'起站',width:180,halign:'center',align:'center'},
                    {field:'end',title:'迄站',width:180,halign:'center',align:'center'},
                    {field:'oneprice',title:'全票',width:120,halign:'center',align:"center"},
                    {field:'halffare',title:'半票',width:120,halign:'center',align:"center"},
                    {field:'backandforth',title:'來回票',width:120,halign:'center',align:"center"},
                    {field:'remark',title:'備註',width:120,halign:'center'}
                ]]
             });
        })
    </script>
<div id="cc" class="easyui-layout" data-options="fit:true">
    <div data-options="region:'center'" style="padding:5px;background:#eee;">
    <table id="dg" class="easyui-datagrid"></table>
<!-- 功能按鈕 -->
    <div id="toolbar">
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSchedule()">新增</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSchedule()">編輯</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroy()">刪除</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchopen()">查詢</a>
    </div> 
<!-- 編輯popup視窗 -->
    <div id="dlg" class="easyui-dialog" style="width:880px;height:450px;padding:10px 20px" closed="true" buttons="#dlg-buttons" modal="true" fit="true">
<!-- 新增/編輯form -->
        <form id="fm" method="post" novalidate>
        	<table>
        		<tr class="row">
        			<td class="row_title"><label>起站：</label></td>
        			<td class="row_content">
		                <input name="start" style="width:400px;" class="easyui-validatebox textbox" required>
					</td>
        		</tr>
        			<tr class="row">
        			<td class="row_title"><label>迄站：</label></td>
        			<td class="row_content">
		                <input name="end" style="width:400px;" class="easyui-validatebox textbox" required>
					</td>
        		</tr>
        		<tr class="row">
        			<td class="row_title"><label>票價</label></td>
        			<td class="row_content">
					</td>
        		</tr>

        		<tr class="row">
        			<td class="row_title"><label>全票：</label></td>
        			<td class="row_content">
		                <input name="oneprice" style="width:400px;" class="easyui-validatebox textbox">
					</td>
        		</tr>
                <tr class="row">
                    <td class="row_title"><label>半票：</label></td>
                    <td class="row_content">
                        <input name="halffare" style="width:400px;" class="easyui-validatebox textbox">
                    </td>
                </tr>
        		<tr class="row">
        			<td class="row_title"><label>來回票：</label></td>
        			<td class="row_content">
		                <input name="backandforth" style="width:400px;" class="easyui-validatebox textbox" >
					</td>
        		</tr>
        		<tr class="row">
        			<td class="row_title"><label>備註：</label></td>
        			<td class="row_content">
		                <input name="remark" class="easyui-textbox textbox" value="" data-options="multiline:true" style="width:400px;height:75px">
					</td>
        		</tr>        		 		        		        		       		         		
        	</table>
        </form>
    </div>
<!-- 新增/編輯popup視窗功能按鈕 -->
    <div id="dlg-buttons">
        <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveSchedule()">儲存</a>
         <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a> 
    </div>
</div>
<!-- 搜尋條件 -->
   <div id="div_eastpanal" data-options="region:'east',title:'搜尋條件',split:true,collapsed:true" style="width:340px;">
    	<div style="padding:10px 20px">
        	<div style="margin-bottom:10px;">
	        	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="searchf()">搜尋</a>
	        	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="clf()">清除</a>
	    	</div>
	    	<form id="shfm" method="post" novalidate　style="padding-top:5px;">
	        <table>
                <tr>						            
                    <td class="row_title"><label>車次編號：</label></td>
                    <td class="row_content">						           
                        <input name="sid" style="width:175px;" class="easyui-validatebox textbox">
                    </td>
                </tr>  
                <tr>						            
                    <td class="row_title"><label>起站：</label></td>
                    <td class="row_content">						           
                        <input name="start" style="width:175px;" class="easyui-validatebox textbox">
                    </td>
                </tr>  
                 <tr>						            
                    <td class="row_title"><label>迄站：</label></td>
                    <td class="row_content">						           
                        <input name="end" style="width:175px;" class="easyui-validatebox textbox">
                    </td>
                </tr>  
            </table>
	    	</form>
    	</div>
    </div>
<!-- 編輯視窗、搜尋 form style調整 -->    
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        #fm3{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:16px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:20px;
        }
        .fitem label{
            display:inline-block;
            width:120px;
            text-align:right;
        }
        #shfm .fitem label{
            display:inline-block;
            width:80px;
            text-align:right;
        }
        .row_title {
            text-align : right;
            width:120px;
            height:40px;
        }
    </style>
    <style scoped="scoped">
        .textbox{
            height:20px;
            margin:0;
            padding:0 2px;
            box-sizing:content-box;
        }
    </style>
</body>
</html>