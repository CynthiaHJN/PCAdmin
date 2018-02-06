<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$type = 0;
$id = 1;
$name =  '王五';
$sex = 1;
$age = 12;
if($type==0){
	$userInfo = array('id'=>$id,'name' => $name,'sex'=>$sex,'age'=>$age,'type'=>$type);
}
editUser($userInfo);
?>