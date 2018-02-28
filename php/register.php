<?php
/**
 * Created by PhpStorm.
 * User: Cynthia
 * Date: 2018/2/11
 * Time: 20:05
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$name = $_POST['name'];
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$type = $_POST["type"];
$flag = exit_user($mobile);
if($flag){
    $data = array('success'=>false,'errorMsg'=>'该手机号已被注册');
    echo json_encode($data);
}else{
    $res = user_register2($name,$mobile,$password,$type);
    $data = array('success'=>$res);
    echo json_encode($data);
}
?>