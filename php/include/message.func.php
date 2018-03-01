<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
// 获取消息列表 state:0未读 1已读 -1 删除
function getMessageList($receiveId,$state){
    $sql = "select * from message where receive_id = '$receiveId' and $state = '$state'";
    return get_datas($sql,2);
}
// 获取某一条消息的具体内容
function getMessageInfo($id){
    $sql = "select * from message where id = '$id'";
    return get_datas($sql,1);
}
?>