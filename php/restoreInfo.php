<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$type = $_POST['type'];
$id = $_POST['id'];
if($type==1){
	$sql = "update course set state=0,delete_time=null where course_id='$id'";
}else if($type==2 || $type==3){
	$sql = "update user set state=0,delete_time=null where user_id='$id'";
}else{
	$sql = "update article set state=0,delete_time=null where id='$id'";
}
$res = insert_datas($sql);
$array = array('success' => $res);
echo json_encode($array);
?>