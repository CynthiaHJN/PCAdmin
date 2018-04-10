$(function(){
	load();
	$('.listNav').click(function(){
		$('.sliderBar').slideToggle();
	});
	window.onresize = function(){
		if($(window).width()>600){
			$('.sliderBar').hide();
		}
	}
	$('.site-header nav .showName').hover(function(){
		$('.site-header nav .showName .logOut').removeClass('none');
	},function(){
        $('.site-header nav .showName .logOut').addClass('none');
	});
	$('.site-header nav .showName .active').click(function(){
		var user_type = sessionStorage.getItem('user_type');
		if(user_type==0){
			window.location.href = "/PCAdmin/html/userPC/student/myClass.html";
		}else{
			window.location.href = "/PCAdmin/html/userPC/teacher/myClass.html";
		}
	});
	$('.site-header nav .showName .logOut').on('click',function(){
		sessionStorage.removeItem('mobile');
		sessionStorage.removeItem('name');
		sessionStorage.removeItem('userId');
		sessionStorage.removeItem('userType');
        location.reload();
	});
	$('.site-header nav .btn-log,.sliderBar .btn-log').click(function(){
		window.location.href = "/PCAdmin/html/userPC/signin.html";
	});
});

function load(){
	var flag = isLogin();
	if(flag){
		$('header .navBar .headUL li,.sidebar .slider-ul li').find('button').parent().addClass('none');
        $('header .navBar .headUL li.showName a,.sidebar .slider-ul li.showName a').html(sessionStorage.getItem('name'));
        $('header .navBar .headUL li.showName,.sidebar .slider-ul li.showName').removeClass('none');
	}
}

function isLogin(){
    // 登录检查
    var userId = sessionStorage.getItem('userId')||'';
    if(userId==''){
        return false;
    }
    return true;
}