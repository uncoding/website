/**
 * 刘毅  koocyton@gmail.com 分页JS  下面是调用方式
 *
 * <html>
 * <head>
 * <script type="text/javascript" language="javascript" src="./cleftpage.js"></script>
 * </head>
 * <body>
 * <script>writeCleftPage(1000,12,1)</script>
 * </body>
 * </html>
 */
var nowPageUrl = window.location+'';

var nNowPage=1;

var nMaxPage=1;

function GetNoNowpageArgUrl()
{
   var pattern = /^(.*)(\#|\?|\&)nowpage=(\d*)(\&?)(.*)$/i;
   var pattern2 =/^(.*)(\#|\?)(.*)$/i
   var result = nowPageUrl.match(pattern);
   if (result!=null)
	  {
		 nNowPage = result[3];
		 if (result[2] == '?' || result[2] == '#')
			{
			   if (result[4]=="")
				  {
					 var newUrl = result[1]+result[2];
				  } else {
					 var newUrl = result[1]+result[2]+result[5]+"\&";
				  }
			} else {
			   if (result[5]=="")
				  {
					 var newUrl = result[1]+"\&";
				  } else {
					 var newUrl = result[1]+"\&"+result[5]+"\&";
				  }
			}
	  } else {
		 var result2 = nowPageUrl.match(pattern2);
		 if (result2==null)
			{
			   var newUrl = nowPageUrl + "\?";
			} else {
			   if (result2[3]=="")
				  {
					 var newUrl = result2[1]+result2[2];
				  } else {
					 var newUrl = result2[1]+result2[2]+result2[3] + "\&";
				  }
			}
	  }
   return newUrl;
}

var nNewUrl = GetNoNowpageArgUrl();

function jump(nStart)
{
	nStart = nStart-1+1;
	if (!nStart || nStart==NaN || nStart=="" || nStart == null) return;
	if (nStart > nMaxPage) return;
	if (nStart < 1) return;
	if (nStart == nNowPage) return;
	window.location = nNewUrl + "nowpage=" + nStart
}

function upPage()
{
	if (nNowPage<=1) return;
	var nStart=nNowPage-1;
	jump(nStart);
}

function downPage()
{
	if (nNowPage>=nMaxPage) return;
	var nStart=nNowPage-1+2;
	jump(nStart);
}

function firstPage()
{
	if (nNowPage<=1) return;
	var nStart=1;
	jump(nStart);
}

function lastPage()
{
	if (nNowPage>=nMaxPage) return;
	var nStart=nMaxPage;
	jump(nStart);
}

function writeCleftPage(nMaxNumber,nPageNumber,nStyle)
{
   if (nPageNumber==0 || nPageNumber==null)
	  {
		 nPageNumber = 1;
	  }
   
   nMaxPage = Math.ceil( nMaxNumber / nPageNumber );
   var nStartNumber = nNowPage*nPageNumber-nPageNumber+1;

   if (nNowPage==nMaxPage)
	  {
		 var nOverNumber = nMaxNumber;
	  } else {
		 var nOverNumber = nNowPage*nPageNumber;
	  }
   var writeStr = GetCleftPage(nMaxNumber,nPageNumber,nNowPage,nMaxPage,nStartNumber,nOverNumber,nStyle);

   document.writeln(writeStr);
}


function GetCleftPageStyle(s)
{
   var style = new Array();

   style[0] = '<style type="text/css">'
	  + '<!--' 
	  + '.cleft_tableborder	{ background: #D6E0EF; border: 1px solid #698CC3 } ' 
	  + '.cleft_smalltxt		{ font: 12px Tahoma, Verdana }' 
	  + '.cleft_header		{ font: 12px Tahoma, Verdana; color: #FFFFFF; font-weight: bold; background-color: #698CC3 }'
	  + '.cleft_jump			{ text-decoration: none; font: 12px Webdings; color: #006699; cursor: hand;}'
	  + '.cleft_link			{ text-decoration: none; font: 12px; color: #006699; cursor: hand;}'
	  + '.cleft_input			{border: 1px solid #698CC3}'
	  + '-->' 
	  + '</style>';

   style[1] = '<style type="text/css">'
	  + '<!--' 
	  + '.cleft_tableborder	{ background: #cccccc; border: 1px solid #999999 } ' 
	  + '.cleft_smalltxt		{ font: 12px Tahoma, Verdana }' 
	  + '.cleft_header		{ font: 12px Tahoma, Verdana; color: #FFFFFF; font-weight: bold; background-color: #AFAFAF}'
	  + '.cleft_jump			{ text-decoration: none; font: 12px Webdings; color: #773300; cursor: hand;}'
	  + '.cleft_link			{ text-decoration: none; font: 12px; color: #773300; cursor: hand;}'
	  + '.cleft_input			{border: 1px solid #999999}'
	  + '-->' 
	  + '</style>';

   s = style[s] ? s : 0 ;

   return style[s];
}

function GetCleftPage(nMaxNumber,nPageNumber,nNowPage,nMaxPage,nStartNumber,nOverNumber,nStyle)
{
   var style = GetCleftPageStyle(nStyle)

   var nEchoString = '<table cellspacing="0" cellpadding="0" border="0"><tr><td height="3"></td></tr><tr><td>'
	  + '<table cellspacing="1" cellpadding="2" class="cleft_tableborder"><tr bgcolor="#F8F8F8" class="cleft_smalltxt">'
	  + '<td class="cleft_header">&nbsp;' + nMaxNumber + '&nbsp;</td>'
	  + '<td class="cleft_header">&nbsp;' + nNowPage + '/' + nMaxPage +'&nbsp;</td>';
   
   var nBeginPage = nNowPage-3;
   if (nBeginPage < 1)
	  {
		 nBeginPage = 1;
	  }
   
   var nEndPage = nBeginPage+6;
   if (nEndPage > nMaxPage)
{
   nEndPage = nMaxPage;
}
   nBeginPage = nEndPage-6;
   if (nBeginPage < 1)
	  {
		 nBeginPage = 1;
	  }
   for (var j = nBeginPage; j <= nEndPage ; j++)
{
   if (j == nBeginPage && nBeginPage != 1)
	  {
		 nEchoString += '<td align="center" onmouseover="this.bgColor=\'#D6E0EF\'" onmouseout="this.bgColor=\'#F8F8F8\'" onclick="firstPage()" class="cleft_jump">&nbsp;9&nbsp;</td>'
		 nEchoString += '<td align="center" onmouseover="this.bgColor=\'#D6E0EF\'" onmouseout="this.bgColor=\'#F8F8F8\'" onclick="upPage()" class="cleft_jump">&nbsp;7&nbsp;</td>'
	  }
   if (j == nNowPage)
	  {
		 nEchoString += '<td bgcolor="#FFFFFF" align="center">&nbsp;<b>' + j + '</b>&nbsp;</td>'
	  } else {
		 nEchoString += '<td align="center" onmouseover="this.bgColor=\'#D6E0EF\'" onmouseout="this.bgColor=\'#F8F8F8\'" style="cursor: hand;" onclick="jump(\'' + j + '\')" class="cleft_link">&nbsp;' + j + '&nbsp;</td>'
	  }
   if (j == nEndPage && nEndPage != nMaxPage)
	  {
		 nEchoString += '<td align="center" onmouseover="this.bgColor=\'#D6E0EF\'" onmouseout="this.bgColor=\'#F8F8F8\'" onclick="downPage()" class="cleft_jump">&nbsp;8&nbsp;</td>'
		 nEchoString += '<td align="center" onmouseover="this.bgColor=\'#D6E0EF\'" onmouseout="this.bgColor=\'#F8F8F8\'" onclick="lastPage()" class="cleft_jump">&nbsp;:&nbsp;</td>'
	  }
}
   
   nEchoString += '<td style="padding: 0">'
	  + '<input type="text" name="custompage" size="3" class="cleft_input" onKeyDown="javascript: if(window.event.keyCode == 13) jump(this.value)">'
	  + '</td></tr></table>'
	  + '</td></tr><tr><td height="3">'
	  + '</td></tr></table>';
   
   return style + nEchoString;
}