<?PHP
session_start();

/* 打开报错，设定报错等级 */
ini_set("display_errors",'on');
/*定义时区 */
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);

/* 无缓存 */
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/* Set client cache */
// header("Cache-control: private");

// 要求定义好 _PATH_ 和 SCRIPT_NAME ，及定义 DS 为路径分隔符
if (!defined('ROOT_PATH'))		{ die("Error : (".realpath(__FILE__).") not defined 'ROOT_PATH' "); }
if (!defined('SCRIPT_NAME'))	{ die("Error : (".realpath(__FILE__).") not defined 'SCRIPT_NAME' "); }
if (!defined('DS'))				{ die("Error : (".realpath(__FILE__).") not defined 'DS' "); }

/* [pathSeparator]window的include用;隔开，linux用:隔开 */
// if (!defined('_PTSP_')){define('_PTSP_',preg_match("/WIN/i",PHP_OS) ? ";" : ":");}

/* Set the include path. */
define("INCLUDE_PATH", ROOT_PATH.'include'.DS);
define("VENDORS_PATH", ROOT_PATH.'vendors'.DS);
define("MODELS_PATH", ROOT_PATH.'models'.DS);
define("CONTROLLERS_PATH", ROOT_PATH.'controllers'.DS);
define("DATA_PATH", ROOT_PATH.'data'.DS);
define("API_PATH", ROOT_PATH.'apitest'.DS);
define("UPLOAD_PATH", ROOT_PATH.'web_app'.DS.'html'.DS.'upload');//define("UPLOAD_PATH", ROOT_PATH.'web_app'.DS.'upload');
define("WEB_PATH", ROOT_PATH.'web_app'.DS);
define("PAGE_PATH", ROOT_PATH.'web_app'.DS.'page'.DS);
define("PWDPRE", 'DWE&$x23@!ex');
/* Include "include.php" File */
require(INCLUDE_PATH . 'include.php');

$_REQUEST = array_merge($_GET, $_POST);
if (!get_magic_quotes_gpc())
{
	foreach ($_REQUEST as $_key => $_value)
	{
		if (!is_array($_value)) $_REQUEST[$_key] = addslashes($_value);
		$before_val=$_REQUEST[$_key];
		$val=RemoveXSS($before_val);
		if($before_val!=$val && $_SERVER['SCRIPT_NAME']!='/b2wms.php'){
			diemsg();
		}
	}
}

/* Include Smarty File */
require (VENDORS_PATH . 'smarty'.DS.'Smarty.class.php');
$tpl = new Smarty;
$tpl->left_delimiter	=	TPL_LEFT_DELIMITER;
$tpl->right_delimiter	=	TPL_RIGHT_DELIMITER;
$tpl->caching			=	TPL_CACHING;
$tpl->cache_dir			=	TPL_CACHE;
$tpl->template_dir		=	TPL_TEMPLATE;
$tpl->compile_dir		=	TPL_COMPILE;
$tpl->compile_check		=	true;
$tpl->register_function("return_array_value", "return_array_value");
$tpl->register_function("return_array_checked", "return_array_checked");
$tpl->register_function("return_selected", "return_selected");
$tpl->register_function("return_msubstr", "return_msubstr");
$tpl->register_function("return_dmypath", "return_dmypath");
$tpl->register_function("return_checked", "return_checked");

/* Include Adodb File */
//require (VENDORS_PATH . 'adodb5'.DS.'adodb.inc.php');
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
/* Connect MySQL 连接完数据库后,清空数据库连接信息,安全,记得要安全 */
/*
$mydb = &NewADOConnection('mysql');
if (defined(MYDB_SOCK))
	$mydb->Connect(MYDB_HOST.':'.MYDB_PORT.':'.MYDB_SOCK, MYDB_USER, MYDB_PASS, MYDB_LIBR) or die($mydb->ErrorMsg());
else
	$mydb->Connect(MYDB_HOST.':'.MYDB_PORT, MYDB_USER, MYDB_PASS, MYDB_LIBR) or die($mydb->ErrorMsg());
$mydb->Execute('SET NAMES "utf8";');
*/

?>
