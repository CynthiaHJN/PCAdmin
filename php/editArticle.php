<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$content = $_POST['content'];
$type = $_POST['type'];
$title = $_POST['title'];
$author = $_POST['author'];
$id = $_POST['id'];
$fileName = $_POST['path'];
$articleInfo = array('id'=>$id,'title' => $title,'author'=>$author, 'type'=>$type);
$res = editArticle($articleInfo);
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