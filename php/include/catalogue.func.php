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
					$k = false;
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
	$res = json_decode(get_datas($sql,2));
	if(is_array($res)){
		foreach ($res as $item) {
			$catalogue_id = $item->id;
			$flag = exit_homework($catalogue_id);
			if($flag){
				$item->has_homework = 1;

			}else{
				$item->has_homework = 0;
			}
		}
	}
	return json_encode($res);
	// return get_datas($sql,2);
}
function editCatalogue($catalogue,$course_id){
	if(is_array($catalogue)){
		$k = true;
		foreach ($catalogue as $item) {
			$sort_line = $item['id'];
			$content = $item['content'];
			$flag = exit_catalogue($sort_line,$course_id);
			$publish_time = date("y-m-d h:i:s");
			if($flag){
				//存在，修改 
				$sql = "update catalogue set content='$content',publish_time='$publish_time' where course_id = '$course_id' and sort_line = '$sort_line'";
			}else{
				// 不存在，add
				$sql = "insert into catalogue (course_id,content,sort_line,publish_time) values ('$course_id','$content','$sort_line','$publish_time')";
			}
			$res = insert_datas($sql);
			if(!$res){
				$k = false;
			}
		}
		return $k;
	}
}
function exit_catalogue($sort_line,$course_id){
	$sql = "select * from catalogue where course_id = '$course_id' and sort_line = '$sort_line'";
	if(get_row($sql)==null){
		return false;
	}
	return true;
}
function exit_homework($catalogue_id){
	$sql = "select * from homework where catalogue_id = '$catalogue_id' limit 1";
	$res = get_row($sql);
	if($res==null){
		return false;
	}
	return true;
}
function useCatalogueToCourseInfo($catalogueId){
	$sql = "select * from catalogue where id = '$catalogueId'";
	$result = get_row($sql);
	$catalogue_content = $result['content'];
	$courseId = $result['course_id'];
	$sql2 = "select * from course where course_id = '$courseId'";
	$res = get_row($sql2);
	$res['catalogue_content'] = $catalogue_content;
	return json_encode($res);
}

?>