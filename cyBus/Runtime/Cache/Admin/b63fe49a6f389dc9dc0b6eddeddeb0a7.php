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
</head>
<body>
    <script type="text/javascript">
       
        //搜尋
        function searchf(){
            $('#dg').datagrid('load',{
                did:$('input[name="did"]').val(),
                start:$('input[name="start"]').val(),
                end:$('input[name="end"]').val(),
                date:$('input[name="date"]').val(),
            });
        }
        //清除
        function clf(){
            $('#shfm').form('clear');
             $('#dg').datagrid('load',{
             });
        }

        //右側關閉時，清空查詢欄位
		function searchopen(){
			$('#cc').layout('expand','east');
		}

        $(function(){
            //店家資料
            $('#dg').datagrid({
                url:'<?php echo U('Searchticket/search');?>',
                toolbar:'#toolbar',
                pagination:true,
                rownumbers:true,
                fit:true,
                fitColumns:false,
                singleSelect:true,
                frozenColumns:[[
                    {field:'did',title:'班次編號',width:100,halign:'center'},
                    {field:'start',title:'起站',width:100,halign:'center'},
                    {field:'end',title:'迄站',width:100,halign:'center'},
                    {field:'date',title:'日期',width:150,halign:'center',align:'center'},
                    {field:'time',title:'時間',width:150,halign:'center',align:'center'},
                ]],
                columns:[[
                    {field:'seated',title:'剩餘座位',width:500,halign:'center'},
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
              else {return new Date();
              }
              }      
            });
          });

    </script>

<div id="cc" class="easyui-layout" data-options="fit:true">

    <div data-options="region:'center'" style="padding:5px;background:#eee;">

    <table id="dg" class="easyui-datagrid"></table>
<!-- 功能按鈕 -->
    <div id="toolbar">
  	    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchopen()">查詢</a>
    </div> 
<!-- 編輯popup視窗 -->
    <div id="dlg" class="easyui-dialog" style="width:880px;height:450px;padding:10px 20px" closed="true" buttons="#dlg-buttons" modal="true" fit="true">
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
                	<td class="row_title"><label>班次編號：</label></td>
                	<td class="row_content">						           
                		<input name="did" style="width:175px;" class="easyui-validatebox textbox">
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