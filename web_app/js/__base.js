 
function checkDate(dateStr) {
	var result =false;
	if(dateStr==null || dateStr == ""){
		return result;
	}
	var sYear=null;
	var sMonth=null;
	var sDay=null;
	var separate=null;
	
	sYear = dateStr.substr(0, 4);
	if (isNaN(sYear) || sYear <= 0) {
		return result;
	}
	// 转换月份
	if (dateStr.indexOf('-', 0) != -1) {
		separate = "-"
	} else {
		if (dateStr.indexOf('/', 0) != -1) {
			separate = "/"
		}
	}
	if(separate==null){
		return result;
	}
	area = dateStr.indexOf(separate, 0);
	sMonth = dateStr.substr(area + 1, dateStr.indexOf(separate, area + 1) - (area + 1)); 
	if (isNaN(sMonth) || sMonth <= 0) {
		return result;
	}
	if (sMonth.length < 2) {
		sMonth = "0" + sMonth;
	}
	// 转换日
	area = dateStr.lastIndexOf(separate);
	sDay = dateStr.substr(area + 1, dateStr.length - area - 1);
	if (isNaN(sDay) || sDay <= 0) {
		return result;
	}
	if (eval(sDay) < 10) {
		sDay = "0" + eval(sDay);
	}
	
	var iYear 	= parseInt(sYear);
	var iMonth 	= parseInt(sMonth);
	var iDay 	= parseInt(sDay);
	if (iMonth > 12) {
		return result;
	}
	var month31day = new Array(1, 3, 5, 7, 8, 10, 12); 
	var monthDayLen = 30;
	if (iMonth == 2) {
		if ((iYear % 4 == 0 && iYear % 100 != 0) || iYear % 400 == 0) {
			monthDayLen=29;
		}else{
			monthDayLen=28;
		}
	}else{
		for (i = 0; i < month31day.length; i++) {
			if (iMonth == month31day[i]) {
				monthDayLen = 31;
				break;
			} else {
				continue;
			}
		}
	}
	
	
	
	if (iDay > monthDayLen) {
		return result;
	}
	result=true;
	return result;
}


function del(delUrl,id,idType){
	var temp = idType;
	$("#dlg-confirm").dialog({
	        bgiframe: true,
	        autoOpen: false,
			minHeight:50,														
	        modal: true,
	        resizable: false,
	        buttons: {
	            "取消": function(){
	                $(this).dialog("close");
	            },
	            "确定": function(){
	            	
	            	$.ajax({ 
                       type: "GET", 
                       contentType: "application/json", 
                       url: delUrl,
                       data: temp+"="+id+"&f=json", 
                       timeout: 15000,
                       dataType: 'json', 
                       error: function(XMLHttpRequest, textStatus, errorThrown){}, 
                       success: function(result) {
                        if(result==1){
                       	 	$("#dlg-message").dialog("open");
							$("#dlg-message-content").html("删除成功");
                        }else{
                        	$("#dlg-message").dialog("open");
							$("#dlg-message-content").html("删除失败");
                        }
                         
                        
                      }
　　　　　　　　　　　});
	                $(this).dialog("close");
	            }
	        }
	    });
	    $("#dlg-confirm").dialog("open");
	    $("#dlg-confirm-content").html("确认删除?");
	    return false;	  
}
         
    
    
	$(document).ready(function(){
			$("#dlg-message").dialog({
	        bgiframe: true,
	        autoOpen: false,
			minHeight:40,														
	        modal: true,
	        resizable: false,
	        buttons: {
	            "关闭": function(){
	                jQuery(this).dialog("close");
	            }
	        }
	    	});
			doValidate();
			if (navigator.appName == "Microsoft Internet Explorer"){
				if(top!=window){
					$('body').css("width","97%")
				}
			}
	});
	

    
/**
 * 计算字符串的字节数
 */
function getBytesCount(str){
  var bytesCount = 0;
  if (str != null)
  {
    for (var i = 0; i < str.length; i++)
    {
      var c = str.charAt(i);
      if (/^[\u0000-\u00ff]$/.test(c))
      {
        bytesCount += 1;
      }
      else
      {
        bytesCount += 2;
      }
    }
  }
  return bytesCount;
}
	
	

	// 验证表单的file元素,如果大于maxFileSize返回false,否则返回true ,只适用于IE
	function validateUploadField(elementObj,maxFileSize){
  		var filePath =elementObj.value;
   		var image=new Image();
   		image.dynsrc=filePath;
   		var file_size = image.fileSize;
   		if(file_size>maxFileSize){ return false;}return true;
	}
	
	
	function validateUpload(){
  		var __maxFileSzie = 2500000;
  		var __fileV = true;
  		$('input[@type=file]').each(function(){
  			__fileV = validateUploadField(this,__maxFileSzie);
    		if(!__fileV){return false;}
  		});
  		if(!__fileV){alert("单个附件上传大小不能超过2M");}
  		return __fileV;
 	}
	

	function doValidate(){
			$('input[class^=required]').each(function(){
					$(this).after("<font color=RED>**</font>");
			});
			
			$('select[class^=required]').each(function(){
					$(this).after("<font color=RED>**</font>");
			});
			
			$('textarea[class^=required]').each(function(){
					$(this).after("<font color=RED>**</font>");
			});
			$('form[class^=v]').each(function(){
			
					if($(this).find("div.error").length){
					$(this).validate(
						{
							errorLabelContainer: $(this).find("div.error"),
							wrapper: 'li',
							meta: "validate"
						}
					);
					}else{
						$(this).validate();
					}
					
			});
	}
	
	var MsgHelper = {};
	MsgHelper.show = function(_msg) {
		$("#dlg-message").dialog("open");
		$("#dlg-message-content").html(_msg);
	}
	