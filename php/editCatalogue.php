<?php
/**
 * Created by PhpStorm.
 * User: Cynthia
 * Date: 2018/2/11
 * Time: 20:05
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$catalogue = $_POST['catalogue'];
$course_id = $_POST['courseId'];
$res = editCatalogue($catalogue,$course_id);
if($res){
    $arr = array('success'=>true);
}else{
    $arr = array('success'=>false);
}
echo json_encode($arr);
?>