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
$res = getUserId($mobile);
if($res){
    $arr = array('success'=>'true','data'=>$res);
}else{
    $arr = array('success'=>'false');
}
echo json_encode($arr);
?>