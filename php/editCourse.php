<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/include/common.inc.php';
$courseId = $_POST['courseId'];
$courseName = $_POST['courseName'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$limitNum = $_POST['limitNum'];
$courseType = $_POST['courseType'];
$teacherId = $_POST['teacherId'];
$courseIntro = $_POST['courseIntro'];
$courseImg = $_POST['courseImg'];
$courseHours = $_POST['courseHours'];
$coursePrice = $_POST['coursePrice'];
$res = json_decode(getCourseInfo($courseId));
if($courseImg!=$res->banner){
	$courseImg = base64_image_content($courseImg,'../img/course');
}
$arr = array('courseId'=>$courseId,'courseName' => $courseName, 'startTime' => $startTime, 'endTime' => $endTime, 'limitNum' => $limitNum, 'courseType' => $courseType, 'teacherId' => $teacherId, 'courseIntro' => $courseIntro, 'courseImg' => $courseImg, 'courseHours' => $courseHours, 'coursePrice' => $coursePrice);
$flag = editCourse($arr);
echo json_encode($flag);
?>