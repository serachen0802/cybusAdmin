<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>cyBus</title>
	<!--<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">-->
	<!--<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">-->
	<!--<link rel="stylesheet" type="text/css" href="http://www.wistrend.com/prototype/easyui/demo/demo.css">-->
	<!--<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.min.js"></script>-->
	<!--<script type="text/javascript" src="http://www.wistrend.com/prototype/easyui/jquery.easyui.min.js"></script>-->
	<!--<script type="text/javascript" src="http://www.jeasyui.com/easyui/locale/easyui-lang-zh_TW.js"></script>-->
	<!--<script src="//cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script>-->
	<link id="easyuiTheme" rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/<?php echo ((isset($_COOKIE["easyuiThemeName"]) && ($_COOKIE["easyuiThemeName"] !== ""))?($_COOKIE["easyuiThemeName"]):"default"); ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/cyBus2/Public/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="/cyBus2/Public/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/cyBus2/Public/jquery-easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <script type="text/javascript">
        var url;
        //新增
        function newUser(){
            $('#dlg').dialog('open').dialog('setTitle','新增班次');
            $('#fm').form('clear');
            // url='<?php echo U('Index/inse');?>';
        }
        //修改
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            console.log(row.store_id);
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','編輯班次');
                $('#fm').form('load',row);
                // url = '<?php echo U('Index/edit');?>?id=' + row.store_id;
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
        // //刪除資料
        // function destroyUser(){
        //     var row = $('#dg').datagrid('getSelected');
        //     if (row){
        //         $.messager.confirm('Confirm','確定要刪除這筆資料嗎？',function(r){
        //             if (r){
        //                 $.post('<?php echo U('');?>',{id:row.store_id},function(result){
        //                     console.log(result);
        //                     if (result == 1){
        //                         $('#dg').datagrid('reload'); 
        //                           // reload the user data
        //                     } else {

        //                         $.messager.show({    // show error message
        //                             title: 'Error',
        //                             msg: result//.errorMsg
        //                         });
        //                     }
        //                 },'json');
        //             }
        //         });
        //     }
        // }

        //搜尋
        function searchf(){
            $('#dg').datagrid('load',{
                search_name:'%'+$.trim($('input[name="search_name"]').val()) + '%',
                search_number:$('input[name="search_number"]').val(),
                search_address:'%'+$.trim($('input[name="search_address"]').val())+'%',
            });

        }
        //清除
        function clf(){
            $('#shfm').form('clear');
             $('#dg').datagrid('load',{
             //    search_name:"";
             //    search_number:"";
             //    search_address:"";
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




/* 	        $('#div_eastpanal').panel();
	        $('#div_eastpanal').panel({
	            onCollapse: function () {
	                SearchClear();
	                Query();
	            },
	            onExpand: function () {

	            }
	        }); */	
		}

        $(function(){
            //店家資料
            $('#dg').datagrid({
                // url:'<?php echo U('Index/store');?>',
                toolbar:'#toolbar',
                pagination:true,
                rownumbers:true,
                fit:true,
                fitColumns:false,
                singleSelect:true,
                frozenColumns:[[
                    {field:'store_id',title:'班次編號',width:100,halign:'center'},
                    {field:'store_name',title:'起站',width:100,halign:'center'},
                    {field:'store_name',title:'迄站',width:100,halign:'center'},
                    {field:'tax_id',title:'日期',width:150,halign:'center',align:'center'},
                    {field:'tax_id',title:'時間',width:150,halign:'center',align:'center'},
                ]],
                columns:[[
                    {field:'last_edit',title:'剩餘座位',width:150 ,halign:'center'},
                    {field:'remark',title:'備註',width:150,halign:'center'}                                                                       
                ]]
            });

            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            // CKEDITOR.replace( 'editor1' );
            // $('#fb').filebox({
            //     buttonText: '選擇檔案'
            // });            
        })


    </script>

<div id="cc" class="easyui-layout" data-options="fit:true">

    <div data-options="region:'center'" style="padding:5px;background:#eee;">

    <table id="dg" class="easyui-datagrid"></table>
<!-- 功能按鈕 -->
    <div id="toolbar">
  	    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>-->
  	    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">編輯</a>-->
  	    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">刪除</a>-->
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchopen()">查詢</a>
  	    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="">匯入</a>-->
  	    <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="">匯出</a> -->
  	    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="">匯入範例下載</a>-->
    </div> 
<!-- 編輯popup視窗 -->
    <div id="dlg" class="easyui-dialog" style="width:880px;height:450px;padding:10px 20px" closed="true" buttons="#dlg-buttons" modal="true" fit="true">
        <!-- <div class="ftitle">資料編輯修改</div> -->
<!-- 新增/編輯form -->
        <form id="fm" method="post" novalidate>
        	<table>
        		<tr class="row">
        			<td class="row_title"><label>車次編號：</label></td>
        			<td class="row_content">
		                <input name="store_name" style="width:400px;" class="easyui-validatebox textbox" required>
					</td>
        		</tr>
        		<tr class="row">
        			<td class="row_title"><label>日期：</label></td>
        			<td class="row_content">
		                <input name="tax_id" style="width:400px;" class="easyui-validatebox textbox">
					</td>
        		</tr>
                <tr class="row">
                    <td class="row_title"><label>時間：</label></td>
                    <td class="row_content">
                        <input name="branch_id" style="width:400px;" class="easyui-validatebox textbox">
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
	                	<td class="row_title"><label>起站：</label></td>
	                	<td class="row_content">						           
	                		<input name="search_address" style="width:175px;" class="easyui-validatebox textbox">
						</td>
	            </tr>
	            <tr>						            
	                	<td class="row_title"><label>迄站：</label></td>
	                	<td class="row_content">						           
	                		<input name="search_address" style="width:175px;" class="easyui-validatebox textbox">
						</td>
	            </tr>
	            <tr>						            
	                	<td class="row_title"><label>日期：</label></td>
	                	<td class="row_content">						           
	                		<input name="search_name" style="width:175px;" class="easyui-validatebox textbox">
						</td>
	            </tr>  
	            <tr>						            
	                	<td class="row_title"><label>時間：</label></td>
	                	<td class="row_content">						           
	                		<input name="search_number" style="width:175px;" class="easyui-validatebox textbox">
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