<?php
function diemsg(){
	die('请求参数非法<br><a href="/">继续访问</a>');
}
function RemoveXSS($val){
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);  
 
   $search = 'abcdefghijklmnopqrstuvwxyz'; 
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
   $search .= '1234567890!@#$%^&*()'; 
   $search .= '~`";:?+/={}[]-_|\'\\'; 
   for ($i = 0; $i < strlen($search); $i++) { 
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); 
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);  
   } 
 
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'); 
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
   $ra = array_merge($ra1, $ra2); 
 
   $found = true;  
   while ($found == true) { 
      $val_before = $val; 
      for ($i = 0; $i < sizeof($ra); $i++) { 
         $pattern = '/'; 
         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
            if ($j > 0) { 
               $pattern .= '(';  
               $pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
               $pattern .= '|';  
               $pattern .= '|(&#0{0,8}([9|10|13]);)'; 
               $pattern .= ')*'; 
            } 
            $pattern .= $ra[$i][$j]; 
         } 
         $pattern .= '/i';  
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); 
         $val = preg_replace($pattern, $replacement, $val); 
         if ($val_before == $val) {  
            $found = false;  
         }  
      }  
   }  
   return $val;  
}

function vpost($url,$data){ // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
       echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}
function bbcpwd($pwd){
	return md5($pwd.PWDPRE);
}
function cutimg($fromimgname, $fromimg_startx, $fromimg_starty, $newimg_width, $newimg_height)
{
    //取得目標檔案的長寬
    $fromimg = imagecreatefromjpeg($fromimgname);
    $fromimg_info = getimagesize($fromimgname);
    $fromimg_width = $fromimg_info[0];
    $fromimg_height = $fromimg_info[1];
    //新檔案的寬高
    $newimg = imagecreatetruecolor($newimg_width, $newimg_height); // 超過256色改用這個
    //進行裁切
    imagecopy($newimg, $fromimg, 0,0,$fromimg_startx,$fromimg_starty,$newimg_width,$newimg_height);
    return $newimg;
}
function fputcsv4($fh, $arr){
        $csv = "";
        while (list($key, $val) = each($arr))
        {
        $val = str_replace('"', '""', $val);
        $csv .= '"'.$val.'",';
        }
        $csv = substr($csv, 0, -1);
        $csv .= "\n";
        if (!@fwrite($fh, $csv))
        return FALSE;
}
function excelTime($date, $time = false) {
if(function_exists('GregorianToJD')){
if (is_numeric ( $date )) {
$jd = GregorianToJD ( 1, 1, 1970 );
$gregorian = JDToGregorian ( $jd + intval ( $date ) - 25569 );
$date = explode ( '/', $gregorian );
$date_str = str_pad ( $date [2], 4, '0', STR_PAD_LEFT ) . "-" . str_pad ( $date [0], 2, '0', STR_PAD_LEFT ) . "-" . str_pad ( $date [1], 2, '0', STR_PAD_LEFT ) . ($time ? " 00:00:00" : '');
return $date_str;
}
}else{
$date=$date>25568?$date:25569;
/*There was a bug if Converting date before 1-1-1970 (tstamp 0)*/
$ofs=(70 * 365 + 17+2) * 86400;
$date =  date("Y-m-d",($date * 86400) - $ofs). ($time ? " 00:00:00" : '');
}
return $date;
}
function A($array){
	return json_decode(json_encode($array), true);
}
function T($s,$t=1){
	switch ($t){
		case 1:
			echo '<pre>';
			print_r($s);
			echo '</pre>';
		break;
		case 2:
			echo '<pre>';
			var_dump($s);
			echo '</pre>';
		break;
		default:
			echo '<pre>';
			print_r($s);
			echo '</pre>';
	}	
}
function E($numstring,$frombase="0123456789",$tobase="ABCDEFGHIJKLMNOPQRSTUVWXYZ"){
     settype($numstring, "string");  
     $from_count = strlen($frombase);
     $to_count = strlen($tobase);
     $length = strlen($numstring);
     $result = '';
     for ($i = 0; $i < $length; $i++)
     {
         $number[$i] = strpos($frombase, $numstring{$i});
     }
     do{
         $divide = 0;
         $newlen = 0;
         for ($i = 0; $i < $length; $i++)
         {
             $divide = $divide * $from_count + $number[$i];
             
             if ($divide >= $to_count)
             {
                 $number[$newlen++] = (int)($divide / $to_count);
                 $divide = $divide % $to_count;
             }
             elseif ($newlen > 0)
             {
                 $number[$newlen++] = 0;
             }
         }
         $length = $newlen;
         if ($divide >= 1 && $newlen==0 && $numstring>25) $divide = $divide-1;
         $result = $tobase{$divide} . $result;
     }while ($newlen != 0);
     return $result;
 }
