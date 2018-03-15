<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$mobile = $_POST['mobile'];
$oldPwd = $_POST['oldPwd'];
$newPwd = $_POST['newPwd'];
$res = editPassword($mobile,$oldPwd,$newPwd);
if($res==1){
	$arr = array('success'=>true);
}else if($res==-1){
	$arr = array('success'=>false,'errorMsg'=>'旧密码输入有误');
}else if($res==-2){
	$arr = array('success'=>false ,'errorMsg'=>'新密码不能与旧密码一致');
}else{
	$arr = array('success'=>false,'errorMsg'=>'网络原因');
}
echo json_encode($arr);
?>