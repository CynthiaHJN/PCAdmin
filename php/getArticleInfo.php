<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$id = $_POST['id'];
// $id = 11;
$res = getArticleInfo($id);
$path = "../articleStorage/".$res['path'];
$myfile = fopen($path, "r") or die("Unable to open file!");
$content='';
// 输出单字符直到 end-of-file
while(!feof($myfile)) {
  $content= $content.fgetc($myfile);
}
fclose($myfile);
// echo $content;
$arr = array('success'=>true,'content'=>$content,'data'=>$res);
echo json_encode($arr);
?>
