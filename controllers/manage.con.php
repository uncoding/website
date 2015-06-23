<?PHP
if (!defined('CLASS_MANAGE')){
	define('CLASS_MANAGE','1');
	class manage extends controllers{
		public function __construct() {
			parent::__construct();
			require_once MODELS_PATH.'db.mod.php';
		}
		public function dologin(){
			if (empty($_REQUEST['username']) || empty($_REQUEST['password']) )
			{
				die ("{failure:true, msg:'用户名或密码不能为空'}"); 
			}
			$this->mydb->setData('loginId',$_REQUEST['username']);
		    $resultSet=$this->mydb->fetch('sysuser');
			$adminInfo = $resultSet[0];
			if (empty($adminInfo))
			{
				die ("{failure:true, msg:'您输入的用户不存在'}");
			}
			if (md5($_REQUEST['password'].PWDPRE) != $adminInfo['password']) 
			{
				die ("{failure:true, msg:'您输入的密码有误'}");
			}
			if ($adminInfo['state'] != '1') 
			{
				die ("{failure:true, msg:'您输入的用户未审核，请联系管理员'}");
			}
			//加入远程验证
			/*
			require_once (INCLUDE_PATH.'lock.php');
			$url = "https://oa.bbctop.com/q.php?act=home.verification";
			$data ='s='.SERIALNO.'&d='.$_SERVER['HTTP_HOST'];
			$result = vpost($url,$data);
			if (empty($result)){
				die ("{failure:true, msg:'您的网络不通！请联系管理员'}");
			}
			if (is_numeric($result) && $result > 1){
				die ("{failure:true, msg:'您的系统认证时间到期了！请联系管理员'}");
			}
			*/

			if (!empty($adminInfo) && !empty($adminInfo['userId']) && !empty($adminInfo['loginId']) )
			{
				$_SESSION[SCRIPT_NAME.'_login'] = array();
				$_SESSION[SCRIPT_NAME.'_login']['login_id']		= $adminInfo['userId'];
				$_SESSION[SCRIPT_NAME.'_login']['login_name']	= $adminInfo['loginId'];
				$_SESSION[SCRIPT_NAME.'_login']['full_name']	= $adminInfo['username'];
				$_SESSION[SCRIPT_NAME.'_login']['staff_state']	= $adminInfo['state'];
				$_SESSION[SCRIPT_NAME.'_login']['time']			= $this->cout['date']['today']['mktm'];
				//生成tree
				$this->mydb->setData('staff_id',$adminInfo['userId']);
				$auth_info=$this->mydb->fetch('staff_auth');
				$_SESSION[SCRIPT_NAME.'_login']['rank']	= $auth_info[0]['code'];
				$rank = json_decode($auth_info[0]['code']);
				$sql="SELECT * FROM `sysMenu` WHERE `menulevel` = 0 AND `isenable` = 1 ORDER BY `displayorder` ASC";
				$_tmp=$this->mydb->execsql($sql);
				$usermenu0 =  array();
				foreach ($_tmp as $_value){
					$sql="SELECT * FROM `sysMenu` WHERE `menulevel` = 1 AND `isenable` = 1 and nodekey='".$_value['nodekey']."' ORDER BY `displayorder` ASC";
					$_tmp1=$this->mydb->execsql($sql);
					if (count($_tmp1)>0){
						$usermenu =  array();
						foreach ($_tmp1 as $_value1){
							foreach ($rank as $_v){
								if ($_v == $_value1['code']){
									$menu1='<li><a href="b2wms.php?act='.$_value1['jstext'].'" target="navTab" rel="'.$_value1['jstext'].'">'.$_value1['modulename'].'</a></li>';
									array_push($usermenu,$menu1);
								}
							}
						}
						if (count($usermenu)>0){
							$menu = "";
							foreach($usermenu as $_value2){
								$menu .= $_value2;
							}
							$menu = "<li><span>".$_value['modulename']."</span><ul>".$menu."</ul></li>";
							array_push($usermenu0,$menu);
						}
					}
				}
				//error_log(print_r($usermenu0,true).'\n', 3, "/tmp/1.log");
				$_SESSION[SCRIPT_NAME.'_login']['rankmenu']= "";
				if (count($usermenu0)>0){
					foreach($usermenu0 as $_value3){
						$_SESSION[SCRIPT_NAME.'_login']['rankmenu'] .= $_value3;
					}
				}				
				//error_log(print_r($_SESSION[SCRIPT_NAME.'_login']['rankmenu'],true).'\n', 3, "/tmp/1.log");
				$log_type = $GLOBALS['cout']['act'][1]."_".$GLOBALS['cout']['act'][2];
				$log_desc = "用户登录ip:".getClientIP();					
				$this->operatelog($log_type,$log_desc);
				die ("{success:true, msg:'登录成功'}");
			} else {
				die ("{failure:true, msg:'参数有误'}");
			}
		}
		public function clipimages(){
			if (empty($_REQUEST['i'])&& ($_REQUEST['r']) ){
				$this->msg("图片数据为空");
			}else{
				$this->cout['clipimages']="./html/upload/".$_REQUEST['i'];
				$this->cout['aspectRatio']=$_REQUEST['r'];
				$this->cout['clipimagesfile']=$_REQUEST['i'];
				header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-cache, must-revalidate");
				header("Pragma: no-cache");
				$this->display("manage.clipimages.html");
			}
			
		}
		public function clipimagesdo(){
			if (isset($_REQUEST['submit']))
			{
			    //裁切圖片
			    $newimg = cutimg($_REQUEST['imgfile'], $_REQUEST['x1'], $_REQUEST['y1'], $_REQUEST['width'], $_REQUEST['height']);
			    $datafile = UPLOAD_PATH.'/'.$_REQUEST['datafile'];
			    $thumbname = UPLOAD_PATH.'/100_100_'.$_REQUEST['datafile'];
			    //header("Content-Type: image/jpg");
			    //mb_http_output("pass");
			    imagejpeg($newimg,$datafile); //直接顯示來TEST, 增加第2個參數可以存成圖片
			 	imagedestroy($newimg);
			 	require_once (VENDORS_PATH . '/Image.class.php');
			 	Image::thumb($datafile,$thumbname,'',100,100,true);
			    die("已上传，请关闭当前页");
			}

		}
		//xheditor上传文件保存
		public function upload() {
			header('Content-Type: text/html; charset=UTF-8');
			$inputname='filedata';//表单文件域name
			$attachdir=UPLOAD_PATH;//上传文件保存路径，结尾不要带/
			$dirtype=1;//1:按天存入目录 2:按月存入目录 3:按扩展名存目录  建议使用按天存
			$maxattachsize=1048576 * 300;//最大上传大小，默认是300M
			$upext='zip,rar,txt,doc,docx,ppt,xls,xlsx,csv,jpg,jpeg,gif,png,bmp,swf,flv,fla,avi,wmv,wma,rm,mov,mpg,rmvb,3gp,mp4,mp3';//上传扩展名
			$msgtype=2;//返回上传参数的格式：1，只返回url，2，返回参数数组
			$immediate=isset($_REQUEST['immediate'])?$_REQUEST['immediate']:0;//立即上传模式
			ini_set('date.timezone','Asia/Shanghai');//时区
				
			if(isset($_SERVER['HTTP_CONTENT_DISPOSITION']))//HTML5上传
			{
				if(preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info))
				{
					$temp_name=ini_get("upload_tmp_dir").'\\'.date("YmdHis").mt_rand(1000,9999).'.tmp';
					file_put_contents($temp_name,file_get_contents("php://input"));
					$size=filesize($temp_name);
					$_FILES[$info[1]]=array('name'=>$info[2],'tmp_name'=>$temp_name,'size'=>$size,'type'=>'','error'=>0);
				}
			}
			
			$err = "";
			$msg = "''";
			
			$upfile=@$_FILES[$inputname];
			if(!isset($upfile)){
				$err='文件域的name错误';
			}elseif(!empty($upfile['error'])){
				switch($upfile['error'])
				{
					case '1':
						$err = '文件大小超过了php.ini定义的upload_max_filesize值';
						break;
					case '2':
						$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
						break;
					case '3':
						$err = '文件上传不完全';
						break;
					case '4':
						$err = '无文件上传';
						break;
					case '6':
						$err = '缺少临时文件夹';
						break;
					case '7':
						$err = '写文件失败';
						break;
					case '8':
						$err = '上传被其它扩展中断';
						break;
					case '999':
					default:
						$err = '无有效错误代码';
				}
			}elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none'){
				$err = '无文件上传';
			}else{
				$temppath=$upfile['tmp_name'];
				$fileinfo=pathinfo($upfile['name']);
				$extension=$fileinfo['extension'];
				if(preg_match('/'.str_replace(',','|',$upext).'/i',$extension))
				{
					$bytes=filesize($temppath);
					if($bytes > $maxattachsize)$err='请不要上传大小超过'.$maxattachsize.'的文件';
					else
					{
						switch($dirtype)
						{
							case 1: $attach_subdir = 'day_'.date('ymd'); break;
							case 2: $attach_subdir = 'month_'.date('ym'); break;
							case 3: $attach_subdir = 'ext_'.$extension; break;
						}
						$attach_dir = $attachdir.'/'.$attach_subdir;
						if(!is_dir($attach_dir))
						{
							@mkdir($attach_dir, 0777);
							@fclose(fopen($attach_dir.'/index.htm', 'w'));
						}
						PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
						$filename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
						$target = $attach_dir.'/'.$filename;
						
						rename($upfile['tmp_name'],$target);
						@chmod($target,0755);
						//$target=__ROOT__.'/Public/Upload/article/'.$attach_subdir.'/'.$filename;
						$target='/html/upload/'.$attach_subdir.'/'.$filename;
						if($immediate=='1')$target='!'.$target;
						if($msgtype==1)$msg="'$target'";
						else $msg="{'url':'".$target."','localname':'".preg_replace("/([\\\\\/'])/",'\\\$1',$upfile['name'])."','id':'1'}";
					}
				}
				else $err='上传文件扩展名必需为：'.$upext;		
				@unlink($temppath);			
			}
			echo "{'err':'".preg_replace("/([\\\\\/'])/",'\\\$1',$err)."','msg':".$msg."}";
		}	
		public function welcome(){
			$this->display("manage.welcome.html");
		}
		public function iframe(){
			//显示列表url更改
			if (!empty($_REQUEST['showlist'])){
				$this->cout['url'] = "b2wms.php?act=manage.iframeset&url=".$_REQUEST["url"]."&showlist=".$_REQUEST['showlist'];
			}else {
				$this->cout['url'] = "b2wms.php?act=manage.iframeset&url=".$_REQUEST["url"];
			}
			$this->display("manage.iframe.html");
		}
		
		public function iframeset(){
			//显示列表url更改
			if (!empty($_REQUEST['showlist'])){
				$this->cout['url'] = "b2wms.php?act=".$_REQUEST["url"]."&showlist=".$_REQUEST['showlist'];
			}else {
				$this->cout['url'] = "b2wms.php?act=".$_REQUEST["url"];	
			}
			
			$this->display("manage.frameset.html");
		}
		public function iframeget(){
			$this->cout['url'] = "b2wms.php?act=manage.iframeurl&url=".$_REQUEST["url"]."&host=".$_REQUEST["host"];
			$this->display("manage.iframe.html");
		}
		public function iframeurl(){
			$this->cout['url'] = "http://".$_REQUEST["host"]."/b2wms.php?act=".$_REQUEST["url"];
			$this->display("manage.frameset.html");
		}
		
		public function filecreate($filename,$notice=NULL){
			if (isset($filename)) {
			    $f = $filename;
			    $fname = $f['name'];
			    $ftype = $f['type'];
			    $test_file = $f['tmp_name'];
			    $fsize = $f['size'];
			    $ferror = $f['error'];
			    if ($ferror === 0) {
			        $f = fopen($test_file, 'r');
			        $buf = fread($f, filesize($test_file));
			        $img_type = exif_imagetype($test_file);
			        if ($img_type) {
			            $image_extension = image_type_to_extension($img_type);
			            $image_extension = substr($image_extension, 1, strlen($image_extension));
			            /**
			             * 存图片
			             */
			            //定义图片尺寸数组, SIZ的构建方法有说明！
			            //$ss = array(new SIZ(400,300), new SIZ(64,64,true), new SIZ(128,128,true), new SIZ(800,800,true));
			            //定义图片尺寸数组, SIZ的构建方法有说明！也可以通过“组”获得尺寸组
			            //同时用于多组的图片调用这个方法时可以使用多个参数，如用在3个类型：__IMG_DDXQ, __IMG_ZPQ, __IMG_YHTX
			            //__IMG_DDLB //地点列表页地点图片
			            //__IMG_DDXQ //地点详情页地点图片
			            //__IMG_ZPQ //照片墙页面照片图片
			            //__IMG_XXXQ //消息详情页图片
			            //__IMG_HDXQ //活动详情页图片
			            //__IMG_QDLB //签到列表页用户/地点图片
			            //__IMG_YHTX //用户头像图片
			            //__IMG_JDLB //酒店列表页图片
			            //__IMG_JDXQ //酒店详情页图片
			            if (!empty($notice)){
			            	$ss=is_getSizeGroup(__IMG_GG);
			            }else {
			            	$ss = is_getSizeGroup(__IMG_DDXQ, __IMG_ZPQ, __IMG_YHTX,__IMG_DISH);
			            }
			            //存,有两个方法 istore_Base64File 和 istore_saveBinaryFile
			            $file_name = istore_Base64File(base64_encode($buf), $image_extension, $ss);
			            //$file_name = istore_saveBinaryFile($buf, $image_extension, __IMAGE_METHOD_NORMAL);
			            if ($file_name === false) {
			                //如果返回 fasle说明失败了。
			                //echo 'unsupported image type!';
			                return false;
			            }
			            //保存返回的$file_name到数据库中。
			            //存图片完成了。
			            //memberdx::parseStd()
			            if ($file_name === false) {
			                //return 'unsupported image type by GD!';
			                return false;
			            } else {
			                /**
			                 * 取图片，根据原来的file_name和图片尺寸种类取图片地址。
			                 * foreach ($ss as $this_s) {
			                    //echo '<br/><br/>' . $this_s->store_key . '<br/>';
			                    $img_url = istore_getImageAddr($file_name, $this_s);
			                    //echo ("<img src=$img_url /><br /><br />");
			                }
			                 */
			                /**
			                 * 取图片，注意：原图的地址也要取一次，不能直接用！！！
			                 */
			                //echo "<br/><br/>original: $file_name<br/>";
			                //$img_url = istore_getImageAddr($file_name);
			                //echo ("<img src=$img_url /><br /><br />");
			                return $file_name;
			            }
			        } else {
			            //echo 'unsupported image type by exif!';
			            return false;
			        }
			    }
			}			
		}		
		public function msg($vMsg, $vReturn='-1'){
			$this->cout['tittle'] = '提示信息';
			$this->cout['msg'] = $vMsg;
			if ($vReturn != '-1') $this->cout['return'] = $vReturn;
			if(empty($_REQUEST['refer'])){
				$refer='';
			}elseif(!empty($_REQUEST['refer'])){
				$refer=$_REQUEST['refer'];
			}else{
				$refer=$_SERVER['HTTP_REFERER'];
			}
			$this->cout['referer'] = $_SERVER['HTTP_REFERER'];			
			$this->display("manage.msg.html");
			exit;
		}
		/**
		 * 登录案例
		 */
		public function getLoginCase(){
			$db_case=new DB();
			$field=$this->apiinfo('loginConfiguration');
			$db_case->setData('caseId', $field['caseid']);
			$db_case->setData('moudleId', $field['moudleid']);
			$resultSet=$db_case->fetch('case');
			$this->cout['IOS']=array();
			$this->cout['android']=array();
			if (!empty($resultSet)){
				for ($i = 0; $i < sizeof($resultSet); $i++) {
					$code=json_decode($resultSet[$i]['content']);
					if (stripos($code->platform, 'IOS')!==FALSE ){
						array_push($this->cout['IOS'], $resultSet[$i]);
					}else{
						array_push($this->cout['android'], $resultSet[$i]);
					}
				}
			}
		}
		/**
		 * 获得用户案例
		 * Enter description here ...
		 */
		public function getMemberCase(){
			$db_case=new DB();
			$field=$this->apiinfo('loginThirdParty');
			$db_case->setData('caseId', $field['caseid']);
			$db_case->setData('moudleId', $field['moudleid']);
			$resultSet=$db_case->fetch('case');
			$this->cout['member7d']=array();
			if (!empty($resultSet)){
				for ($i=0;$i<sizeof($resultSet);$i++){
					$member=json_decode($resultSet[$i]['content']);
					if (!empty($member)){
						$resultSet[$i]['loginCode']=$member->loginCode.'(七天会员)';
						array_push($this->cout['member7d'], $resultSet[$i]);
					}
				}
			}
			$this->getMemberCase2();
		}
		
		public function getMemberCase2(){
			$db_case=new DB();
			$field=$this->apiinfo('loginDianxing');
			$db_case->setData('caseId', $field['caseid']);
			$db_case->setData('moudleId', $field['moudleid']);
			$resultSet=$db_case->fetch('case');
			$this->cout['memberdx']=array();
			if (!empty($resultSet)){
				for ($i=0;$i<sizeof($resultSet);$i++){
					$member=json_decode($resultSet[$i]['content']);
					if (!empty($member)){
						$resultSet[$i]['loginCode']=$member->loginString.'(点行会员)';
						array_push($this->cout['memberdx'], $resultSet[$i]);
					}
				}
			}
		}
		
		public function erroreport($apinfo,$jsonreq,$jsonresp,$begintime,$endtime,$isReport,$report,$orderlable){
			$moudleId=(int)$apinfo['moudleid'];
			$caseId=(int)$apinfo['caseid'];
			$apiname=$apinfo['apiname'];
			$db=new DB();
			$db->setData('case', $jsonreq);
			$db->setData('results', $jsonresp);
			$db->setData('begintime', $begintime);
			$db->setData('endtime', $endtime);
			$db->setData('caseId', $caseId);
			$db->setData('moudleId', $moudleId);
			$db->setData('errormsg', json_encode($report));
			$db->setData('orderlabele', $orderlable);
			$db->setData('apiname', $apiname);
			$lastID=$db->insert('testlog');		
			if($isReport==1 ){
				$warn=$report->warning;
				$error=$report->error;
				$warns='';
				if(sizeof($warn)>0){
					for($i=0;$i<sizeof($warn);$i++){
						if($i==0){
							$warns.=$warn[$i];	
						}else{
							$warns.=','.$warn[$i];
						}
					}
				}
				$errors='';
				$isError=0;
				if(sizeof($error)>0){
					$isError=1;
					for($i=0;$i<sizeof($error);$i++){
						if($i==0){
							$errors.=$error[$i];	
						}else{
							$errors.=','.$error[$i];
						}
					}
				}
				$warnstr='警告：'.$warns;
				$errorstr='错误：'.$errors;
				$warns="<font color='#F56200'>$warnstr</font>";
				$errors="<font color=red>$errorstr</font>";
				$msg=$warns.'<br>'.$errors;	
				if($isError==1){
					$link="<a onClick='javascript:return _d(this)' href='/b2wms.php?act=testlog.resultShow&id=$lastID'>查看结果</a>";
					$msg=$warns.'<br>'.$errors.'<br>'.$link;	
				}
//				$link="<a onClick='javascript:return _d(this)' href='/b2wms.php?act=testlog.resultShow&id=$lastID'>查看结果</a>";
//				$msg=$warns.'<br>'.$errors.'<br>'.$link;
			}else{
				$msg='单元测试出现问题，请联系相关人员！';
			}
			return $msg;
		}
		
		public function apiinfo($methodIn){
			require (DATA_PATH . 'apiconf.php');
			$info=@$CONF['api'][$methodIn];
			return $info;
		}
		public function __destruct(){
			parent::__destruct();
		}
		
	}
}	
