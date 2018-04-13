<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取消息列表 state:0未读 1已读 -1 删除
function getMessageList($receiveId,$state){
    $sql = "select * from message where receive_id = '$receiveId' and state = '$state' order by publish_time desc";
    $res = get_array($sql);
    $list = array();
    if(is_array($res)){
        foreach($res as $item){
            $send_id = $item['send_id'];
            $sql2 = "select * from user where user_id = '$send_id'";
            $user = get_row($sql2);
            $item['send_name'] = $user['name'];
            array_push($list,$item);
        }
    }
    return $list;
}
// 获取某一条消息的具体内容
function getMessageInfo($id){
    $sql = "select * from message where id = '$id'";
    return get_datas($sql,1);
}

function readMsg($msgId){
    $sql = "update message set state=1 where id = '$msgId'";
    $flag = insert_datas($sql);
    return $flag;
}

function deleteMsg($msgId){
    $delete_time = date("y-m-d h:i:s");
    $sql = "update message set state=-1,delete_time='$delete_time' where id='$msgId'";
    $flag = insert_datas($sql);
    return $flag;
}

function sendMessage($send_id,$receive_id,$reason,$title,$type){
    $publish_time = date("y-m-d h:i:s");
    $sql = "insert into message (send_id,receive_id,publish_time,title,content,type,state) values ('$send_id','$receive_id','$publish_time','$title','$reason','$type','0')";
    $flag = insert_datas($sql);
    return $flag;
}

function getTypeMessage($type,$state){
    $sql = "select * from message where type='$type' and state='$state' order by publish_time desc";
    $res = get_array($sql);
    return $res;
}

function getMyMessageList($sendId,$limit,$page){
    $sql = "select count(*) as totalSize from message where send_id=$sendId";
    $totalSize = get_row($sql)['totalSize'];
    $totalPage = ceil($totalSize/$limit);
    $pageSize = ($page-1)*$limit;
    $sql2 = "select * from message where send_id=$sendId order by publish_time desc limit $pageSize,$limit";
    $res = get_array($sql2);
    $arr = array('list'=>$res,'totalPage'=>$totalPage,'totalSize'=>$totalSize,'currentPage'=>$page);
    return json_encode($arr);
}

function putMsgOverdue($msgId){
    $sql = "update message set state=-2 where id='$msgId'";
    return insert_datas($sql);
}
?>