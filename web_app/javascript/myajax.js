var EXIST_GET="EXIST";
var HTML_GET="HTML";
var XML_GET="XML";
function MyAJAX(_url,_type,paras){
	if(_url==null||_url==""){return "";}
	var xmlhttp;
	if(window.ActiveXObject&&!window.XMLHttpRequest){
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		xmlhttp=new XMLHttpRequest();
	}
	var method="POST";
	if(_type==EXIST_GET){method="HEAD";}
	xmlhttp.open(method,_url,false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');  
	xmlhttp.send(paras);

	//304 for Opera
	if(xmlhttp.status==200||xmlhttp.status==304){
		if(_type==EXIST_GET){
			return true;
		}else if(_type==XML_GET){
			return xmlhttp.responseXML;
		}else if(_type==HTML_GET){
			return xmlhttp.responseText;
		}

	}else{
		if(_type==EXIST_GET){
			return false;
		}else{
			return null;
		}
	}
}

function getObj(o)
{
	return document.getElementById(o);
}