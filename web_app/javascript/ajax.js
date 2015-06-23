Ajax = function()
{
	var xmlhttp;           
	var failed;                     
	var elementObj;        
	var method;	           
	var responseStatus;    
	var url;               
	var domObj;
	var display;
	     
	this.xmlhttp = null;	
	this.failed = true;	
	this.element = 'hiddenDIV';
	this.method = 'GET';	
	this.createAJAX();	
}
Ajax.prototype.onLoading = function(){
    //document.getElementById('hiddenDIV').innerHTML= 'Loading,please wait ...';
};
Ajax.prototype.onLoaded = function(){   
    //document.getElementById('hiddenDIV').innerHTML= '<img src="../img/loading.gif"></img>';
};
Ajax.prototype.onFail = function(){	
    //document.getElementById('hiddenDIV').innerHTML= 'Loading,please wait ...';	
};
Ajax.prototype.onInteractive = function(){
     //alert('Loading,please wait ...');
    //document.getElementById('hiddenDIV').innerHTML= 'Loading,please wait a...';
};
Ajax.prototype.createAJAX = function() {
	try {
		this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e1) {
		try {
			this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e2) {
			this.xmlhttp = null;
		}
	}

	if (! this.xmlhttp) {
		if (typeof XMLHttpRequest != "undefined") {
			this.xmlhttp = new XMLHttpRequest();
		} else {
			this.failed = true;
		}
	}
};
//ִAjax	
Ajax.prototype.runAJAX = function(urlstring,querystring,method,display) 
{
    var self = this;
	this.url = urlstring;
	this.display = display;
	if(method.toLowerCase() == 'get')
	{
		this.xmlhttp.open("GET", this.url, true);
		this.xmlhttp.send(null);	
	}
	else if(method.toLowerCase() == 'post')
	{
	    this.xmlhttp.open("POST",querystring,true);
	    this.xmlhttp.setRequestHeader("Content-Type",   "application/x-www-form-urlencoded;");
	    this.xmlhttp.send(querystring);
	}		
	this.xmlhttp.onreadystatechange = function(){self.process.call(self)};		
};
Ajax.prototype.process = function()
{
	switch (this.xmlhttp.readyState) 
	{
		case 1:
			this.onLoading();
			break;
		case 2:
			this.onLoaded();
			break;
		case 3:
			this.onInteractive();
			break;
		case 4:
			this.response = this.xmlhttp.responseText;
			this.responseXML = this.xmlhttp.responseXML;
			this.responseStatus = this.xmlhttp.status;
			//document.getElementById('hiddenDIV').innerHTML
			
			xmlDoc = this.xmlhttp.responseXML;
			if(this.display == 1)
			     this.DispalayRegionList(this.response);		
			break;
	}
};
Ajax.prototype.DispalayRegionList = function(tag)
{
  //alert(tag);
  document.getElementById("reglist").innerHTML=tag;
}

