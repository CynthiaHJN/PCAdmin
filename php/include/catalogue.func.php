<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取作业列表
function setCatalogue($catalogue,$course_id){
	if(is_array($catalogue)){
		$k=true;
		foreach ($catalogue as $item) {
			$sort_line = $item['id'];
			$content = $item['content'];
			$publish_time = date("y-m-d h:i:s");
			$sql = "insert into catalogue (course_id,content,sort_line,publish_time) values ('$course_id','$content','$sort_line','$publish_time')";
			$flag = insert_datas($sql);
			if($flag){
				$sql2 = "update course set catalogue_id=1 where course_id = '$course_id'";
				$flag2 = insert_datas($sql2);
				if(!$flag2){
					$k = true;
				}
			}else{
				$k=false;
			}
		}
		return $k;
	}
}

function getThisCatalogueList($courseId){
	$sql = "select * from catalogue where course_id = '$courseId'";
	return get_datas($sql,2);
}

?>