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
    $createTime = date('Y-m-d h:i:s');
	$sql = "update course set state=2, delete_time='$createTime' where course_id='$id'";
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
    if(is_array($res)){
        foreach($res as $item){
            $classId = $item->class_id;
            $sql2 = "select * from course where course_id = '$classId'";
            $course = get_row($sql2);
            $course['leftTime'] = $item->leftTime;
            array_push($list,$course);
        }
    }
    return $list;
}

function getTeacherCourseList($userId,$type){
	if($type==0){
		$sql = "select * from course where teacher_id = '$userId' and catalogue_id is null";
	}else if($type==1){
		$sql = "select * from course where teacher_id = '$userId' and catalogue_id is not null";
	}else if($type==2){
		$sql = "select * from course where teacher_id = '$userId' and state=0";
	}else if($type==3){
		$sql = "select * from course where teacher_id = '$userId' and state=1";
	}
	return get_datas($sql,2);
}

function teacherGetStudentList($courseId){
	$sql = "select * from orders where class_id = '$courseId'";
	$res = json_decode(get_datas($sql,2));
	if(is_array($res)){
        foreach($res as $item){
            $userId = $item->user_id;
            $sql2 = "select * from user where user_id = '$userId'";
            $student = get_row($sql2);
            $item->username = $student['name'];
            $item->avatar = $student['avatar'];
        }
    }
    return $res;
}

function arrangeCourseTime($orderId,$datetime){
	$sql = "update orders set has_class='1', class_time='$datetime' where order_id='$orderId'";
	$res = insert_datas($sql);
	return $res;
}

function finishArrangeCourse($orderId,$leftTime){
	$sql = "update orders set has_class='0',leftTime='$leftTime' where order_id='$orderId'";
	$res = insert_datas($sql);
	return $res;
}
function cancelArrangeCourse($orderId){
	$sql = "update orders set has_class='0' class_time=null where order_id='$orderId'";
	$res = insert_datas($sql);
	return $res;
}

function modifyArrangeCourseTime($orderId,$datetime){
	$sql = "update orders set class_time='$datetime' where order_id='$orderId'";
	$res = insert_datas($sql);
	return $res;
}

function getCanLeaveCourseList($userId){
	$sql = "select * from course where teacher_id='$userId'";
	$res = get_array($sql);
	$data = array();
	if(is_array($res)){
		foreach ($res as $item) {
			$course_id = $item['course_id'];
			$list = teacherGetStudentList($course_id);
			$item['list'] = $list;
			array_push($data, $item);
		}
		return $data;
	}
}

function studentGetArrangeCourse($userId){
	$sql = "select * from orders where user_id = '$userId' and has_class=1";
	$res = get_array($sql);
	$data = array();
	if(is_array($res)){
		foreach ($res as $item) {
			$courseId = $item['class_id'];
			$sql2 = "select * from course where course_id = '$courseId'";
			$rs = get_row($sql2);
			$item['course_intro'] = $rs;
			array_push($data, $item);
		}
		return $data;
	}
}

function submitLeave($orderId){
   	$sql = "update orders set has_class=-1 where order_id = '$orderId'";
    $flag = insert_datas($sql);
	return $flag;
}

// 判断用户是否购买过该课程
function ifPurchase($userId,$courseId){
    $sql = "select * from orders where class_id = '$courseId' and user_id = '$userId'";
    $flag = get_datas($sql,1);
    return $flag;
}

function purchaseCourse($userId,$courseId,$courseHours){
    $createTime = date('Y-m-d h:i:s');
    $sql = "insert into orders (class_id,user_id,create_time,state,leftTime,has_class) values ('$courseId','$userId','$createTime',0,'$courseHours',0)";
    $flag = insert_datas($sql);
    return $flag;
}
?>