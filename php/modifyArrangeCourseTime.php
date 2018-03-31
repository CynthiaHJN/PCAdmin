<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$orderId = $_POST['orderId'];
$datetime = $_POST['datetime'];
$teacherId = $_POST['teacherId'];
$studentId = $_POST['studentId'];
$messageCnt = $_POST['messageCnt'];
$res = modifyArrangeCourseTime($orderId,$datetime);
if($res){
	$res = sendMessage($teacherId,$studentId,$messageCnt,'修改上课时间通知',4);
	$arr = array('success' => true);
}else{
	$arr = array('success' => false);
}
echo json_encode($arr);
?>
