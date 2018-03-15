$(function () {
    isLogin();
    $('header .navBar .headUL li,.sidebar .slider-ul li').find('button').parent().addClass('none');
    $('header .navBar .headUL li.showName a,.sidebar .slider-ul li.showName a').html(sessionStorage.getItem('name'));
    $('header .navBar .headUL li.showName,.sidebar .slider-ul li.showName').removeClass('none');
   $('.personalNav ul li').click(function () {
        var index = $(this).index();
        if(index==0){
            window.location.href = 'home.html';
        }
        else if(index==1){
            window.location.href = 'message.html';
        }
        else if(index==2){
            window.location.href = 'leave.html';
        }
        else if(index==3){
            window.location.href = 'homework.html';
        }
        else if(index==4){
            window.location.href = 'myClass.html';
        }
        else if(index==5){
            window.location.href = "personalSet.html";
        }
   });

});
function isLogin(){
    // 登录检查
    var userId = sessionStorage.getItem('userId')||'';
    var type = sessionStorage.getItem('user_type')||'';
    if(userId==''||type==''||type==1){
        window.location.href = '../signin.html';
    }
    return;
}