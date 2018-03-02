<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$msgId = $_POST['msgId'];
$data =  readMsg($msgId);
if($data){
    $res = array('success'=>true);
}else{
    $res = array('success'=>false);
}
echo json_encode($res);
?>
