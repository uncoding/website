<?php
/* 包含一些常量或变量的定义 */
require (INCLUDE_PATH . 'config.cout.php');
require (INCLUDE_PATH . 'config.user.php');
/* 包含数据库环境配置 */
require (INCLUDE_PATH . 'config.db.php');

/* 包含模板环境配置 */
require (INCLUDE_PATH . 'config.tpl.php');

/* 包含模板环境配置 */
require (INCLUDE_PATH . 'functions.php');
require (INCLUDE_PATH . 'user.functions.php');
/* 包含基本控制类 */
require (CONTROLLERS_PATH . 'controllers.php');

/* 包含基本模型类 */
require (MODELS_PATH . 'models.php');

?>