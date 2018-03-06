<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$courseId = $_POST['courseId'];
$list = getThisCatalogueList($courseId);
if($list){
	$arr = array('success'=>true,'list'=>json_decode($list));
}else{
	$arr = array('success'=>false,'list'=>json_decode($list));
}
echo json_encode($arr);
?>
