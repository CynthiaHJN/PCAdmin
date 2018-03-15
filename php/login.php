<?php
/**
 * Created by PhpStorm.
 * User: Cynthia
 * Date: 2018/2/18
 * Time: 13:25
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$type = $_POST['type'];
$flag = exit_user($mobile);
if(!$flag){
    $data = array('success'=>false,'errorCode'=>1,'errorMsg'=>'该手机号还未注册');
    echo json_encode($data);
}else{
    $password = md5($password);
    $res = user_login2($mobile,$password);
    if($res){
        if($res==($type+1)){
            $data = array('success'=>true);
        }else{
            $data = array('success'=>false,'errorCode'=>3,'errorMsg'=>'用户名不存在');
        }
        echo json_encode($data);
    }else{
        $data = array('success'=>false,'errorCode'=>2,'errorMsg'=>'输入的密码不正确');
        echo json_encode($data);
    }
}
?>