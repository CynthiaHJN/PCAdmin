<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$id = $_POST['id'];
$data =  json_decode(getMessageInfo($id));
$res  = array('success' => true, 'data' => $data);
echo json_encode($res);
?>
