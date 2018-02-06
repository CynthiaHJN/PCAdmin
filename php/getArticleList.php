<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$type = $_POST['type'];
$limit = $_POST['limit'];
$page = $_POST['page'];
if($type==1){
	$data = json_decode(getCompositionList($limit,$page));
	$res  = array('success' => true, 'data' => $data);
	echo json_encode($res);
}else if($type==2){
	$data = json_decode(getInstrumentList($limit,$page));
	$res  = array('success' => true, 'data' => $data);
	echo json_encode($res);
}else{
	$data = json_decode(getMusicTheoryList($limit,$page));
	$res  = array('success' => true, 'data' => $data);
	echo json_encode($res);
}
?>