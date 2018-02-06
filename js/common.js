$(function(){
	load();
	$('.container .sidebar .sidenav a').click(function(){
		var $this = $(this);
		var index = $this.parent().index();
		if($this.hasClass('active')){
			return;
		}
		if(index==0){
			window.location.href = '/PCAdmin/html/manager/course/index.html';
		}else if(index == 1) {
			window.location.href = '/PCAdmin/html/manager/teacher/index.html';
		}else if(index == 2) {
			window.location.href = '/PCAdmin/html/manager/student/index.html';
		}else if(index == 3) {
			window.location.href = '/PCAdmin/html/manager/article/index.html';
		}else{
			window.location.href = '/PCAdmin/html/manager/aptitude/index.html';
		}
	});
	$('.container .wrapper .mainCon .rightCon nav .topNav li').click(function(){
		var $this = $(this);
		if($this.hasClass('active')){
			return;
		}
		if($this.parent().hasClass('coursePage')){
			if($this.index()==0){
				window.location.href = 'index.html';
			}
			if($this.index()==1){
				window.location.href = 'addCourse.html'; 
			}
		}
		if($this.parent().hasClass('teacherPage')){
			if($this.index()==0){
				window.location.href = 'index.html';
			}else if($this.index()==1){
				window.location.href = 'addTeacher.html';
			}else{
				window.location.href = 'pushTeacherTable.html';
			}
		}
		if($this.parent().hasClass('articlePage')){
			if($this.index()==0){
				window.location.href = 'index.html';
			}
			if($this.index()==1){
				window.location.href = 'addArticle.html';
			}
		}
		if($this.parent().hasClass('studentPage')){
			if($this.index()==0){
				window.location.href = 'index.html';
			}
			if($this.index()==1){
				window.location.href = 'addStudent.html';
			}
			if($this.index()==2){
				window.location.href = 'pushStudentTable.html';
			}
		}
	});
});

function load(){
	// 登录检查
	var username = sessionStorage.getItem('username')||'';
	if(username==''){
		window.location.href = "/PCAdmin/html/manager/login.html";
	}
	// 页面时间部分填写
	var $timeCon = $('.timeCon');
	var time = new Date();
	var obj = new Array();
	obj = String(time).split(' ');
	$('.weekdayEn').html(weekDayEN(time)+' '+obj[2]+' '+obj[1]);
	$('.weekdayCn').html(weekDayCN(time));
	$('.monthEn').html(month(time,1)+' '+obj[3]);
	$('.monthCn').html(month(time,0));
	$('.day em').html(obj[2]);
}

function weekDayCN(time){
	var w_array = new Array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	return w_array[time.getDay()];
}
function weekDayEN(time){
	var w_array = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
	return w_array[time.getDay()];
}
function month(time,type){
	var m_en = new Array('January','February','Marth','April','May','June','July','August','September','October','November','December');
	var m_cn = new Array('一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月');
	if(type){
		return m_en[time.getMonth()];
	}else{
		return m_cn[time.getMonth()];
	}
}