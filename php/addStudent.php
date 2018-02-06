<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$arr = array('name' => $name, 'mobile' => $mobile, 'sex' => $sex, 'age' => $age);
$flag = exit_user($mobile);
if($flag){
	$data = array('success'=>false,'errorMsg'=>'该学生已存在');
	echo json_encode($data);
}else{
	$res = addOneStudent($arr);
	$data = array('success'=>$res);
	echo json_encode($data);
}
?>