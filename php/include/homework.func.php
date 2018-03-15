<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取作业列表
function getHomeworkList($userId,$type,$state){
    if($type==0){
        // 学生获得作业列表
        $sql = "select * from orders where user_id = $userId";
        $res =  json_decode(get_datas($sql,2));
        if(is_array($res)){
            foreach($res as $item){
                $classId = $item->class_id;
                $sql2 = "select * from course where course_id = '$classId'";
                $course = get_row($sql2);
                $item->course_name = $course['course_name'];
                $sql3 = "select * from homework where class_id = '$classId' and student_id='$userId' and finish_state = '$state'";
                $homework = get_array($sql3);
                $item->homework = $homework;
            }
        }
        return json_encode($res);
        // $sql = "select * from homework where class_id='$classId' and student_id='$userId'";
    }else{
        $sql = "select * from homework where class_id='$classId' and teacher_id='$userId'";
        return get_datas($sql,2);
    }
}
function getHomeworkInfo($homeworkId){
    $sql = "select * from homework where homework_id = '$homeworkId' limit 1";
    return get_datas($sql,1);
}
function finishHomework($homeworkId){
    $sql = "update homework set finish_state=1 where homework_id = '$homeworkId'";
    $flag = insert_datas($sql);
    return $flag;
}
function addHomework($catalogueId,$courseId,$content,$teacherId){
    $sql = "select * from orders where class_id = '$courseId'";
    $userList = json_decode(get_datas($sql,2));
    if(is_array($userList)){
        $k = true;
        foreach($userList as $item){
            $userId = $item->user_id;
            $create_time = date("y-m-d h:i:s");
            $sql2 = "insert into homework (class_id,catalogue_id,teacher_id,student_id,create_time,content,finish_state,state) values ('$courseId','$catalogueId','$teacherId','$userId','$create_time','$content','0','0')";
            $flag = insert_datas($sql2);
            if(!$flag){
                $k = false;
            }
        }
        return $k;
    }
}
?>