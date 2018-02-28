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