<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['userId'];
$type = $_POST['type'];
$state = $_POST['state'];
$data =  json_decode(getHomeworkList($userId,$type,$state));
$res  = array('success' => true, 'data' => $data);
echo json_encode($res);
?>
