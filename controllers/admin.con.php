<?PHP
if (!defined('CLASS_ADMIN'))
{
	define('CLASS_ADMIN','1');
	include_once(CONTROLLERS_PATH . 'manage.con.php');
	class admin extends manage
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function sysmenu(){
			$where = "where 1 ";
			if(!empty($_REQUEST['modulename'])){
				$this->cout['modulename']=$_REQUEST['modulename'];
				$where .= " and modulename like '%".$_REQUEST['modulename']."%'";
			}
			if(!empty($_REQUEST['nodekey'])){
				$this->cout['nodekey']=$_REQUEST['nodekey'];
				$where .= " and nodekey like '%".$_REQUEST['nodekey']."%'";
			}					
			$orderby = '';
			if(!empty($_REQUEST['orderField'])){
				$this->cout['orderField']=$_REQUEST['orderField'];
				$this->cout['orderDirection']=$_REQUEST['orderDirection'];
				$orderby = ' order by '.$_REQUEST['orderField'].' '.$_REQUEST['orderDirection'];
			}else{
				$orderby = ' order by menulevel,displayorder asc ';
			}
				
			$index=empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum'];
			$size=empty($_REQUEST['numPerPage'])?20:$_REQUEST['numPerPage'];
			$row_skip=($index-1)*$size;
			$row_limit=$size;

			$sql1="SELECT * FROM `sysMenu` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
			//T($sql1);
			$resultSet3=$this->mydb->execsql($sql1);
			$sql2="SELECT * FROM `sysMenu` ".$where ;
			$totalCount=$this->mydb->fetchCount($sql2);
			$totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
				
			$this->cout['vlist']=$resultSet3;
			$this->cout['info']['totalCount']=$totalCount;
			$this->cout['info']['totalPageCount']=$totalPageCount;
			$this->cout['info']['nowPage']=$index;
			$this->cout['info']['size']=$size;
					    
			$this->display('admin.sysmenu.html');
		}
		public function sysmenuadd(){
			if(isPost()){
				$jstext ='';
				if (!empty($_REQUEST['item_jstext'])){
					$jstext = str_replace("\\", "", $_REQUEST['item_jstext']);
				}
				if ($_REQUEST['acttype'] == 1){
					$this->mydb->setData('nodekey', $_REQUEST['item_nodekey']);
					$this->mydb->setData('modulename', $_REQUEST['item_modulename']);
					$this->mydb->setData('menulevel', $_REQUEST['item_menulevel']);
					$this->mydb->setData('displayorder', $_REQUEST['item_displayorder']);
					$this->mydb->setData('code', $_REQUEST['item_code']);
					$this->mydb->setData('jstext', $jstext);
					$this->mydb->setData('isenable', $_REQUEST['item_isenable']);
					$result=$this->mydb->update('sysMenu','id',$_REQUEST['id']);
					if($result){
						$obj='{
							      "statusCode":"200", 
							      "message":"完成！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);						
					}else{
						$obj='{
							      "statusCode":"300", 
							      "message":"失败！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
					}
				}elseif ($_REQUEST['acttype'] == 2){
					if (!empty($_REQUEST['nodekey'])){
						$this->mydb->setData('nodekey',$_REQUEST['nodekey']);
						$isValid=$this->mydb->fetch('sysMenu');
						if (count($isValid) > 0)
						{	
							$obj='{
								      "statusCode":"300", 
								      "message":"节点key已存出，请重新输入！", 
								      "navTabId":"admin.sysmenu", 
								      "rel":"", 
								      "callbackType":"",
								      "forwardUrl":""
								}
								';
							die($obj);					
						}							
					}
					$this->mydb->setData('nodekey', $_REQUEST['item_nodekey']);
					$this->mydb->setData('modulename', $_REQUEST['item_modulename']);
					$this->mydb->setData('menulevel', $_REQUEST['item_menulevel']);
					$this->mydb->setData('displayorder', $_REQUEST['item_displayorder']);
					$this->mydb->setData('code', $_REQUEST['item_code']);
					$this->mydb->setData('jstext', $_REQUEST['item_jstext']);
					$this->mydb->setData('isenable', $_REQUEST['item_isenable']);
					$result=$this->mydb->insert('sysMenu');
					if(!empty($result)){
						$obj='{
							      "statusCode":"200", 
							      "message":"完成！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);						
					}else{
						$obj='{
							      "statusCode":"300", 
							      "message":"失败！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
					}
				}else{
					$this->mydb->setData('nodekey',$_REQUEST['nodekey']);
					$isValid=$this->mydb->fetch('sysMenu');
					if (count($isValid) > 0)
					{	
						$obj='{
							      "statusCode":"300", 
							      "message":"节点key已存出，请重新输入！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);					
					}					
					$this->mydb->setData('nodekey', $_REQUEST['item_nodekey']);
					$this->mydb->setData('modulename', $_REQUEST['item_modulename']);
					$this->mydb->setData('menulevel', $_REQUEST['item_menulevel']);
					$this->mydb->setData('displayorder', $_REQUEST['item_displayorder']);
					$this->mydb->setData('code', $_REQUEST['item_code']);
					$this->mydb->setData('jstext', $_REQUEST['item_jstext']);
					$this->mydb->setData('isenable', $_REQUEST['item_isenable']);
					$result=$this->mydb->insert('sysMenu');
					if(!empty($result)){
						$obj='{
							      "statusCode":"200", 
							      "message":"完成！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);						
					}else{
						$obj='{
							      "statusCode":"300", 
							      "message":"失败！", 
							      "navTabId":"admin.sysmenu", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
					}
				}
			}
			if (@$_REQUEST['acttype'] == 1 || $_REQUEST['acttype'] == 2){
				$this->mydb->setData('id',$_REQUEST['id']);
				$reactivity=$this->mydb->fetch('sysMenu');
				$this->cout['info']=$reactivity[0];
				$this->cout['acttype'] = $_REQUEST['acttype'];
				//$this->cout['actinfo'] = "更改";
			}else{
				$this->cout['acttype'] = 0;
				//$this->cout['actinfo'] = "新增";
			}
			$this->display('admin.sysmenuadd.html');
		}
		public function sysmenudel(){
			if(!empty($_REQUEST['id'])){
				$sql="DELETE FROM `sysMenu` WHERE `sysMenu`.`id` = '".$_REQUEST['id']."' limit 1;";
				$result=$this->mydb->execsql($sql);
				if($result){
					$obj='{
						      "statusCode":"200", 
						      "message":"成功", 
						      "navTabId":"admin.sysmenu", 
						      "rel":"", 
						      "callbackType":"closeCurrent",
						      "forwardUrl":""
						}
						';
					die($obj);
				}
			}			
		}

		public function group(){
			$where = "where 1 ";
			if(!empty($_REQUEST['name'])){
				$this->cout['name']=$_REQUEST['name'];
				$where .= " and name like '%".$_REQUEST['name']."%'";
			}
			$orderby = '';
			if(!empty($_REQUEST['orderField'])){
				$this->cout['orderField']=$_REQUEST['orderField'];
				$this->cout['orderDirection']=$_REQUEST['orderDirection'];
				$orderby = ' order by '.$_REQUEST['orderField'].' '.$_REQUEST['orderDirection'];
			}else{
				$orderby = ' order by createtime desc ';
			}
				
			$index=empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum'];
			$size=empty($_REQUEST['numPerPage'])?20:$_REQUEST['numPerPage'];
			$row_skip=($index-1)*$size;
			$row_limit=$size;

			$sql1="SELECT * FROM `sysUserGroup` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
			//T($sql1);
			$resultSet3=$this->mydb->execsql($sql1);
			$sql2="SELECT * FROM `sysUserGroup` ".$where ;
			$totalCount=$this->mydb->fetchCount($sql2);
			$totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
				
			$this->cout['vlist']=$resultSet3;
			$this->cout['info']['totalCount']=$totalCount;
			$this->cout['info']['totalPageCount']=$totalPageCount;
			$this->cout['info']['nowPage']=$index;
			$this->cout['info']['size']=$size;
					    
			$this->display('admin.group.list.html');
		}
		public function groupadd(){
			if(isPost()){
				$acttype=$_REQUEST['acttype'];
				$this->mydb->setData('name', $_REQUEST['item_name']);
				if ($_REQUEST['gid']){
					$this->mydb->setData('id', $_REQUEST['gid']);
				}
				$code=json_encode($_REQUEST['rank']);
				$this->mydb->setData('code',$code);
				$this->mydb->setData('userName',$_SESSION[SCRIPT_NAME.'_login']['login_name']);
				$this->mydb->setData('createtime', $this->cout['date']['today']['eymd']);
				if ($acttype==1){
					$result=$this->mydb->update('sysUserGroup','id',$_REQUEST['id']);
				}else{
					$result=$this->mydb->insert('sysUserGroup');
				}	
				if(!empty($result)){
					$obj='{
						      "statusCode":"200", 
						      "message":"完成！", 
						      "navTabId":"admin.group", 
						      "rel":"", 
						      "callbackType":"closeCurrent",
						      "forwardUrl":""
						}
						';
					die($obj);						
				}else{
					$obj='{
						      "statusCode":"300", 
						      "message":"失败！", 
						      "navTabId":"admin.group", 
						      "rel":"", 
						      "callbackType":"",
						      "forwardUrl":""
						}
						';
					die($obj);
				}
			}
			if (@$_REQUEST['acttype'] == 1){
				$this->cout['acttype'] = 1;
				if (empty($_REQUEST['id'])){
					$obj='{
						      "statusCode":"300", 
						      "message":"缺少必须的参数！", 
						      "navTabId":"admin.group", 
						      "rel":"", 
						      "callbackType":"",
						      "forwardUrl":""
						}
						';
					die($obj);						
				}
				$this->mydb->setData('id',$_REQUEST['id']);
				$resultSet=$this->mydb->fetch('sysUserGroup');
				$this->cout['vinfo'] = $resultSet[0];
				if (empty($this->cout['vinfo']['name'])){
					$obj='{
						      "statusCode":"300", 
						      "message":"用户不存在！", 
						      "navTabId":"admin.group", 
						      "rel":"", 
						      "callbackType":"",
						      "forwardUrl":""
						}
						';
					die($obj);							
				}
				$this->cout['vinfo']['rank'] =  $resultSet[0]['code'];
				//$this->cout['actinfo'] = "更改";
			}else{
				$this->cout['acttype'] = 0;
				//$this->cout['actinfo'] = "新增";
			}
			$this->display('admin.groupadd.html');
		}
		public function groupdel(){
			if(!empty($_REQUEST['id'])){
				$sql="DELETE FROM `sysUserGroup` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
				$result=$this->mydb->execsql($sql);
				if($result){
					$obj='{
						      "statusCode":"200", 
						      "message":"成功", 
						      "navTabId":"admin.group", 
						      "rel":"", 
						      "callbackType":"",
						      "forwardUrl":""
						}
						';
					die($obj);
				}
			}			
		}
		public function usersadd(){
			if(isPost()){
				$ob2= new db();
				if ($_REQUEST['acttype'] == 1){


				}else{
					$db=new DB();
					$db->setData('username', $_REQUEST['item_userName']);
					$db->setData('loginId', $_REQUEST['item_loginId']);
					$db->setData('password', bbcpwd($_REQUEST['item_password']));
					$db->setData('state', 2);
					$result=$db->insert('sysuser');
					if(!empty($result)){
						
						$obj='{
							      "statusCode":"200", 
							      "message":"创建用户完成！", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);						
					}else{
						$obj='{
							      "statusCode":"300", 
							      "message":"创建用户失败！", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
					}
				}
			}			
			if (@$_REQUEST['acttype'] == 1){
				$ob_sysUser=new db();
				$ob_sysUser->setData('userId',$_REQUEST['id']);
				$reactivity=$ob_sysUser->fetch('sysuser');
				$this->cout['sysUser']['userId']=$reactivity[0]['userId'];
				$this->cout['sysUser']['loginId']=$reactivity[0]['loginId'];
				$this->cout['sysUser']['userName']=$reactivity[0]['username'];
				$this->cout['sysUser']['password']=$reactivity[0]['password'];
				$this->cout['acttype'] = 1;
				//$this->cout['actinfo'] = "更改";
			}else{
				$this->cout['acttype'] = 0;
				//$this->cout['actinfo'] = "新增";
			}
			$this->display('admin.useradd.html');
		}
		
		public function usersinfo(){
			$db=new Db();
			$where='where 1';
			if (!empty($_REQUEST['loginId'])){
				$where.="and loginId like'%".$_REQUEST['loginId']."%'";
				
			}
													
			$index=empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum'];			
			$size=empty($_REQUEST['numPerPage'])?20:$_REQUEST['numPerPage'];
			$row_skip=($index-1)*$size;
			$row_limit=$size;

			$sql1="SELECT * FROM `sysuser` a left join sysUserGroup b on a.groupId =b.id ".$where."  limit {$row_skip} ,{$row_limit}";				
			$resultSet3=$db->execsql($sql1);				
			$sql2="SELECT * FROM `sysuser` a left join sysUserGroup b on a.groupId =b.id ".$where ;
			$totalCount=$db->fetchCount($sql2);
			$totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;			
			$this->cout['info']['result']=$resultSet3;
			$this->cout['info']['totalCount']=$totalCount;
			$this->cout['info']['totalPageCount']=$totalPageCount;
			$this->cout['info']['nowPage']=$index;
			$this->cout['info']['size']=$size;	
			
			$this->display('admin.users.html');
		}
		public function edituser(){			
			if (empty($_REQUEST['id'])) {
				$obj='{
				      "statusCode":"300", 
				      "message":"修改用户信息失败！", 
				      "navTabId":"adminusers", 
				      "rel":"", 
				      "callbackType":"",
				      "forwardUrl":""
					}
					';
				die($obj);
			}
			$ob_group=new db();
			$this->cout['group']=$ob_group->fetch('sysUserGroup');			
			$ob_sysUser=new db();
			$ob_sysUser->setData('userId',$_REQUEST['id']);
			$reactivity=$ob_sysUser->fetch('sysuser');							
			$this->cout['vinfo'] = $reactivity[0];
			if (empty($this->cout['vinfo']['loginId'])) {
				$obj='{
				      "statusCode":"300", 
				      "message":"修改用户信息失败！", 
				      "navTabId":"adminusers", 
				      "rel":"", 
				      "callbackType":"",
				      "forwardUrl":""
					}';
						die($obj);
			}
			$this->display('admin.edituser.html');
		}
		public function edituserpost()
		{
			if (empty($_REQUEST['userId'])) {
				$obj='{
							      "statusCode":"300", 
							      "message":"用户不存在！", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
			}
			$ob1= new db();
			if (!empty($_REQUEST['newpwd']))
			{
				if (strlen($_REQUEST['newpwd']) < 6)
				{
					$obj='{
							      "statusCode":"300", 
							      "message":"密码长度应大于六位长度", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
					
				}
				$password=@$_REQUEST['newpwd'];
				$ob1->setData('password', bbcpwd($password));
				
			}
			if (!empty($_REQUEST['username'])) {
				$userName=@$_REQUEST['username'];
				$state=@$_REQUEST['state'];
				$ob1->setData('username', $userName);
				$ob1->setData('state', $state);	
			}
			/*
			if (!empty($_REQUEST['groupid'])){
				$groupid=@$_REQUEST['groupid'];				
				$this->rankuserpost();
				$ob1->setData('groupid', $groupid);
				
			}elseif ($_REQUEST['group']){
				//$this->rankuserpost();
				if ($this->rankuserpost()) { $obj='{
							      "statusCode":"200", 
							      "message":"修改成功！", 
							      "navTabId":"user", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}';
						die($obj);	}			
			else{ 
				$obj='{
					      "statusCode":"300", 
					      "message":"未修改", 
					      "navTabId":"user", 
					      "rel":"", 
					      "callbackType":"",
					      "forwardUrl":""
						}';
					die($obj);
				}		
			}else{
				$this->rankuserpost();							
			}
			*/
			$ob1->setData('state', $_REQUEST['state']);
			$ret=$ob1->update('sysuser','userId',$_REQUEST['userId'] );				
			if ($ret){
				$obj='{
							      "statusCode":"200", 
							      "message":"修改成功！", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);	
			}else{
				$obj='{
							      "statusCode":"300", 
							      "message":"未修改", 
							      "navTabId":"adminusers", 
							      "rel":"", 
							      "callbackType":"",
							      "forwardUrl":""
					}';
				die($obj);
			}
			//header("location:b2wms.php?act=admin.edituser&id=".$_REQUEST['id']);
		}
		public function addnew()
		{
			if (empty($_REQUEST['login_name']) || empty($_REQUEST['full_name']) || empty($_REQUEST['login_pass']))
			{
				$this->cout['errormsg']="输入参数不全";
				$this->display('admin.users.html');
				die;
			}
			$ob = new ObjFilter(sysUser::_TableName, Condn::_AND);
	        $ob->add(sysUser::loginId,$_REQUEST['login_name'],Condn::_ET);
		    $isValid=(int)DBM::$defaultDBM->filterCount($ob);
			if ($isValid > 0)
			{
				$this->cout['errormsg']="用户名已经存在，请更换用户名";
				$this->display('admin.users.html');
				die;
			}						
			$ob1= new ObjFilter(sysUser::_TableName);
			$ob1->set(sysUser::userName, $_REQUEST['full_name']);
			$ob1->set(sysUser::loginId, $_REQUEST['login_name']);
			$ob1->set(sysUser::password, $_REQUEST['login_pass']);
			$ob1->set(sysUser::state, '2');
			$ret = DBM::$defaultDBM->insert($ob1->TableName, null , $ob1->getSets());		
			if (!$ret)
			{
				$this->cout['errormsg']="用户添加失败，请重新添加，或联系管理员!";
				$this->display('admin.users.html');
				die;
			}			
			header("location:b2wms.php?act=admin.users");
		}
		/*public function log(){
			$db=new db();
			$sql3="SELECT * FROM `sysuser`";
			$resultSet4=$db->execsql($sql3);						
			$this->cout['adminusers']=$resultSet4;
			$authinfo = $this->cout['manage_rank']['limit'];
			$i = 0;
			foreach ($authinfo as $k=>$v)
			{
				$k=str_replace('.','_',$k);
				$this->cout['authinfo'][$i]['code'] = $k;
				$this->cout['authinfo'][$i]['name'] = $v;						
				$rankArr = explode(",",$k);
				if (count($rankArr) > 1){
					foreach ($rankArr as $vstr){
						$this->cout['authinfoindex'][$vstr] = $v;
					}
				}else{
					$this->cout['authinfoindex'][$k] = $v;
				}
				$i++;
			}
			$this->display('admin.log.html');
		}*/
		public function loginfo()
		{
			$db=new db();
			$sql3="SELECT * FROM `sysuser`";
			$resultSet4=$db->execsql($sql3);
			$this->cout['adminusers']=$resultSet4;
			$where = "where 1 ";
			if(!empty($_REQUEST['userid'])){
				if($_REQUEST['userid']!='all'){
				$where.="and staff_id='".$_REQUEST['userid']."'";
				}
			}
				
			if(!empty($_REQUEST['type']))
			{
				if($_REQUEST['type']!='all'){
				$type=str_replace('.','_',$_REQUEST['type']);
				$typeArr = explode(",", $_REQUEST['type']);
				$typeArr = array_unique($typeArr);
				
				$type_str = implode("','", $typeArr);
				$where.="and code in('".$type_str."')";
				//T($condtion);				
				//$condtion .= " and type='$type'";
				}
			}
			if(!empty($_REQUEST['date1'])&&!empty($_REQUEST['date2'])){
				$this->cout['datepost1']=$_REQUEST['date1'];
				$this->cout['datepost2']=$_REQUEST['date2'];
				$where .= " and log_date >='".$_REQUEST['date1']."' and log_date <='".$_REQUEST['date2']."'";
			}	
			$orderby = 'order by log_date desc ';									
			$index=empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum'];
			$size=empty($_REQUEST['numPerPage'])?1000:$_REQUEST['numPerPage'];
			$row_skip=($index-1)*$size;
			$row_limit=$size;

			$sql1="SELECT * FROM `logoperate` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
			
			$resultSet3=$db->execsql($sql1);
			
			$sql2="SELECT * FROM `logoperate` ".$where ;					
			$totalCount=$db->fetchCount($sql2);
			
			$totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
				
			$this->cout['vlist']=$resultSet3;	
			foreach ($this->cout['adminusers'] as $v)
			{
				$this->cout['adminuserindex'][$v['userId']] = $v['username'];
			}
			$authinfo = $this->cout['manage_rank']['limit'];
			$i = 0;
			foreach ($authinfo as $k=>$v)
			{
				$k=str_replace('.','_',$k);
				$this->cout['authinfo'][$i]['code'] = $k;
				$this->cout['authinfo'][$i]['name'] = $v;						
				$rankArr = explode(",",$k);
				if (count($rankArr) > 1){
					foreach ($rankArr as $vstr){
						$this->cout['authinfoindex'][$vstr] = $v;
					}
				}else{
					$this->cout['authinfoindex'][$k] = $v;
				}
				$i++;
			}
			$this->cout['authinfoindex'] = array_unique($this->cout['authinfoindex']); 		
			$this->cout['info']['totalCount']=$totalCount;
			$this->cout['info']['totalPageCount']=$totalPageCount;
			$this->cout['info']['nowPage']=$index;
			$this->cout['info']['size']=$size;
			$this->display('admin.log.html');
			
			//var_dump($this->cout['sql']);
			//var_dump($this->cout['cleftpage']);
			//var_dump($this->cout['vlist']);
		
		}
		public function changepwdasubmit(){
			$this->cout['vinfo']['uid'] = $_SESSION[SCRIPT_NAME.'_login']['login_id'];
			$this->cout['vinfo']['uname'] = $_SESSION[SCRIPT_NAME.'_login']['login_name'];
			if (!empty($_REQUEST))
			{
				if (empty($_REQUEST['old_pwd']) || empty($_REQUEST['new_pwd']) || empty($_REQUEST['re_new_pwd'])){ 
					$obj='{
							      "statusCode":"300", 
							      "message":"输入信息不全", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);					
				}
				if (strlen($_REQUEST['new_pwd']) < 6){ 
					$obj='{
							      "statusCode":"300", 
							      "message":"密码长度应大于六位长度", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);					
				}
				if ($_REQUEST['new_pwd'] != $_REQUEST['re_new_pwd']){ 
					$obj='{
							      "statusCode":"300", 
							      "message":"两次输入的密码必须一致", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);						
				}
				
			    $db=new DB();
			    $db->setData('password',bbcpwd($_REQUEST['old_pwd']));
				$db->setData('userId', $this->cout['vinfo']['uid']);
				$isValid = $db->fetch('sysuser');
				if (count($isValid) > 0)
				{
					$ob_sysUser=new db();
					$ob_sysUser->setData('password', bbcpwd($_REQUEST['new_pwd']));
					$result=$ob_sysUser->update('sysuser','userId',$this->cout['vinfo']['uid']);
					if($result){
						$obj='{
							      "statusCode":"200", 
							      "message":"操作成功", 
							      "navTabId":"", 
							      "rel":"user", 
							      "callbackType":"closeCurrent",
							      "forwardUrl":""
							}
							';
						die($obj);
					}
				} else {
					$obj='{
							      "statusCode":"300", 
							      "message":"密码修改失败", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);
				}
			}

		}
		public function changepwda()
		{
			$this->cout['vinfo']['uid'] = $_SESSION[SCRIPT_NAME.'_login']['login_id'];
			$this->cout['vinfo']['uname'] = $_SESSION[SCRIPT_NAME.'_login']['login_name'];
			$this->display('admin.changepwd1.html');
		}
		/**
		 * 
		 * 获得分组列表
		 */
		public function getGroup(){
			if (!empty($_REQUEST['gid'])){
				$group=new db();
				$group->setData('id', $_REQUEST['gid']);
				$ret=$group->fetch('sysUserGroup');
				$codearr=json_decode($ret[0]['code']);
				foreach ($codearr as $key=>$v){
					$code=str_replace('.', '-', $v);
					$code=str_replace(',', '_', $code);
					$codearr[$key]=$code;
				}
				die(json_encode($codearr));
			}else{
				return false;
			}
		}
	
		public function rankuser(){
			if ($_SESSION[SCRIPT_NAME.'_login']['login_name'] != 'admin'){
			$obj='{
							      "statusCode":"300", 
							      "message":"该功能只能超级管理员进入！", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
				die($obj);
			}
			if (empty($_REQUEST['id'])) {
				$obj='{
							      "statusCode":"300", 
							      "message":"缺少必须的参数！", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
				die($obj);								
			}
			$ob_group=new db();
			$this->cout['group']=$ob_group->fetch('sysUserGroup');
			$ob = new db();					  
			$ob->setData('userId',$_REQUEST['id']);			
			$resultSet=$ob->fetch('sysuser');			
			$this->cout['vinfo'] = $resultSet[0];				
			if (!empty($this->cout['vinfo']['loginId'])) {
			$ob_staff=new db();
			$ob_staff->setData('staff_id', $_REQUEST['id']);			
			$auth_info=$ob_staff->fetch('staff_auth');
			$this->cout['vinfo']['rank'] = @$auth_info[0]['code'];
			$menuInfo=$this->cout['manage_rank']['limit'];
			foreach ($menuInfo as $key=>$value){
				$code=str_replace('.', '-', $key);
				$code=str_replace(',', '_', $code);
				unset($this->cout['manage_rank']['limit'][$key]);
				$this->cout['manage_rank']['limit'][$key]['name']=$value;
				$this->cout['manage_rank']['limit'][$key]['code']=$code;
			}
			}else{
				$obj='{
							      "statusCode":"300", 
							      "message":"用户不存在！", 
							      "navTabId":"", 
							      "callbackType":"",
							      "forwardUrl":""
							}
							';
						die($obj);		
			}
								
			$this->display('admin.rankuser.html');
		}
		public function rankuserpost(){
			if ($_SESSION[SCRIPT_NAME.'_login']['login_name'] != 'admin') {
				$obj='{
							      "statusCode":"300", 
							      "message":"该功能只能超级管理员进入！", 
							      "navTabId":"adminusers", 
							      "callbackType":"",
							      "forwardUrl":""
							}';
				die($obj);
			}			
			if (empty($_REQUEST['userId'])) {
				$obj='{
							      "statusCode":"300", 
							      "message":"用户不存在！", 
							      "navTabId":"adminusers", 
							      "callbackType":"",
							      "forwardUrl":""
							}';
				die($obj);
			}
			$ob_staff=new db();
			$sql = "SELECT * FROM staff_auth where staff_id={$_REQUEST['userId']} ";
			$bbb = $ob_staff->fetchCount($sql);			
			$extend_info = array();
			if ($bbb > 0){
				if (!empty($_REQUEST['groupid'])){
					$db_group= new db();
					$db_group->setData('id',$_REQUEST['groupid']);
					$resultSet3=$db_group->fetch('sysUserGroup');							
					$extend_info['code'] =$resultSet3[0]['code'];
					
				}elseif($_REQUEST['group']){
					$db_group= new db();					
					$db_group->setData('id',$_REQUEST['group']);
					$resultSet3=$db_group->fetch('sysUserGroup');					
					$extend_info['code'] =$resultSet3[0]['code'];
					$ob_user=new db();					
					$sql1="update sysuser set groupId='".$_REQUEST['group']."' where userId='".$_REQUEST['userId']."'";
					$ob_user->execsql($sql1);										
				}else{
					$ob_user=new db();										
					$sql1="update sysuser set groupId=0 where userId='".$_REQUEST['userId']."'";
					$ob_user->execsql($sql1);
																		
					$extend_info['code'] = json_encode($_REQUEST['rank']);
				}
						
				$extend_info['staff_name'] = $_SESSION[SCRIPT_NAME.'_login']['login_name'];					
				$sql2="update `staff_auth` set staff_name='".$extend_info['staff_name']."',code='".$extend_info['code']."' where staff_id='".$_REQUEST['userId']."'";
				$ret=$ob_staff->execsql($sql2);
				
			}else{
				$ob_staff=new db();				
				$extend_info['staff_id'] = $_REQUEST['userId'];
				if (!empty($_REQUEST['groupid'])){
					$db_group= new db();
					$db_group->setData('id',$_REQUEST['groupid']);
					$resultSet3=$db_group->fetch('sysUserGroup');					
					$extend_info['code'] =$resultSet3[0]['code'];
				}elseif ($_REQUEST['group']){
					$db_group= new db();					
					$db_group->setData('id',$_REQUEST['group']);
					$resultSet3=$db_group->fetch('sysUserGroup');					
					$extend_info['code'] =$resultSet3[0]['code'];
					$ob_user=new db();
					$sql1="update sysuser set groupId='".$_REQUEST['group']."' where userId='".$_REQUEST['userId']."'";
					$ob_user->execsql($sql1);	
					
				}else{
					$ob_user=new db();					
					$sql1="update sysuser set groupId=0 where userId='".$_REQUEST['userId']."'";
					$ob_user->execsql($sql1);	
					$extend_info['code'] = json_encode($_REQUEST['rank']);
				}
				$ob_staff->setData('staff_id', $extend_info['staff_id']);
				$extend_info['staff_name'] = $_SESSION[SCRIPT_NAME.'_login']['login_name'];
				$ob_staff->setData('staff_name', $extend_info['staff_name']);
				$ret=$ob_staff->insert('staff_auth');
			}
			if ($ret){
                $obj='{
                            "statusCode":"200", 
                            "message":"'.$this->cout['ajaxmsg']['200'].'", 
                            "navTabId":"adminusers", 
                            "rel":"", 
                            "callbackType":"closeCurrent",
                            "forwardUrl":""
                      }';
                die($obj);
			}else{
		        $obj='{
                            "statusCode":"300", 
                            "message":"'.$this->cout['ajaxmsg']['300'].'",
                            "navTabId":"adminusers", 
                            "rel":"", 
                            "callbackType":"",
                            "forwardUrl":""
                      }';
                 die($obj);
			}
		}
		/**
		 * 管理员管理程序
		 * Enter description here ...
		 */
		public function shellOption(){
			$dir=DATA_PATH;
			$cmd1='ls -al '.$dir;
			$result1=array();
			@exec($cmd1,$result1);
			$this->cout['file']=$result1;
			$this->cout['dir']=$dir;
			$cmd2='ps aux|grep sensitivewordserver';
			$result2=array();
			@exec($cmd2,$result2);
			$this->cout['cmd2']=$cmd2;
			$this->cout['sensitivewordserver']=$result2;
			$cmd3='ps aux|grep Sen';
			$result3=array();
			$this->cout['cmd3']=$cmd3;
			@exec($cmd3,$result3);
			$this->cout['Sen']=$result2;
			$dirst=$dir.'static_table/';
			$this->cout['dirst']=$dirst;
			$cmd4='ls -al'.$dirst;
			$result4=array();
			@exec($cmd4,$result4);
			if (!empty($result4)){
				foreach ($result4 as $k=>$v){
					$filearr=array();
					$filearr=explode(' ', $v);
					$filename=end($filearr);
					if ($filename!='.' && $filename!='..' && !intval($filename)){
						$result1[$k]=array();
						$result1[$k]['result']=$v;
						$result1[$k]['file']=$filename;
					}else{
						array_splice($result4,$k);
					}
				}	
			}
			$this->cout['static_table']=$result4;
			$this->display('admin.shell.html');
		}
		
		public function delDir(){
			$file=@$_REQUEST['file'];
			$dir=DATA_PATH.'static_table/';
			$ss=$this->rmfile($file,$dir);
			if ($ss===false){
				die(json_encode(false));
			}else{
				die(json_encode(TRUE));
			}
		}
		/**
		 * 删除文件
		 * Enter description here ...
		 * @param unknown_type $dir
		 * @param unknown_type $name
		 */
		private function rmfile($name,$dir=DATA_PATH){
			if (empty($name)){
				return false;
			}
			if (is_dir($dir) && $dir!='.' && $dir!='..'){
				$file=$dir.$name;
				if (is_file($file)){
					@chmod($file, 0777);
					@unlink($file);
				}elseif (is_dir($file)){
					@chmod($file, 0777);
					@exec('rm '.$dir);
				}else {
					return FALSE;
				}
			}else{
				return false;
			}
		}
		
		
		public function __destruct()
		{
			parent::__destruct();
		}
	}
}	
/*
 *
			$query =<<<QRY
CREATE TABLE org_category ( 
    category_id INT( 11 )       PRIMARY KEY,
    name        VARCHAR( 200 )  NOT NULL,
    lft         INT( 11 )       NOT NULL,
    rgt         INT( 11 )       NOT NULL,
    orderby     INT( 11 )       NOT NULL
                                DEFAULT '0' 
);
QRY;
			
			$this->mydb->Execute($query);
									
 *require_once(VENDORS_PATH . 'SPSQLite.class.php');
			$sqlite = new SPSQLite(DATA_PATH . 'test.db');
$query =<<<QRY
CREATE TABLE test(
    id INTEGER PRIMARY KEY,
    name VARCHAR(25),
    quantity INTEGER,
    price NUMERIC(5,2)
);
QRY;
$sqlite->query($query);			
		$queries = array(
            "INSERT INTO test (name, quantity, price) VALUES('toro', 10, 500.00);",
            "INSERT INTO test (name, quantity, price) VALUES('gallo', 5, 200.00);",
            "INSERT INTO test (name, quantity, price) VALUES('rana', 20, 100.00);",
            "INSERT INTO test (name, quantity, price) VALUES('cane', 3, 500.00);"
            );

foreach($queries as $query){
    $sqlite->query($query);
}
$sqlite->close();
			T($sqlite,true);
 */	
?>
