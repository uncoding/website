<?PHP
/* 模板的相对路径 */
define('TPL_TEMPLATE', ROOT_PATH.'templates'.DS.'html'.DS.SCRIPT_NAME);

/* 编译的相对路径 */
define('TPL_COMPILE', ROOT_PATH.'templates'.DS.'compile'.DS.SCRIPT_NAME);

/* 缓冲的相对路径 */
define('TPL_CACHE', ROOT_PATH.'templates'.DS.'cache'.DS.SCRIPT_NAME);

/* 是否打开缓冲 */
define('TPL_CACHING',false);

/* 编译的时候 Check 否 */
define('TPL_COMPILE_CHECK',true);

/* 模板开始的左标记 */
define('TPL_LEFT_DELIMITER','{');

/* 模板开始的右标记 */
define('TPL_RIGHT_DELIMITER','}');

function return_dmypath($params) //{{{
{
	extract($params);
	return substr($date_str, 8, 2).'/'.substr($date_str, 5, 2).'/'.substr($date_str, 0, 4).'/';
}
?>