function R($v,$string){
	$s = str_replace("__ROW__",$v,$string);
	$n = $v+1;
	$s = str_replace("__ROW+1__",$n,$s);
	return $s; 
}
function k($tablename,$key=array()){
	if (empty($tablename)) return false;
	$ob= new ObjFilter($tablename::_TableName);
	foreach ($key as $_k=>$_v){
		$ob->add($tablename::$_k,$_v,"=");
	}
	$_tmp = array();
	if (!empty($key)) $_tmp=DBM::$defaultDBM->filter($ob);
	return $_tmp;
}
function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
}

function dealMessage($msg){
	$obj=new stdClass();
	$obj->message=$msg;
	die(json_encode($obj));
}

function ccurl($method,$data='',$sid){
		$opts=array("http" =>array("method" =>"POST","header"=>"Content-type:application/x-www-form-urlencoded;\nsessionID:".$sid,"timeout"=>"40","content"=>$data));
		$context  = stream_context_create($opts);
		$returnData=false;
		if($result=@fopen(APISERVER_URL.$method, 'r',false,$context)){
			$_reHeader= stream_get_meta_data($result);
			$result=$body= stream_get_contents($result);
			
			foreach($_reHeader['wrapper_data'] as $v){
				if(strstr($v,'ErrorCode')){
					$_t=explode(':',$v);
					$errCode=trim($_t[1]);
				}
				if(strstr($v,'ErrorMessage')){
					$_t=explode(':',$v);
					$errMsg=trim($_t[1]);
				}
			}
			if($errCode==0){
				try{
					$_reBody=json_decode($result);
					$returnData= $_reBody;
				}catch (Exception $e) {
					$errCode=-1;
					$errMsg="服务端返回出错！";		
								
				}
			}else{
				$returnData= base64_decode($result);
			}
		}
		return $returnData;
}
function arrayToObject($array){   
	    if(!is_array($array)) return $array;   
	    $object = new stdClass();   
	    if(is_array($array) && count($array) > 0){   
	        foreach($array as $name=>$value){   
	            if($name || $name===0) $object->$name = arrayToObject($value);   
	        }   
	        return $object;   
	    }   
	    else return FALSE;   
	} 
function isPost(){
	$tmep = strtoupper(array_key_exists('REQUEST_METHOD', $_SERVER)?$_SERVER['REQUEST_METHOD']:'');
	if ($tmep == "POST"){
		return true;
	}else{
		return false;
	}
}
function arrayToFile(array $a,$name){
	$temp=array();

	foreach ($a as $k=>$v){
		if(is_numeric($v)||is_float($v)){
			$temp[]="'$k'=>$v";
		}elseif(is_bool($v)){
			$temp[]="'$k'=>".($v?true:false);
		}else{
			$temp[]="'$k'=>'$v'";
		}
	}

	return "\$$name=array(".(join(",\r\n",$temp)).");\r\n";
}
function json2xml($obj, $root=null, $encoding="utf-8") {
	$body = $root ? _tag($root, _json2xml($obj, $encoding)) : _json2xml($obj, $encoding);
	$dom = new DomDocument('1.0', $encoding);
	$dom->loadXML($body);
	$dom->formatOutput = true;
	if ($encoding) $dom->encoding = $encoding;
	return $dom;
}
function S($key,$default=''){
	return !array_key_exists($key,(array)$_SESSION)?$default:$_SESSION[$key];
}
function modify_url($mod) 
{ 
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
    $query = explode("&", $_SERVER['QUERY_STRING']);
    if (!$_SERVER['QUERY_STRING']) {$queryStart = "?";} else {$queryStart = "&";}
    // modify/delete data 
    foreach($query as $q) 
    { 
        list($key, $value) = explode("=", $q); 
        if(array_key_exists($key, $mod)) 
        { 
            if($mod[$key]) 
            { 
                $url = preg_replace('/'.$key.'='.$value.'/', $key.'='.$mod[$key], $url); 
            } 
            else 
            { 
                $url = preg_replace('/&?'.$key.'='.$value.'/', '', $url); 
            } 
        } 
    } 
    // add new data 
    foreach($mod as $key => $value) 
    { 
        if($value && !preg_match('/'.$key.'=/', $url)) 
        { 
            $url .= $queryStart.$key.'='.$value; 
        } 
    } 
    return $url; 
}

