<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$sendId = $_POST['sendId'];
$userType = $_POST['userType'];
$limit = $_POST['limit'];
$page = $_POST['page'];
if($userType==2){
    $res = getUserId($sendId);
    $sendId = $res['user_id'];
}
$data =  json_decode(getMyMessageList($sendId,$limit,$page),true);
$res  = array('success' => true, 'data' => $data);
echo json_encode($res);
?>
