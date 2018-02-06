<?php
if (!defined('IN_TG')) {
    exit('非法调用');
}
// 跨域访问
header('Access-Control-Allow-Origin:*');
// 转换硬路径
define('ROOT_PATH', substr(dirname(__FILE__), 0, -7));
// 引入数据库
require ROOT_PATH.'include/database.func.php';
// 引入全局功能
require ROOT_PATH.'include/global.func.php';
// 引入用户功能
require ROOT_PATH.'include/user.func.php';
// 引入文章管理功能
require ROOT_PATH.'include/article.func.php';
// 引入课程功能
require ROOT_PATH.'include/course.func.php';
// 定义数据库相关内容
define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PWD','');
define('DB_NAME','musicadmin');
// 定义是否自动转义变量
define('GPC', get_magic_quotes_gpc());
// 连接数据库
connect_DB();
?>