function str_addslashes(&$_value)//{{{ 使用反斜线引用字符串
{
	if (!empty($_value) && is_array($_value))
	{
		foreach($_value as $_key=>$_val) { str_addslashes($_value[$_key]); }
	} else if (!empty($_value)) {
		$_value = addslashes($_value);
	}
	return;
}
//}}}

function args_addslashes() //{{{
{
	//if (get_magic_quotes_gpc())	return;
	str_addslashes($_GET);
	str_addslashes($_POST);
}
//}}}

function action() //{{{ 接口
{
	args_addslashes();
	if (empty($_GET['act']) || !preg_match("/^([a-z_]+)\.([a-z]+)$/i",$_GET['act'],$arr))
	{
		$arr[0] = SCRIPT_NAME.'.main';
		$arr[1] = SCRIPT_NAME;
		$arr[2] = 'main';
	}
	$GLOBALS['cout']['act'] = $arr;
//	print_r($arr);
//	echo CONTROLLERS_PATH;
	include(CONTROLLERS_PATH.$arr[1].'.con.php');
	if(!file_exists(CONTROLLERS_PATH.$arr[1].'.con.php')){
		die('文件不存在');
	}	
	$f = new $arr[1];
	$f->$arr[2]();
}
//}}}

function check_yearmonthday($ymd)//{{{ 时间正则匹配
{
	$pattern = '/^(19[0-9][0-9]|20[0-9][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/';
	if (preg_match($pattern, $ymd, $parts))
	{
		$parts[4] = mktime(0,0,0,$parts[2],$parts[3],$parts[1]);
		return $parts;
	} else {
		return false;
	}
}
//}}}

function requires() //{{{ 包含文件
{
	$args = func_get_args();
	foreach($args as $arg)
	{
		if ($args[0] == $arg)
			continue;

		if (!empty($args[0]) && $args[0]=='mod')
		{
			if (file_exists(CONTROLLERS_PATH . strtolower($arg) . '.con.php'))
				require(CONTROLLERS_PATH . strtolower($arg) . '.con.php');
		}
		
		if ($args[0] != 'con') {
			if (file_exists(MODELS_PATH . strtolower($arg) . '.mod.php'))
				require(MODELS_PATH . strtolower($arg) . '.mod.php');
		}
	}
}
//}}}

function js_unescape($str)
{
         $ret = '';
         $len = strlen($str);

         for ($i = 0; $i < $len; $i++)
         {
                 if ($str[$i] == '%' && $str[$i+1] == 'u')
                 {
                         $val = hexdec(substr($str, $i+2, 4));

                         if ($val < 0x7f) $ret .= chr($val);
                         else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
                         else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));

                         $i += 5;
                 }
                 else if ($str[$i] == '%')
                 {
                         $ret .= urldecode(substr($str, $i, 3));
                         $i += 2;
                 }
                 else $ret .= $str[$i];
         }
         return $ret;
}

function __autoload ($class_name)
{
	settype ($class_name, "string");
	
	switch ($class_name)
	{
		case 'soap_server':
		case 'soapclient':
			require_once VENDORS_PATH . 'nusoap' . DS . 'nusoap.php';
		break;
		case 'SimpleMail':
			require_once VENDORS_PATH . 'SimpleMail' . DS . 'SimpleMail.class.php';
		break;
		case 'SimpleExcel':
			require_once VENDORS_PATH . 'SimpleExcel' . DS . 'SimpleExcel.class.php';
		break;
		case 'SimpleVerify':
			require_once VENDORS_PATH . 'SimpleVerify' . DS . 'SimpleVerify.class.php';
		break;
		case 'XPath':
			require_once VENDORS_PATH . 'XPath' . DS . 'XPath.class.php';
		break;
		case 'Smarty':
			require_once VENDORS_PATH . 'Smarty' . DS . 'Smarty.class.php';
		break;
		default:
			if($class_name=='Request'){
				require_once VENDORS_PATH . 'others' . DS . 'Request.php';
			}else{
				$file=CONTROLLERS_PATH . $class_name . '.con.php';
				if(file_exists($file)){
					require_once CONTROLLERS_PATH . $class_name . '.con.php';
				}
			}
		break;
	}
}

