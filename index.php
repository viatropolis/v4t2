<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */
 
// bot security
#$SFS = unserialize( file_get_contents("http://www.stopforumspam.com/api?ip=".$_SERVER['REMOTE_ADDRESS']."&f=serial") );
#if($SFS['success']==1 && $SFS['ip']['appears'] > 0) header("Location: http://error.drachennetz.com/?403");

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
