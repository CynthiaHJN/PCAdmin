<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['userId'];
$teacherId = $_POST['teacherId'];
$reason = $_POST['reason'];
$title = $_POST['title'];
$res = submitLeave($userId,$teacherId,$reason,$title);
if($res){
    $datas = array('success'=>'true');
}else{
    $datas = array('success'=>'false');
}
echo json_encode($datas);
?>