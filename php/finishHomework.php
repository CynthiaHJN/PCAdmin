<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$homeworkId = $_POST['homeworkId'];
$res = finishHomework($homeworkId);
if($res){
	$arr = array('success'=>true);
}else{
	$arr = array('success'=>false);
}
echo json_encode($arr);
?>
