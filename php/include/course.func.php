<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
function addCourse($arr){
	$courseName = $arr['courseName'];
	$startTime = $arr['startTime'];
	$endTime = $arr['endTime'];
	$limitNum = $arr['limitNum'];
	$courseType = $arr['courseType'];
	$teacherId = $arr['teacherId'];
	$courseIntro = $arr['courseIntro'];
	$courseImg = $arr['courseImg'];
	$courseHours = $arr['courseHours'];
	$coursePrice = $arr['coursePrice'];
	$sql = "insert into course (teacher_id,course_type,course_name,course_hours,limit_members,short_intro,start_time,end_time,state,banner,price) values ($teacherId,'$courseType','$courseName',$courseHours,$limitNum,'$courseIntro','$startTime','$endTime',0,'$courseImg',$coursePrice)";
	$flag = insert_datas($sql);
	return $flag;
}
// 获取课程列表
function getCourseList($limit,$page){
	$sql = "select count(*) as totalSize from course where state != 2";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from course where state != 2 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
}

function deleteCourse($id){
	$sql = "update course set state=2 where course_id='$id'";
	return insert_datas($sql);
}

function getCourseInfo($id){
	$sql = "select * from course where course_id='$id'";
	return get_datas($sql,1);
}

function editCourse($arr){
	$courseId = $arr['courseId'];
	$courseName = $arr['courseName'];
	$startTime = $arr['startTime'];
	$endTime = $arr['endTime'];
	$limitNum = $arr['limitNum'];
	$courseType = $arr['courseType'];
	$teacherId = $arr['teacherId'];
	$courseIntro = $arr['courseIntro'];
	$courseImg = $arr['courseImg'];
	$courseHours = $arr['courseHours'];
	$coursePrice = $arr['coursePrice'];
	$sql = "update course set teacher_id='$teacherId',course_type='$courseType',course_name='$courseName',course_hours='$courseHours',limit_members='$limitNum',short_intro='$courseIntro',start_time='$startTime',end_time='$endTime',banner='$courseImg',price='$coursePrice' where course_id='$courseId'";
	$flag = insert_datas($sql);
	return $flag;
}

function getUserCourse($userId,$state){
    $sql = "select * from orders where user_id = $userId and state = $state";
    $res =  json_decode(get_datas($sql,2));
    $list = array();
    foreach($res as $item){
        $classId = $item->class_id;
        $sql2 = "select * from course where course_id = '$classId'";
        $course = get_row($sql2);
        $course['leftTime'] = $item->leftTime;
        array_push($list,$course);
    }
    return $list;
}

function submitLeave($userId,$teacherId,$reason,$title){
    $publish_time = date("y-m-d h:i:s");
    $sql = "insert into message (send_id,receive_id,publish_time,title,content,type,state) values ('$userId','$teacherId','$publish_time','$title','$reason','1','0')";
    $flag = insert_datas($sql);
	return $flag;
}
?>