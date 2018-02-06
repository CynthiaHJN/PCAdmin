<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$content = $_POST['content'];
$mobile = $_POST['mobile'];
$type = $_POST['type'];
$title = $_POST['title'];
$author = $_POST['author'];
$time = time();
$fileName = $mobile.'_'.$time.'.txt';
if($type==1){
	$fileName = 'composition/'.$fileName;
}else if($type==2){
	$fileName = 'instrument/'.$fileName;
}else{
	$fileName = 'musicTheory/'.$fileName;
}
$articleInfo = array('title' => $title, 'address' => $fileName, 'author'=>$author, 'type'=>$type);
$res = addArticle($articleInfo);
if($res==1){
	$myfile = fopen('../articleStorage/'.$fileName,"w") or die("Unable to open file!");
	fwrite($myfile, $content);
	fclose($myfile);
	$data = array('success' => true);
	echo json_encode($data);
}else{
	$data = array('success' => false);
	echo json_encode($data);
}
?>