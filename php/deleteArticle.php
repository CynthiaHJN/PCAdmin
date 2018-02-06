<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$id = $_POST['id'];
$flag = deleteArticle($id);
if($flag){
	$arr = array('success'=>true);
}else{
	$arr = array('success'=>false);
}
echo json_encode($arr);
?>
