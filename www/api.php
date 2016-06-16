<?php

$path=dirname(__FILE__);
$array=  explode(DIRECTORY_SEPARATOR , $path);
array_pop($array);
$str=  implode(DIRECTORY_SEPARATOR ,$array );
define("ROOT_ADDR", $str);
$_REQUEST['type']=$argv[1];
require_once ROOT_ADDR.'/shell/modules/api/account_record.php';
