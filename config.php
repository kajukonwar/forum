<?php
session_start();
error_reporting(E_ALL);
//define global absolute path constant
define('ROOT_DIR',__DIR__);
//global configurations
$GLOBALS['_forum_config']=array(
	'mysql'=>array(
				'host'=>'127.0.0.1',
				'username'=>'root',
				'password'=>'',
				'db'=>'forum'
			),
	'remember'=>array(
				'cookie_name'=>'hash',
				'cookie_expiry'=>604800
			),
	'session'=>array(

				'session_name'=>'user'
			)
	);
//END-global configurations

spl_autoload_register(function($class){

	require_once ROOT_DIR.'/classes/'.$class.'.php';

});

require_once(ROOT_DIR.'/functions/sanitize.php');
