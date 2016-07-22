<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>cyBus</title>
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/<?php echo ((isset($_COOKIE["easyuiThemeName"]) && ($_COOKIE["easyuiThemeName"] !== ""))?($_COOKIE["easyuiThemeName"]):"default"); ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBusAdmin/Public/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/cyBusAdmin/Public/jquery-easyui/jquery.easyui.min.js"></script>
    <script src="/cyBusAdmin/Public/ckeditor/ckeditor.js"></script>
</head>
<body>
    <script type="text/javascript">
        var url;
        //新增
        function newUser(){
            $('#dlg').dialog('open').dialog('setTitle','新增最新消息');
            $('#fm').form('clear');
            url='<?php echo U('News/insert');?>';
        }
        //修改
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            console.log(row.nid);
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','編輯');
                $('#fm').form('load',row);
                url = '<?php echo U('News/edit');?>?id=' + row.nid;
            }
        }
        function saveUser(){
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
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        //刪除資料
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','確定要刪除這筆資料嗎？',function(r){
                    if (r){
                        $.post('<?php echo U('News/remove');?>',{id:row.nid},function(result){
                            console.log(result);
                            if (result == 1){
                                $('#dg').datagrid('reload'); 
                                  // reload the user data
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
                nid:$('input[name="nid"]').val(),
                date:'%'+$.trim($('input[name="date"]').val()) + '%',
                newsed:'%'+$.trim($('input[name="newsed"]').val())+'%',
            });

        }
        //清除
        function clf(){
            $('#shfm').form('clear');
             $('#dg').datagrid('load',{
             });
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
		
        // $(function () {
        // var editor =
        // CKEDITOR.replace('body',
        // {
        //     //允許所有使用者輸入的內容
        //     allowedContent: true;
        // });
 
        //  });


        $(function(){
            //店家資料
            $('#dg').datagrid({
                url:'<?php echo U('news/news');?>',
                toolbar:'#toolbar',
                pagination:true,
                rownumbers:true,
                fit:true,
                fitColumns:false,
                singleSelect:true,
                frozenColumns:[[
                    {field:'nid',title:'編號',width:70,halign:'center',align:'center'},
                    {field:'date',title:'發佈日期',width:100,halign:'center',align:'center'},
                    {field:'title',title:'標題',width:150,halign:'center'},
                    {field:'news',title:'最新消息',width:550,halign:'center'},
                    {field:'newsed',title:'發佈人',width:100,halign:'center',align:'center'},
                                                                   
                ]]
            });
        })
        //設定搜尋欄日期選擇器的格式為yyyy-mm-dd
         $(document).ready(function(){
          $("#datebox2").datebox({
             
            formatter:function(date){
              var y=date.getFullYear();
              var m=date.getMonth()+1;
              var d=date.getDate();
              return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);        
              },
            parser:function(s){
              var t=Date.parse(s);
              if (!isNaN(t)) {return new Date(t);}
              else {return new Date();}
              }      
            });
          });
    </script>

<div id="cc" class="easyui-layout" data-options="fit:true">

    <div data-options="region:'center'" style="padding:5px;background:#eee;">

    <table id="dg" class="easyui-datagrid"></table>
<!-- 功能按鈕 -->
    <div id="toolbar">
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">編輯</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">刪除</a>
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchopen()">查詢</a>
    </div> 
<!-- 編輯popup視窗 -->
    <div id="dlg" class="easyui-dialog" style="width:880px;height:450px;padding:10px 20px" closed="true" buttons="#dlg-buttons" modal="true" fit="true">

<!-- 新增/編輯form -->
        <form id="fm" method="post" novalidate >
        	<table>
                <tr class="row">
                    <td class="row_title"><label>標題：</label></td>
                    <td class="row_content">
                        <input name="title" style="width:600px;" class="easyui-validatebox textbox">
                    </td>
                </tr>
        		<tr class="row">
        			<td class="row_title"><label>最新消息：</label></td>
        			<td class="row_content">
		                <!--<input name="news" class="easyui-textbox textbox" value="" data-options="multiline:true" style="width:400px;height:400px">-->
                        <textarea name="news" id="news" class="ckeditor"></textarea>
                        <script>
                        CKEDITOR.replace( 'news', {uiColor:"#7de3e3"});//toolskk
                        </script>
					</td>
        		</tr>       		 		        		        		       		         		
        	</table>
        </form>
    </div>
<!-- 新增/編輯popup視窗功能按鈕 -->
    <div id="dlg-buttons">
        <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">儲存</a>
        <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a> -->
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
            <td class="row_title"><label>標號：</label></td>
            <td class="row_content">						           
                <input name="nid" style="width:175px;" class="easyui-validatebox textbox">
            </td>
        </tr>
        <tr>						            
            <td class="row_title"><label>發佈日期：</label></td>
            <td class="row_content">						           
                <input name="date" style="width:175px;" class="easyui-datebox" id="datebox2">
            </td>
        </tr>  
        <tr>						            
            <td class="row_title"><label>發佈人：</label></td>
            <td class="row_content">						           
                <input name="newsed" style="width:175px;" class="easyui-validatebox textbox">
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
            /* vertical-align: top; */
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