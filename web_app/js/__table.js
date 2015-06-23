function __image(access_url,_image,target,width,height){
	if( ((_image == undefined )==false) && _image!=null && _image!=""){
		$.post(access_url,{ image: _image}, 
					function(data){
                    $("#"+target).html("<a href=\""+data.imageUrl+"\" target=\"_blank\"><image src=\""+data.imageUrl+"\" width=\""+width+"\" height=\""+height+"\" border=\"0\"/></a>");
            },'json'
       );
    	
    }}

//id为将要显示的tr的id，url,为地址及参数，采用get传值,返回数据统一为message
function _auto(id,url){
	if(url=='' && id=='' ){
		alert("参数有误");
	}else{
		$.get(url,'',function(data,status){
			if (status=='success'){
				if(data.message){
					$('#'+id).html(data.message);
				}else{
					$('#'+id).html(" <td width='100' height='20' align='left' nowrap bgcolor='#DFE8F6'><font clolr='red'>数据加载异常</font></td>");
				}
			}else{
				$('#'+id).html(" <td width='100' height='20' align='left' nowrap bgcolor='#DFE8F6'><font clolr='red'>数据加载异常</font></td>");
			}
		},'json');
	}
}

//ajax表单提交 target要显示的容器ID，obj要提交的表单对象js对象
function _submit(obj,target){
	
	$.get($(obj).attr('action'),$(obj).serialize(),function(data,status){
		if (status=='success'){
			if(data.message){
				$('#'+target).html(data.message);
			}else{
				$('#'+target).html(" <td width='100' height='20' align='left' nowrap bgcolor='#DFE8F6'><font clolr='red'>数据加载异常</font></td>");
			}
		}else{
			$('#'+target).html(" <td width='100' height='20' align='left' nowrap bgcolor='#DFE8F6'><font clolr='red'>数据加载异常</font></td>");
		}
		$(obj).hide();
	},'json');
	return false;
}

function _d(o){
	//alert($(o).attr("href"));
	var _href = $(o).attr("href");
	var _title = "新窗口";
	ymPrompt.win({message:_href,iframe:true,width:1000,height:500,title:_title,showMask:false,handler:function(tp){
		
		if(tp=='close'){
			
		}
		
	}});
	
	return false;
}

function _testReturn(id,url){
	var obj=$("#"+id);
	$.get(url,'',function (data){
		obj.html("");
	},'json');
}

