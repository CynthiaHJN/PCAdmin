<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$mobile = $_POST['sendId'];
$title = $_POST['title'];
$msgCnt = $_POST['msgCnt'];
$sendUser = $_POST['sendUser'];
if($sendUser==1){
    $state = 10;
}else if($sendUser==2){
    $state = 11;
}else{
    $state = 12;
}
$res = getUserId($mobile);
$flag = sendMessage($res['user_id'],'0',$msgCnt,$title,$state);
$array = array('success'=>$flag);
echo json_encode($array);
?>
