$(function () {
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
   });
});