YAHOO.example.DynamicData = function(config) {
   
    var defaultSize 	= 20;
    var rowsPerPageOptions = [defaultSize,50,100]
    var myColumnDefs 	= config.columnDefs;
    var resultsList		= config.resultsList!=null?config.resultsList:"result";
    var totalRecords	= config.totalRecords!=null?config.totalRecords:"totalCount";
    var startIndex		= config.startIndex!=null?config.startIndex:"start";
    var formId 			= config.formId;
    var url				= config.url;
    
    var _url = null;
    if(formId!=null){
    	var _par = $("#"+formId).serialize();
    	var _act = $("#"+formId).attr("action");
    	_url=_act+"?"+_par;
    }else{
    	_url=url;
    }
    //alert(_url);
    var myDataSource 	= new YAHOO.util.DataSource(_url);
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
    myDataSource.responseSchema = {
        resultsList: resultsList,
        fields: config.fields,
        metaFields: { 
    			totalRecords: totalRecords, 
    			startIndex: startIndex
        	} 
    }; 
    var generateRequest = function(oState, oSelf) {
        oState = oState || { pagination: null, sortedBy: null };
        var _start = (oState.pagination) ? oState.pagination.recordOffset : 0;
        var _size = (oState.pagination) ? oState.pagination.rowsPerPage : defaultSize;
        return  "&query.index=" + _start +"&query.offset=" + _size;
    };
    
    var pag = new YAHOO.widget.Paginator({
    	rowsPerPage:defaultSize,
    	lastPageLinkLabel:"末页",
    	firstPageLinkLabel:"首页",
    	previousPageLinkLabel:"上一页",
    	nextPageLinkLabel:"下一页",
    	template:"{FirstPageLink}{PreviousPageLink}{PageLinks}{NextPageLink}{LastPageLink} 跳转到{JumpToPageDropdown}页　每页显示{RowsPerPageDropdown}行 {CurrentPageReport}",
    	pageReportTemplate : '记录数:{totalRecords}',
    	rowsPerPageOptions : rowsPerPageOptions});

    /**
     * 自定义的表格配置
     */
    var myConfigs = {
        generateRequest: generateRequest,
        initialRequest:  generateRequest(),
        MSG_ERROR:"加载数据异常",
        MSG_LOADING:"正在加载数据",
        MSG_EMPTY:"没有记录.",
        MSG_SORTASC:"以升序方式排序",
        MSG_SORTDESC:"以降序方式排序",
        dynamicData: true,
        paginator: pag
    };

   

    
    // 新建一个表格，第一个参数是你页面上的div的id.表格会显示在那个div中。
    var myDataTable = new YAHOO.widget.DataTable("dynamicdata", myColumnDefs, myDataSource, myConfigs);
    
    // 更新表格参数，以记录当前显示到第几行
    myDataTable.doBeforeLoadData = function(oRequest, oResponse, oPayload) {
        oPayload.totalRecords = oResponse.meta.totalRecords;
        　// 如果recordOffset设置不对，可能造成点击翻页器，翻页结果不对或者翻页器状态不更新等情况
        oPayload.pagination.recordOffset = oResponse.meta.startIndex;
        return oPayload;
    };
    
    // 为表格中的checkbox绑定事件，记录被选择的行内容的id。
    myDataTable.subscribe("checkboxClickEvent", function(oArgs){ 

    });
   
 
    // 为行点击添加事件
    // myDataTable.set("selectionMode", "single");
    myDataTable.subscribe("rowClickEvent", function(oArgs){//myDataTable.onEventSelectRow);
    	var elrow = oArgs.target;
    	var oRecord = this.getRecord(elrow);
    	var id = oRecord.getData('id');
    	//alert("你点了id为"+id+"的行");    	
    });
    
    return { 
   　		ds: myDataSource, 
    	dt: myDataTable,
    	paginator: pag,
    	refresh: function (){
    		this.paginator.fireEvent('changeRequest',this.paginator.getState({'page':this.paginator.getCurrentPage()}));
    	}
    };     
};

// 自定义内容格式化方法
YAHOO.example.DynamicData.formatoperation = function(elLiner, oRecord, oColumn, oData) { 
	var id = oRecord.getData("id");
	 elLiner.innerHTML = "<a href='#'>删除</a>&nbsp&nbsp<a href='#'>审核</a>";
}

// 自定义checkbox
YAHOO.example.DynamicData.formatCheckbox= function(el, oRecord, oColumn, oData){
	var id = oRecord.getData("id");
	el.innerHTML = "<input type='checkbox' value='" +id+ "'/>";
}

// 自定义状态列的显示
YAHOO.example.DynamicData.formatStatus = function(el, oRecord, oColumn, oData){
	var status = oRecord.getData("status");
	el.innerHTML = status == "1" ? "已审核" : "未审核";
}
//自定义刷新数据
YAHOO.example.DynamicData.refresh=function (){
	var paginator=YAHOO.example.DynamicData.pag;
	paginator.fireEvent('changeRequest',paginator.getState({'page':paginator.getCurrentPage()}));
}

 // 自定义日期类型的显示
YAHOO.example.DynamicData.formatDate = function(el, oRecord, oColumn, oData){
	var oDate = new Date(oData);		
	var month = oDate.getMonth() +1;
	var year = oDate.getFullYear();
	var day = oDate.getDate();
	var hour = oDate.getHours();
	var minute = oDate.getMinutes();
	el.innerHTML = year+"-"+month+"-"+day+" " + hour+":" + minute;
	//el.innerHTML = oDate.toLocaleString();
}