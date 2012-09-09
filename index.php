<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';

define('YII_ENABLE_ERROR_HANDLER', true);
define('YII_ENABLE_EXCEPTION_HANDLER', true);

$local = array('localhost');
if (in_array($_SERVER['HTTP_HOST'], $local)) {
	define('YII_DEBUG', true);
	$config = dirname(__FILE__).'/protected/config/dev.php';
}
else {
	define('YII_DEBUG', false);
	$config = dirname(__FILE__).'/protected/config/main.php';
}

require_once($yii);
Yii::createWebApplication($config)->run();