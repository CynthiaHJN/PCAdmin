<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
function addArticle($article){
	$title = $article['title'];
	$publish_time = date("y-m-d h:i:s");
	$path = $article['address'];
	$author = $article['author'];
	$state = 0;
	$type = $article['type'];
	$sql = "insert into article (title,publish_time,path,author,state,type) values ('$title','$publish_time','$path','$author',$state,$type)" ;
	$flag = insert_datas($sql);
	return $flag;
}
function getArticleInfo($id){
	$sql = "select * from article where article_id = '$id'";
	$res =  get_row($sql);
	return $res;
}
function getCompositionList($limit,$page){
	$sql = "select count(*) as totalSize from article where type=1 and state=0";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from article where type=1 and state=0 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
	// $sql = "select * from article where type=1 and state=0";
	// return get_datas($sql,2);
}
function getInstrumentList($limit,$page){
	$sql = "select count(*) as totalSize from article where type=2 and state=0";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from article where type=2 and state=0 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
}
function getMusicTheoryList($limit,$page){
	$sql = "select count(*) as totalSize from article where type=3 and state=0";
	$totalSize = get_row($sql)['totalSize'];
	$totalPage = ceil($totalSize/$limit);
	$pageSize = ($page-1)*$limit;
	$sql2 = "select * from article where type=3 and state=0 limit $pageSize,$limit";
	$res = get_datas($sql2,2);
	$arr = array('list'=>json_decode($res),'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
	return json_encode($arr);
}
function deleteArticle($id){
	$date = date('Y-m-d h:i:s');
	$sql = "update article set state=2,delete_time='$date' where article_id = $id"; 
	return insert_datas($sql);
}
function editArticle($article){
	$id = $article['id'];
	$title = $article['title'];
	$publish_time = date("y-m-d h:i:s");
	$author = $article['author'];
	$type = $article['type'];
	$sql = "update article set title='$title',publish_time='$publish_time',author='$author',type=$type where article_id = $id";
	$flag = insert_datas($sql);
	return $flag;
}
?>