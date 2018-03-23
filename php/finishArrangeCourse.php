<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$orderId = $_POST['orderId'];
$teacherId = $_POST['teacherId'];
$studentId = $_POST['studentId'];
$messageCnt = $_POST['messageCnt'];
$res = finishArrangeCourse($orderId);
if($res){
	$res = sendMessage($teacherId,$studentId,$messageCnt,'取消上课通知',3);
	$arr = array('success' => true);
}else{
	$arr = array('success' => false);
}
echo json_encode($arr);
?>
