<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$type = $_POST['type'];
if($type==1){
	$sql = "select * from course where state=2 order by delete_time desc";
}else if($type==2){
	$sql = "select * from user where user_type=1 and state=2 order by delete_time desc";
}else if($type==3){
	$sql = "select * from user where user_type=0 and state=2 order by delete_time desc";
}else{
	$sql = "select * from article where state=2 order by delete_time desc";
}
$res = getRubbishList($sql);
$array = array('success' => true, 'list'=>$res);
echo json_encode($array);
?>