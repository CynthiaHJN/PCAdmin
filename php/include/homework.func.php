<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取作业列表
function getHomeworkList($classId,$userId,$type){
    if($type==0){
        $sql = "select * from homework where class_id='$classId' and student_id='$userId'";
    }else{
        $sql = "select * from homework where class_id='$classId' and teacher_id='$userId'";
    }
    return get_datas($sql,2);
}
function getHomeworkInfo($homeworkId){
    $sql = "select * from homework where homework_id = '$homeworkId' limit 1";
    return get_datas($sql,1);
}
?>