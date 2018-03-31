<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$userId = $_POST['userId'];
$courseId = $_POST['courseId'];
$courseHours = $_POST['courseHours'];
$res = ifPurchase($userId,$courseId);
if($res && $res!='null'){
    $datas = array('success'=>'false','errorMsg'=>'您已购买该门课程，请勿重复购买!');
}else{
    $result = purchaseCourse($userId,$courseId,$courseHours);
    if($result){
        $datas = array('success'=>'true');
    }else{
        $datas = array('success'=>'false','errorMsg'=>'网络原因!');
    }
}
echo json_encode($datas);
?>