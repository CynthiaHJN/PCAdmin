<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$teacherName = $_POST['teacherName'];
$rank = $_POST['rank'];
$direction = $_POST['direction'];
$mobile = $_POST['mobile'];
$idCard = $_POST['idCard'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$arr = array('teacherName' => $teacherName, 'rank' => $rank, 'direction' => $direction, 'mobile' => $mobile, 'idCard' => $idCard, 'sex' => $sex, 'age' => $age);

$flag = exit_user($mobile);
if($flag){
	$data = array('success'=>false,'errorMsg'=>'该手机号已被注册');
	echo json_encode($data);
}else{
	$res = addOneTeacher($arr);
	$data = array('success'=>$res);
	echo json_encode($data);
}
?>