<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['user_id'];
$state = $_POST['state'];
$res = getUserCourse($userId,$state);
if($res){
    $datas = array('success'=>'true','list'=>$res);
}else{
    $datas = array('success'=>'false');
}
echo json_encode($datas);
?>