<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
// $userId = $_POST['userId'];
// $teacherId = $_POST['teacherId'];
// $reason = $_POST['reason'];
// $title = $_POST['title'];
$orderId = $_POST['orderId'];
$userId = $_POST['userId'];
$teacherId = $_POST['teacherId'];
$messageCnt = $_POST['messageCnt'];
$res = submitLeave($orderId);
if($res){
	$res = sendMessage($userId,$teacherId,$messageCnt,'课程请假消息',1);
    $datas = array('success'=>'true');
}else{
    $datas = array('success'=>'false');
}
echo json_encode($datas);
?>