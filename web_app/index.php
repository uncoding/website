<?PHP
define('SCRIPT_NAME', 'home');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__).DS.'..'.DS).DS);
require(ROOT_PATH.'include'.DS.'global.php');
action();
?>