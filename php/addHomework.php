<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$catalogueId = $_POST['catalogueId'];
$courseId = $_POST['courseId'];
$content = $_POST['content'];
$teacherId = $_POST['teacherId'];
$res = addHomework($catalogueId,$courseId,$content,$teacherId);
if($res){
	$arr = array('success' => true);
}else{
	$arr = array('success' => false);
}
echo json_encode($arr);
?>