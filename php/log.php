<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$mobile = $_POST["username"];
$password = $_POST["password"];
$type = $_POST["type"];
if($type==0){
	$flag = exit_user($mobile);
	if($flag){
		$password = md5($password);
		$res = user_login($mobile,$password,2);
		if($res){
			$data = array('success'=>$res);
			echo json_encode($data);
		}else{
			$data = array('success'=>false,'errorMsg'=>'输入的密码不正确');
			echo json_encode($data);
		}
	}else{
		$data = array('success'=>false,'errorMsg'=>'该手机号尚未注册');
		echo json_encode($data);
	}
}else{
	$flag = exit_user($mobile);
	if($flag){
		$data = array('success'=>false,'errorMsg'=>'该手机号已被注册');
		echo json_encode($data);
	}else{
		$res = user_register($mobile,$password,2);
		$data = array('success'=>$res);
		echo json_encode($data);
	}
}
?>