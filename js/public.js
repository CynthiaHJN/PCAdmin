//获取url里的参数
function GetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

//日期格式化
Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}
//调用：
//var time1 = new Date().Format("yyyy-MM-dd");
//var time2 = new Date().Format("yyyy-MM-dd HH:mm:ss");


//身份证校验
function checkIdcard(num){
    num = num.toUpperCase();
    //身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X。
    if (!(/(^\d{15}$)|(^\d{17}([0-9]|X)$)/.test(num))){
        return false;
    }
    //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
    //下面分别分析出生日期和校验位
    var len, re;
    len = num.length;
    if (len == 15)
    {
        re = new RegExp(/^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/);
        var arrSplit = num.match(re);

        //检查生日日期是否正确
        var dtmBirth = new Date('19' + arrSplit[2] + '/' + arrSplit[3] + '/' + arrSplit[4]);
        var bGoodDay;
        bGoodDay = (dtmBirth.getYear() == Number(arrSplit[2])) && ((dtmBirth.getMonth() + 1) == Number(arrSplit[3])) && (dtmBirth.getDate() == Number(arrSplit[4]));
        if (!bGoodDay)
        {
            return false;
        }
        else
        {
            //将15位身份证转成18位
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            var nTemp = 0, i;
            num = num.substr(0, 6) + '19' + num.substr(6, num.length - 6);
            for(i = 0; i < 17; i ++)
            {
                nTemp += num.substr(i, 1) * arrInt[i];
            }
            num += arrCh[nTemp % 11];
            return true;
        }
    }
    if (len == 18)
    {
        re = new RegExp(/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/);
        var arrSplit = num.match(re);
        //检查生日日期是否正确
        var dtmBirth = new Date(arrSplit[2] + "/" + arrSplit[3] + "/" + arrSplit[4]);
        var bGoodDay;
        bGoodDay = (dtmBirth.getFullYear() == Number(arrSplit[2])) && ((dtmBirth.getMonth() + 1) == Number(arrSplit[3])) && (dtmBirth.getDate() == Number(arrSplit[4]));
        if (!bGoodDay)
        {
            return false;
        }
        else
        {
            //检验18位身份证的校验码是否正确。
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            var valnum;
            var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            var nTemp = 0, i;
            for(i = 0; i < 17; i ++)
            {
                nTemp += num.substr(i, 1) * arrInt[i];
            }
            valnum = arrCh[nTemp % 11];
            if (valnum != num.substr(17, 1))
            {
                return false;
            }
            return true;
        }
    }
    return true;
}

//通用弹窗
var cgtzUtil = {
    /*
     提醒(带确认的提醒)

     showGeneralLayer('保存成功');

     showGeneralLayer({
     'title':'提醒',
     'msg':'请输入正确的手机号',
     'buttonText':'我知道了'});

     */
    showGeneralLayer : function(params, callback) {
        var data = {};
        if (typeof arguments[0] != 'object') {
            data.msg = params;
        } else {
            data = params;
        }

        $('.layer-wrapper').remove();
        $('.mask').remove();

        var _confirmLayer = "<div class='layer-wrapper'>"+
            "<div class='layer-title'>"+(data.title||'提醒')+"</div>"+
            "<div class='layer-content' style='margin-top:0.5rem !important;'>"+
            (data.msg || '') +
            "</div>"+
            "<div class='layer-button' style='margin-top:0.5rem !important;'>"+
            "<span class='close'>"+(data.buttonText||'确认')+"</span>"+
            "</div>"+
            "</div>";
        $('body').append("<div class='mask'></div>");
        $('body').append(_confirmLayer);

        $('.layer-wrapper .close').unbind('click').bind('click', function() {
            callback && callback();
            $('.layer-wrapper').remove();
            $('.mask').remove();
        });

    },

    /*
     确认弹窗
     data = {
     title: '绑卡确认',
     content: ''
     buttonText: ['取消', '确认']

     }*/

    showConfirmLayer : function(params, callback) {
        var data = params || {};

        $('.layer-wrapper').remove();
        $('.mask').remove();

        var _confirmLayer = "<div class='layer-wrapper'>"+
            "<div class='layer-title'>"+(data.title||'提醒')+"</div>"+
            "<div class='layer-content'>"+
            (data.content || '') +
            "</div>"+
            "<div class='layer-button'>"+
            "<span class='cancel'>"+(data.buttonText[0]||'取消')+"</span>"+
            "<span class='confirm'>"+(data.buttonText[1]||'确认')+"</span>"+
            "</div>"+
            "</div>";
        $('body').append("<div class='mask'></div>");
        $('body').append(_confirmLayer);

        $('.layer-wrapper .cancel').unbind('click').bind('click', function() {
            $('.layer-wrapper').remove();
            $('.mask').remove();

        });

        $('.layer-wrapper .confirm').unbind('click').bind('click', function() {
            callback && callback();
            $('.layer-wrapper').remove();
            $('.mask').remove();

        });

    }
}


function checkPhone(phone){
    if(!(/^1[34578]\d{9}$/.test(phone))){ 
        alert("手机号码有误，请重填");  
        return false; 
    } 
}

function getUserId(mobile,type){
    $.ajax({
       url:'/PCAdmin/php/getUserId.php',
       type:'post',
       dataType:'json',
       data:{
           mobile: mobile
       },
        success: function (res) {
            if(res.success){
                sessionStorage.setItem('mobile',mobile);
                sessionStorage.setItem('user_type',type);
                sessionStorage.setItem('userId',res.data.user_id);
                sessionStorage.setItem('name',res.data.name);
                if(type==0){
                    window.location.href="/PCAdmin/html/userPC/student/home.html";
                }else{
                    window.location.href="/PCAdmin/html/userPC/teacher/home.html";
                }
            }
        }
    });
}

function isLogin(){
    // 登录检查
    var userId = sessionStorage.getItem('userId')||'';
    if(userId==''){
       return false;
    }
    return true;
}

