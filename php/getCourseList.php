<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$limit = $_POST['limit'];
$page = $_POST['page'];
$data =  json_decode(getCourseList($limit,$page));
$res  = array('success' => true, 'data' => $data);
echo json_encode($res);
?>
