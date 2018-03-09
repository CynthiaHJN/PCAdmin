<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$catalogueId = $_POST['catalogueId'];
$data = useCatalogueToCourseInfo($catalogueId);
if($data){
	$arr = array('success'=>true,'data'=>json_decode($data));
}else{
	$arr = array('success'=>false,'data'=>json_decode($data));
}
echo json_encode($arr);
?>
