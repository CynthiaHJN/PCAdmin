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
		$(this).find('logout').removeClass('none');
	});
	$('.site-header nav .showName').click(function(){
		var user_type = sessionStorage.getItem('user_type');
		if(user_type==0){
			window.location.href = "/PCAdmin/html/userPC/student/myClass.html";
		}else{
			window.location.href = "/PCAdmin/html/userPC/teacher/myClass.html";
		}
	});
	$('header .navBar .headUL .logOut').on('click',function(){
		sessionStorage.remove('mobile');
		sessionStorage.remove('name');
		sessionStorage.remove('userId');
		sessionStorage.remove('userType');
		window.loaction.reload();
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