//隐藏显示查询表单
function changeFormStatus()
{
	if(document.getElementById('searchform'))
	{
		if(document.getElementById('searchform').style.display=='')
			document.getElementById('searchform').style.display='none';
		else
			document.getElementById('searchform').style.display='';
	}
}

function sort()
{
	document.getElementById('formsearchform').submit();
}

function CopyResult(){
    if(document.all){
        window.clipboardData.setData("Text",document.getElementById('resultdata').innerHTML);
        alert("查询结果已复制，请直接粘贴到EXCEL");
    }
    else
    {
    	alert("请在Internet Explorer下使用复制功能");
    }
}

function PrintResult()
{
	if(document.all){
		window.print();
	}
	else
	{
		alert("请在Internet Explorer下使用打印功能");
	}
}
function sorttable(sv){
	document.getElementById("sort").value = sv;
	document.getElementById('formsearchform').submit();
}

function help()
{
	if(parent.window.document.getElementById('allFrame').rows=='*,0')
	{
		parent.window.document.getElementById('allFrame').rows = '*,20%';
		if(document.getElementById('help_body'))
		{
			parent.frames['bottomFrame'].document.getElementById('help_body').innerHTML = document.getElementById('help_body').innerHTML;
		}
	}
	else
	{
		parent.window.document.getElementById('allFrame').rows = '*,0';
		//parent.frames['bottomFrame'].document.getElementById('help_body').innerHTML =  '';
	}
}

function autoloadhelp()
{
	if(parent.frames['mainFrame'].document.getElementById('help_body'))
	{
		document.getElementById('help_body').innerHTML = parent.frames['mainFrame'].document.getElementById('help_body').innerHTML;
	}
}
function setAllCheckbox(obj, only)
{
	checkboxs = document.body.getElementsByTagName("INPUT");
	
	for (i = 0 ; i < checkboxs.length ; i++)
	{
		if (checkboxs[i].type == 'checkbox' && checkboxs[i].name == only && checkboxs[i].disabled == false)
		{
			checkboxs[i].checked = obj.checked;
		}
	}
}