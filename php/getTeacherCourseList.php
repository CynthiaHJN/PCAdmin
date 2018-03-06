<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['userId'];
$type = $_POST['type'];
$res = getTeacherCourseList($userId,$type);
if($res){
	$arr = array('success'=>true,'list'=>json_decode($res));
}else{
	$arr = array('success'=>false,'list'=>json_decode($res));
}
echo json_encode($arr);
?>