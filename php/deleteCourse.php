<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$courseId = $_POST['courseId'];
$flag = deleteCourse($courseId);
if($flag){
	$arr = array('success'=>true);
}else{
	$arr = array('success'=>false);
}
echo json_encode($arr);
?>
