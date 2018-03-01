<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$receiveId = $_POST['receiveId'];
$state = $_POST['state'];
$data =  json_decode(getMessageList($receiveId,$state));
$res  = array('success' => true, 'data' => $data);
echo json_encode($res);
?>
