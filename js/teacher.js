$(function () {
    isLogin();
    $('header .navBar .headUL li,.sidebar .slider-ul li').find('button').parent().addClass('none');
    $('header .navBar .headUL li.showName a,.sidebar .slider-ul li.showName a').html(sessionStorage.getItem('name'));
    $('header .navBar .headUL li.showName,.sidebar .slider-ul li.showName,header .navBar .headUL li.afterLog').removeClass('none');
   $('.personalNav ul li').click(function () {
        var index = $(this).index();
        if(index==0){
            window.location.href = '../html/userPC/teacher/message.html';
        }
        else if(index==1){
            window.location.href = '../html/userPC/teacher/leave.html';
        }
        else if(index==2){
            window.location.href = '../html/userPC/teacher/catalogue.html';
        }
        else if(index==3){
            window.location.href = '../html/userPC/teacher/myClass.html';
        }
        else if(index==4){
            window.location.href = '../html/userPC/teacher/personalSet.html';
        }
   });

});
function isLogin(){
    // 登录检查
    var userId = sessionStorage.getItem('userId')||'';
    var type = sessionStorage.getItem('user_type')||'';
    if(userId==''||type==''||type==0){
        window.location.href = '../html/userPC/signin.html';
    }
    return;
}