function isValidWord($vStr, $vMinLength, $vMaxLength)
{
	$vLength = strLength($vStr);
	
	if ($vLength < $vMinLength || $vLength > $vMaxLength)
	{
		return false;
	} else {
		return preg_match('/^([\x80-\xff\w])+$/', $vStr);
	}
}

function isUserName($vStr)
{
	return preg_match('/^[a-zA-Z][\w]{3,15}$/', $vStr);
}

function isNickName($vStr)
{
	return isValidWord($vStr, 1, 25);
}

function isEmail($vStr)
{
	$vLength = strLength($vStr);
	
	if ($vLength < 3 || $vLength > 50)
	{
		return false;
	} else {
		return preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $vStr);
	}
}

function isPassword($vStr)
{
	return preg_match('/^[\w]{6,20}$/', $vStr);
}

function isRealName($vStr)
{
	return isValidWord($vStr, 1, 20);
}

function isAnswer($vStr)
{
	return isValidWord($vStr, 1, 30);
}

function isTel($vStr)
{
	return preg_match('/^[\d\-]{6,20}$/', $vStr);
}

function isZipCode($vStr)
{
	return preg_match('/^[\d]{6}$/', $vStr);
}

function isProof($vStr)
{
	return preg_match('/^[\d]{8}\-0[\d]+\-[0-9a-fA-F]{6}$/', $vStr);
}

function isIDCard($vStr)
{
	$vCity = array(
		'11','12','13','14','15','21','22',
		'23','31','32','33','34','35','36',
		'37','41','42','43','44','45','46',
		'50','51','52','53','54','61','62',
		'63','64','65','71','81','82','91'
	);
	
	if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
	
	if (!in_array(substr($vStr, 0, 2), $vCity)) return false;
	
	$vStr = preg_replace('/[xX]$/i', 'a', $vStr);
	$vLength = strlen($vStr);
	
	if ($vLength == 18)
	{
		$vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
	} else {
		$vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
	}
	
	if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
	
	if ($vLength == 18)
	{
		$vSum = 0;
		
		for ($i = 17 ; $i >= 0 ; $i--)
		{
			$vSubStr = substr($vStr, 17 - $i, 1);
			$vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
		}
		
  		if($vSum % 11 != 1) return false;
  	}
  	
  	return true;
}
function isCreditCard($card_num){
	if(is_numeric($card_num) && strlen($card_num) >8){
		return TRUE;
	}else{
		return FALSE;
	}
}
function isExpireDate($card_num){
	if(is_numeric($card_num) && strlen($card_num) == 4){
		$month = substr($card_num, 0, 2);
		if (intval($month) > 12 ){
			return FALSE;
		}else{
			return TRUE;
		}
	}else{
		return FALSE;
	}
}
function isMobile($vStr) {
	return preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $vStr);
}
function isSpace($vStr)
{
	return preg_match('/^[ ]$/', $vStr);
}


function location($url="", $msg="", $jump=true)//{{{ 页面跳转
{
	if (empty($url))
		$location = 'window.history.back(-1);';
	else
		$location = 'window.location.href="'.$url.'";';
	
	if (empty($jump))
		$location = 'try{parent.document.getElementById(\'loadwait\').style.visibility=\'hidden\'}catch(e){}';

	if (!empty($msg))
		$alert = 'alert("'.$msg.'");';
	else
		$alert = '';
	
	$html = '<html><head><title>Loading...</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><script language="JavaScript"> function nOnLoad() { '.$alert.$location.' }; window.onload = nOnLoad; </script></head><body></body></html>';
	echo $html;
	exit;
}
function location_new($url="", $msg="", $jump=true)//{{{ 页面跳转
{
	if (empty($url))
		$location = 'window.history.go(-2);';
	else
		$location = 'window.location="'.$url.'";';
	
	if (empty($jump))
		$location = 'try{parent.document.getElementById(\'loadwait\').style.visibility=\'hidden\'}catch(e){}';

	if (!empty($msg))
		$alert = 'alert("'.$msg.'");';
	else
		$alert = '';
	
	$html = '<html><head><title>Loading...</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><script language="JavaScript"> function nOnLoad() { '.$alert.$location.' }; window.onload = nOnLoad; </script></head><body></body></html>';
	echo $html;
	exit;
}
function _blanklocation($url=""){
	$html = "<html><head><title>Loading...</title><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script language='javascript'>window.open('".$url."','_blank');</script></head><body></body></html>";
	echo $html;
}
//}}}

