<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$courseType = $_POST['courseType'];
// $courseType = '钢琴';
$res = getSomeTeacher($courseType);
if($res){
	$array = array('success'=>true,'list'=>json_decode($res));
}else{
	$array = array('success'=>false);
}

echo json_encode($array);
?>