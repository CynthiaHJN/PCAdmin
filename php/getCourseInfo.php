<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$id = $_POST['id'];
$res = getCourseInfo($id);
$arr = array('success'=>true,'data'=>json_decode($res));
echo json_encode($arr);
?>
