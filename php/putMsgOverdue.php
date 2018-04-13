<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$msgId = $_POST['msgId'];
$res = putMsgOverdue($msgId);
$array = array('success'=>$res);
echo json_encode($array);
?>
