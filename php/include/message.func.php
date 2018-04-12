<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取消息列表 state:0未读 1已读 -1 删除
function getMessageList($receiveId,$state){
    $sql = "select * from message where receive_id = '$receiveId' and state = '$state' order by publish_time desc";
    $res = json_decode(get_datas($sql,2));
    $list = array();
    if(is_array($res)){
        foreach($res as $item){
            $send_id = $item->send_id;
            $sql2 = "select * from user where user_id = '$send_id'";
            $user = get_row($sql2);
            $item->send_name = $user['name'];
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
    $sql = "select * from message where type='$type' and state='$state'";
    return get_datas($sql,2);
}
?> 