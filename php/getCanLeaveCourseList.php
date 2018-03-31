<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['userId'];
// $userId = 7;
$res = getCanLeaveCourseList($userId);
if($res){
	echo json_encode(array('success'=>true,'data'=>$res));
}else{
	echo json_encode(array('success'=>false));
}
?>