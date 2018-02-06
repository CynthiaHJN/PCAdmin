<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$list = $_POST['list'];
$count = 0;
foreach ($list as $item) {
	$flag = exit_user($item['mobile']);
	if($flag){
		$count = $count + 1;
	}else{
		$i = pushTeacherTable($item);
		if($i==false){
			$count = $count + 1;
		}
	}
}
$data = array('success'=>true,'failCount'=>$count);
echo json_encode($data);
?>