function iframelocation($act_avg) //{{{
{
	$_STR = "<html><head><title></title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n".
			"<script>\n".
			"<!--\n".
			"function nOnLoad() \n{\nparent.nnFrameOnload(window.location);\nwindow.setTimeout(\"jump();\", 10);\n}\n".
			"function jump() \n{\nparent.document.getElementById('act_avg').value = \"".$act_avg."\";\n".
			"parent.act();\n}\n".
			"window.onload = nOnLoad;\n".
			"-->\n".
			"</script>\n".
			"</head><body></body></html>\n";
	echo $_STR;
	exit;
}
//}}}

function cut_str($string, $sublen, $start=0, $code='UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        return join('', array_slice($t_string[0], $start, $sublen));

    } else {

        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
        for($i=0; $i<$strlen; $i++)
        {
            if($i>=$start && $i<($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
                else $tmpstr.= substr($string, $i, 1);
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        return $tmpstr;
    }
}

function return_array_checked ($params) //{{{
{
	extract($params);
	if (empty($arr) || empty($sub))
		return '';
	$arr_new = json_decode($arr);
	if (!in_array($sub, $arr_new))
		return '';
	else 
		return 'checked';
}
//}}}

function return_array_value ($params) //{{{
{
	extract($params);
	if (!isset($arr[$sub])) 
		return "";
	else
		return $arr[$sub];
}
//}}}

function return_selected ($params) //{{{
{
	extract($params);
	if(in_array($sub,$arr)) return 'selected';
}
//}}}

function return_checked ($params) //{{{
{
	extract($params);
	if(in_array($sub,$arr)) return 'checked';
}

function return_msubstr ($params) //{{{
{
	extract($params);

	if(!isset($string) || $string==="")
		$string="";

	if(empty($sublen))
		$sublen="20";

	if(empty($more))
		$more=false;
	else
		$more=true;
	return cut_str($string, $sublen);
}
//}}}

function getPageNav($total_info, $now_page, $page_size, $prefix, $suffix='.html')
{
	$total_page = ceil($total_info / $page_size);
	$now_page  = min($total_page, max(1, $now_page));
	$nav_starter = max(1, $now_page - 2);
	$nav_ender = min($total_page, $now_page + 2);
	$nav_string = "";
	
	if($total_page > 1)
	{
		if ($now_page > 1) 
			$nav_string .= "<a href=\"{$prefix}1{$suffix}\" title=\"首页\">首页</a>";
		
		if ($now_page > 1) 
			$nav_string .= "<a href=\"{$prefix}" . strval($now_page - 1) . "{$suffix}\" title=\"上一页\">上一页</a>";
		
		for($i = $nav_starter ; $i <= $nav_ender ; $i++)
		{
			$nav_string .= ($i == $now_page) ? 
				"<a href=\"javascript:void(0);\" title=\"第{$i}页\"><strong>{$i}</strong></a>" : 
				"<a href=\"{$prefix}{$i}{$suffix}\" title=\"第{$i}页\">{$i}</a>";
		}
		
		if ($now_page < $total_page) 
			$nav_string .= "<a href=\"{$prefix}" . strval($now_page + 1) . "{$suffix}\" title=\"下一页\">下一页</a>";
		
		if ($now_page < $total_page) 
			$nav_string .= "<a href=\"{$prefix}{$total_page}{$suffix}\" title=\"末页\">末页</a>";
		
		$nav_string .= " 共{$total_page}页";
	}
	
	return $nav_string;
}
/**
 * 获得用户的ip
 *
 * @return ip
 */
function getClientIP()
{
	if (isset($_SERVER))
	{
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR"))
		{
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
    }
	
    return addslashes($realip);
}

/**
 * 根据周取时间段
 *
 * @param unknown_type $year 年
 * @param unknown_type $week 周
 * @return unknown
 * 
 * $date = "2008-12-29";
 * implode("|", getTimeMiddle(2009,01));
 */

function getTimeMiddle($year,$week)
{
		//得到一年新的开始
		$start_day = ($year-1)."-12-23";
		for($j=1;$j<=14;$j++){
			$tmp_time = strtotime($start_day)+86400*$j;
			$tmp_day = date("Y-m-d",$tmp_time);
			if(getWeek($tmp_day) == 1){
				$start_time = strtotime($tmp_day);
				break;
			}
		}
		//$start_time = strtotime($start_day);
		for($i=0;$i<365;$i++)
		{
			$tmp_time = $start_time+86400*$i;
			$tmp_day = date("Y-m-d",$tmp_time);
			
			if(getWyear($tmp_day) == $year && getWeek($tmp_day) == $week)
			{
				return aweek($tmp_day, 1);
				break;
			}
		}
		return null;
}
/**
 * 按周 取年份
 *
 * @param unknown_type $date 日期 YYYY-MM-DD
 * @return unknown
 * 
 * $date = "2008-12-29";
 * echo getWyear($date)."年".getWeek($date)."周";
 */
function getWyear($date)
{
	$y = date("Y",strtotime($date));
	$m = date("m",strtotime($date));
	$w = date("W",strtotime($date));
	
	if($m=='12' && $w=='01')
		return ($y+1);
	else 
		return ($y);
}

/**
 * 取周
 *
 * @param unknown_type $date 日期 YYYY-MM-DD
 * @return unknown
 */
function getWeek($date)
{
	$w = date("W",strtotime($date));
	return $w;
}
/**
 * 取得给定日期所在周的开始日期和结束日期
 * 
 * @param unknown_type $gdate $gdate 日期，默认为当天，格式：YYYY-MM-DD
 * @param unknown_type $first $first 一周以星期一还是星期天开始，0为星期天，1为星期一
 * @return unknown 返回：数组array("开始日期", "结束日期");
 * 
 * $date = "2008-12-29";
 * echo implode("|", aweek($date, 1));
 */
function aweek($gdate = "", $first = 0){
 if(!$gdate) $gdate = date("Y-m-d");

 $w = date("w", strtotime($gdate));//取得一周的第几天,星期天开始0-6
 $dn = $w ? $w - $first : 6;//要减去的天数
 $st = date("Y-m-d", strtotime("$gdate -".$dn." days"));
 $en = date("Y-m-d", strtotime("$st +6 days"));

 return array($st, $en);//返回开始和结束日期
}

// 取得某月天数,可用于任意月份
function getMonthDays($year,$month)
{
    switch($month)
    {
        case 4:
        case 6:
        case 9:
        case 11:
            $days = 30;
            break;

        case 2:
            if ($year%4==0)
            {
                if ($year%100==0)
                {
                    $days = $year%400==0 ? 29 : 28;
                }
                else
                {
                    $days =29;
                }
            }
            else
            {
                $days = 28;
            }
            break;

        default:
            $days = 31;
            break;
    }

    return $days;
}
function ado_link($models_name="")
{
	$GLOBALS['mydb']=false;
	if ($GLOBALS['mydb'] === false)
	{
		if (!defined('ADODB_IS_REQUIRED'))
		{
			define('ADODB_IS_REQUIRED','1');
			require (VENDORS_PATH.'adodb5'.DS.'adodb.inc.php');
		}
		
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$GLOBALS['mydb'] = &NewADOConnection('mysql');
		
		if (defined("MYDB_SOCK"))
		{
			$GLOBALS['mydb']->PConnect(
				MYDB_HOST.':'.MYDB_PORT.':'.MYDB_SOCK, 
				MYDB_USER, MYDB_PASS, MYDB_LIBR
			) or die($GLOBALS['mydb']->ErrorMsg());
		} else {
			$GLOBALS['mydb']->PConnect(
				MYDB_HOST.':'.MYDB_PORT, 
				MYDB_USER, MYDB_PASS, MYDB_LIBR
			) or die($GLOBALS['mydb']->ErrorMsg());
		}
		$GLOBALS['mydb']->Execute('SET NAMES "utf8";');
	}
	
	$models_name = strtolower($models_name);
	
	if (!empty($GLOBALS['mod'][$models_name]))
	{
		$GLOBALS['mod'][$models_name]->dataTableName = $models_name;
		return $GLOBALS['mod'][$models_name];
	}
	
	$models_class_file = MODELS_PATH . $models_name . '.mod.php';
	$models_class = $models_name;
	
	if (!file_exists($models_class_file))
	{
		$models_class_file = MODELS_PATH . 'models.php';
		$models_class = "models";
	}
	
	require_once($models_class_file);
	$GLOBALS['mod'][$models_name] = new $models_class($models_name);
	return $GLOBALS['mod'][$models_name];
}


function memcache_link()
{
        if (empty($GLOBALS['memcached'])) $GLOBALS['memcached'] = @memcache_connect(GM_MEMHOST, GM_MEMPOST);
        return $GLOBALS['memcached'];
}

function get_cache_value($mKey)
{
        if (!MEMCACHED_ABLE) return FALSE;
        $memcacheObj = &memcache_link();
        return empty($memcacheObj) ? FALSE : $memcacheObj->get($mKey);
}

function set_cache_value($mKey, $mValue=FALSE, $mFlag=FALSE, $mExpire=FALSE)
{
        if (!MEMCACHED_ABLE) return FALSE;
        $memcacheObj = &memcache_link();
        if (!empty($memcacheObj)) $memcacheObj->set($mKey, $mValue, $mFlag, $mExpire);
}
function replace_cache_value($mKey, $mValue=FALSE, $mFlag=FALSE, $mExpire=FALSE)
{
	if (!MEMCACHED_ABLE) return FALSE;
	$memcacheObj = &memcache_link();
	if (!empty($memcacheObj)) $memcacheObj->replace($mKey, $mValue, $mFlag, $mExpire);
}
function add_cache_value($mKey, $mValue=FALSE, $mFlag=FALSE, $mExpire=FALSE)
{
	if (!MEMCACHED_ABLE) return FALSE;
	$memcacheObj = &memcache_link();
	if (!empty($memcacheObj)) $memcacheObj->add($mKey, $mValue, $mFlag, $mExpire);
}
function del_cache_value($mKey)
{
	if (!MEMCACHED_ABLE) return FALSE;
	$memcacheObj = &memcache_link();
	if (!empty($memcacheObj)) $memcacheObj->delete($mKey);
}
//加密
define('COMM_ENCRYPT', 1);

function mystr_rot13($str,$direction = 0) {
    $from = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $to =   'kBh8OGr5PzXQ3DVbnTdfoswpujWSFxmMK0Z6yq2vLlaeYgcR7A9E4HJi1UNtCI';
	if($direction == 0)
		return strtr($str, $from, $to);
	else
		return strtr($str, $to, $from);
}

function easy_encrypt($str) {
	if(COMM_ENCRYPT == 1)
		return mystr_rot13(base64_encode($str));
	else
		return $str;
}

function easy_decrypt($str) {
	if(COMM_ENCRYPT == 1)
		return base64_decode(mystr_rot13($str,1));
	else
		return $str;
}
function filterhtml($str) {
	$str=str_replace("\\", '', $str);
	$str=str_replace(" ", '', $str);
	$str=str_replace("::", ':', $str);
	$str=str_replace(" ", '', $str);
	$str=str_replace("&nbsp;", '', $str);
	return $str;
}
function create_token($client_data)
{
	if (empty($client_data) || !is_array($client_data) || count($client_data)<1)
		return false;
	if (!defined('GAME_GLOBAL_KEY'))
		return false;
	$str = GAME_GLOBAL_KEY;	
    sort($client_data);
    foreach ($client_data as $key=>$val){
       	if (is_array($val)) $val = serialize($val);
       	$str .= '|-|'.$val;
    }
	//@error_log("\nstr: " . $str . "\n", 3, "c:/aaaa.log");
    return md5($str);
}


function download($file_dir,$file_name){
	//参数说明：
	//file_dir:文件所在目录
	//file_name:文件名
	$file_dir = chop($file_dir);//去掉路径中多余的空格
	//得出要下载的文件的路径
	if($file_dir != '')
	{
		$file_path = $file_dir;
		if(substr($file_dir,strlen($file_dir)-1,strlen($file_dir)) != '/')
		$file_path .= '/';
		$file_path .= $file_name;
	} else {
		$file_path = $file_name;
	}

	//判断要下载的文件是否存在
	if(!file_exists($file_path))
	{
		echo '对不起,你要下载的文件不存在。';
		return false;
	}

	$file_size = filesize($file_path);
	
	header("Content-type:application/octet-tream");
	header('Content-Transfer-Encoding: binary');
	header("Content-Length:$file_size");
	header("Content-Disposition:attachment;filename=".$file_name);
	@readfile($file_name);

}


?>
