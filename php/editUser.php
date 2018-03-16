<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$type = $_POST['type'];
$id = $_POST['id'];
$name =  $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];
if($type==0){
	$userInfo = array('id'=>$id,'name' => $name,'sex'=>$sex,'age'=>$age);
}else if($type==1){
	$rank = $_POST['rank'];
	$direction = $_POST['direction'];
	$userInfo = array('id'=>$id,'name' => $name,'sex'=>$sex,'age'=>$age,'teacher_rank'=>$rank,'teach_direction'=>$direction);
}else if($type==2){
	$shortIntro = $_POST['shortIntro'];
	$userInfo = array('id'=>$id,'name' => $name,'sex'=>$sex,'age'=>$age,'short_intro'=>$shortIntro);
}else if($type==3){
	$rank = $_POST['rank'];
	$direction = $_POST['direction'];
    $shortIntro = $_POST['shortIntro'];
    $userInfo = array('id'=>$id,'name' => $name,'sex'=>$sex,'age'=>$age,'teacher_rank'=>$rank,'teach_direction'=>$direction,'short_intro'=>$shortIntro);
}
$res = editUserInfo($userInfo);
if($res==1){
	$data = array('success' => true);
	echo json_encode($data);
}else{
	$data = array('success' => false);
	echo json_encode($data);
}
?>