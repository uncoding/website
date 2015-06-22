<?PHP
/* 定义$cout 和 初始话的时间值 */
$cout = array();

$cout['date']['today'] = array();
$cout['date']['today']['mktm'] = time();
$cout['date']['today']['eymd'] = date("Y-m-d H:i:s",$cout['date']['today']['mktm']);
$cout['date']['today']['aymd'] = date("Y-m-d",$cout['date']['today']['mktm']);
$cout['date']['today']['cymd'] = date("Y年m月d日",$cout['date']['today']['mktm']);

$cout['date']['yesterday'] = array();
$cout['date']['yesterday']['mktm'] = $cout['date']['today']['mktm']-86400;
$cout['date']['yesterday']['eymd'] = date("Y-m-d H:i:s",$cout['date']['yesterday']['mktm']);
$cout['date']['yesterday']['aymd'] = date("Y-m-d",$cout['date']['yesterday']['mktm']);
$cout['date']['yesterday']['cymd'] = date("Y年m月d日",$cout['date']['yesterday']['mktm']);

$cout['date']['tomorrow']=array();
$cout['date']['tomorrow']['mktm'] = $cout['date']['today']['mktm']+86400;
$cout['date']['tomorrow']['eymd'] = date("Y-m-d H:i:s",$cout['date']['tomorrow']['mktm']);
$cout['date']['tomorrow']['aymd'] = date("Y-m-d",$cout['date']['tomorrow']['mktm']);
$cout['date']['tomorrow']['cymd'] = date("Y年m月d日",$cout['date']['tomorrow']['mktm']);

$cout['date']['sevenday']=array();
$cout['date']['sevenday']['mktm'] = $cout['date']['today']['mktm']-86400*7;
$cout['date']['sevenday']['eymd'] = date("Y-m-d H:i:s",$cout['date']['sevenday']['mktm']);
$cout['date']['sevenday']['aymd'] = date("Y-m-d",$cout['date']['sevenday']['mktm']);
$cout['date']['sevenday']['cymd'] = date("Y年m月d日",$cout['date']['sevenday']['mktm']);

$cout['status'] = array('1'=>'通过', '2'=>'未审');

$cout['mgr_status']=array(
'1'=>'启用',
'0'=>'禁用',
);
$cout['ajaxmsg']= array(
'200'=>'完成！请刷新',
'201'=>'成功删除该记录',
'300'=>'如下情况造成更新失败！或者数据未更改请修改数据后再提交',
'301'=>'没有生成该记录，或者缺少必须的参数！',
'302'=>'没有用户名或密码！',
'303'=>'没有备案号不能完成备案！',
'304'=>'没有备案人手机不能开始备案！',
);
$cout['manage_rank'] = array();
$cout['manage_rank']['unlimit'] = array(
	'manage.nologin'=>'未登录',
	'manage.dologin'=>'登录中',
	'manage.welcome'=>'欢迎页',
	'manage.iframe'=>'框架页',
	'admin.changepwd'=>'修改密码',
	'index.ajaxData'=>'取分服列表',
	'manage.createtreejs'=>'JS',
	'manage.iframeget'=>'框架页2',
	'manage.iframeurl'=>'框架页3',
	'manage.help'=>'帮助页',
	'manage.iframeset'=>'框架页重定向方法',
	'search.get'=>'搜索html5'
	);
$cout['manage_rank']['limit'] = array(

'seoglobalmgr.seoglobal,seoglobalmgr.seoglobaladd,seoglobalmgr.seoglobaldel'=>'SEO全局变量配置',
'seomgr.seo,seomgr.seoadd,seomgr.seodel,seomgr.seohtml,seomgr.seoautoall'=>'SEO静态处理',
'tablemgr.table,tablemgr.tableadd,tablemgr.tabledel'=>'分类对应表管理',
'classifymgr.classify,classifymgr.classifyadd,classifymgr.classifydel'=>'分类管理',
'navmgr.nav,navmgr.navadd,navmgr.navdel'=>'导航条管理',
'navmgr.navreback,navmgr.navaddback'=>'导航回收站',
'skinmgr.skin,skinmgr.skinadd,skinmgr.skindel'=>'皮肤管理',
'admin.users,admin.usersinfo,admin.usersadd,admin.edituser,admin.edituserpost,admin.rankuser,admin.rankuserpost'=>'系统用户管理',
'admin.log,admin.loginfo'=>'用户操作记录管理',
'admin.sysmenu,admin.sysmenuadd,admin.sysmenudel'=>'系统菜单管理',
'admin.group,admin.groupadd,admin.groupdel'=>'用户分组管理',
'admin.changepwda'=>'修改密码',
'manage.nologin,manage.main'=>'退出登录',

);
//允许访问后台的IP列表
$cout['allow_ip'] = array(
        '127.0.0.1'
 
);
?>
