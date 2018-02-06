<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 用户注册
function user_register($mobile,$password,$user_type){
	$pwd = md5($password);
	$sql = "insert into user (mobile,password,user_type) values ('$mobile','$pwd',$user_type)";
	$flag = insert_datas($sql);
	return $flag;
}

// 用户登录
function user_login($mobile,$password,$user_type){
	$sql = "select * from user where mobile='$mobile' and password='$password' and user_type=$user_type";
	if(get_row($sql)==null){
		return false;
	}
	return true;
}

// 检查用户是否存在
function exit_user($mobile){
	$sql = "select * from user where mobile = '$mobile' limit 1";
	if(get_row($sql)==null){
		return false;
	}
	return true;
}

// 管理员单独添加教师
function addOneTeacher($arr){
	$teacherName = $arr['teacherName'];
	$rank = $arr['rank'];
	$direction = $arr['direction'];
	$mobile = $arr['mobile'];
	$idCard = $arr['idCard'];
	$sex = $arr['sex'];
	$age = $arr['age'];
	$user_type = 1;
	$password = md5('123456');
	$sql = "insert into user (mobile,name,password,user_type,sex,age,teacher_rank,teach_direction,id_card) values ('$mobile','$teacherName','$password',$user_type,$sex,$age,'$rank','$direction','$idCard')" ;
	$flag = insert_datas($sql);
	return $flag;
}

// 获取教师列表
function getTeacherList($limit,$page){
	$sql = "select count(*) as totalSize from user where user_type=1 and state=0";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from user where user_type=1 and state=0 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
}

// 批量导入教师
function pushTeacherTable($item){
	$name = $item['name'];
	$mobile = $item['mobile'];
	$rank = $item['rank'];
	$direction = $item['direction'];
	$aptitude = $item['aptitude'];
	$idcard = $item['idcard'];
	$sex = $item['sex'];
	$age = $item['age'];
	$password = md5('123456');
	$user_type = 1;
	$sql = "insert into user (mobile,name,password,user_type,aptitude,sex,age,teacher_rank,teach_direction,id_card) values ('$mobile','$name','$password',$user_type,'$aptitude',$sex,$age,'$rank','$direction','$idcard')" ;
	$flag = insert_datas($sql);
	return $flag;
}

// 管理员删除一个用户
function deleteUser($userId){
	$sql = "update user set state=2 where user_id='$userId'";
	return insert_datas($sql);
}

// 管理员单独添加学生
function addOneStudent($arr){
	$name = $arr['name'];
	$mobile = $arr['mobile'];
	$sex = $arr['sex'];
	$age = $arr['age'];
	if($sex==''){
		$sex = 0;
	}
	if($age==''){
		$age = 0;
	}
	$user_type = 0;
	$password = md5('123456');
	$sql = "insert into user (mobile,name,password,user_type,sex,age) values ('$mobile','$name','$password',$user_type,$sex,$age)" ;
	$flag = insert_datas($sql);
	return $flag;
}

// 获取学生列表
function getStudentList($limit,$page){
	$sql = "select count(*) as totalSize from user where user_type=0 and state=0";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from user where user_type=0 and state=0 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
}

function getUserInfo($id){
	$sql = "select * from user where user_id = $id";
	$res =  get_row($sql);
	return $res;
}

function editUser($item){
	$id = $item['id'];
	$type = $item['type'];
	$name = $item['name'];
	$sex = $item['sex'];
	$age = $item['age'];
	if($type==0){
		$sql = "update user set name = '$name', sex = $sex, age = $age where user_id = $id";
	}else{
		$rank = $item['rank'];
		$direction = $item['direction'];
		$sql = "update user set name = '$name', sex = $sex, age = $age, teacher_rank = '$rank', teach_direction = '$direction' where user_id = $id";
	}
 	$flag = insert_datas($sql);
	return $flag;
}

function getSomeTeacher($courseType){
	$sql = "select * from user where user_type=1 and teach_direction like '%$courseType%'";
	$res = get_datas($sql,2);
	return $res;
}
?>