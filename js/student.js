$(function () {
    isLogin();
    $('header .navBar .headUL li,.sidebar .slider-ul li').find('button').parent().addClass('none');
    $('header .navBar .headUL li.showName a,.sidebar .slider-ul li.showName a').html(sessionStorage.getItem('name'));
    $('header .navBar .headUL li.showName,.sidebar .slider-ul li.showName,header .navBar .headUL li.afterLog').removeClass('none');
   $('.personalNav ul li').click(function () {
        var index = $(this).index();
        if(index==0){
            window.location.href = '../html/userPC/student/message.html';
        }
        else if(index==1){
            window.location.href = '../html/userPC/student/leave.html';
        }
        else if(index==2){
            window.location.href = '../html/userPC/student/homework.html';
        }
        else if(index==3){
            window.location.href = '../html/userPC/student/myClass.html';
        }
        else if(index==4){
            window.location.href = "../html/userPC/student/personalSet.html";
        }
   });
});
function isLogin(){
    // 登录检查
    var userId = sessionStorage.getItem('userId')||'';
    var type = sessionStorage.getItem('user_type')||'';
    if(userId==''||type==''||type==1){
        window.location.href = '../html/userPC/signin.html';
    }
    return;
}