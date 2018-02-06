var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
//console.log(ctx);
// 绘制填充矩形
ctx.fillStyle = "rgb(200,0,0)";
ctx.fillRect(10,10,55,50);
ctx.fillStyle = "rgba(0,0,200,0.5)";
ctx.fillRect(30,30,55,50);

// 绘制描边矩形
ctx.strokeStyle = "rgb(200,0,0)";
ctx.strokeRect(100,100,10,20);

// 绘制三角形
ctx.beginPath();
ctx.moveTo(75,50);
ctx.lineTo(100,75);
ctx.lineTo(100,25);
ctx.lineTo(75,50);
ctx.fill();
ctx.stroke();

// 绘制圆形/圆弧  arc(x, y, radius, startAngle, endAngle, anticlockwise)
ctx.beginPath();
ctx.arc(150,150,50,0,Math.PI*2,true);
ctx.stroke();

//清除屏幕
ctx.clearRect(0,0,300,300);


//二次贝塞尔曲线及三次贝塞尔曲线
//quadraticCurveTo(cp1x, cp1y, x, y)二次
//bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y)三次

//二次贝塞尔曲线应用
ctx.beginPath();
ctx.moveTo(75,25);
ctx.quadraticCurveTo(25,25,25,62.5);
ctx.quadraticCurveTo(25,100,50,100);
ctx.quadraticCurveTo(50,120,30,125);
ctx.quadraticCurveTo(60,120,65,100);
ctx.quadraticCurveTo(125,100,125,62.5);
ctx.quadraticCurveTo(125,25,75,25);
ctx.stroke();


ctx.clearRect(0,0,300,300);
//三次贝塞尔曲线应用
//ctx.beginPath();
//ctx.moveTo(75,40);
//ctx.bezierCurveTo(75,37,70,25,50,25);
//ctx.bezierCurveTo(20,25,20,62.5,20,62.5);
//ctx.bezierCurveTo(20,80,40,102,75,120);
//ctx.bezierCurveTo(110,102,130,80,130,62.5);
//ctx.bezierCurveTo(130,62.5,130,25,100,25);
//ctx.bezierCurveTo(85,25,75,37,75,40);
//ctx.fill();

// 组合应用
roundedRect(ctx,19,19,180,170,9);
roundedRect(ctx,53,53,49,33,10);
roundedRect(ctx,53,119,49,16,6);
roundedRect(ctx,135,53,49,33,10);
roundedRect(ctx,135,119,25,49,10);

ctx.beginPath();
ctx.arc(37,37,13,Math.PI/7,-Math.PI/7,false);
ctx.lineTo(31,37);
ctx.fill();

for(var i=0;i<9;i++){
 ctx.fillRect(51+i*16,35,4,4);
}
for(i=0;i<9;i++){
 ctx.fillRect(115,51+i*16,4,4);
}

for(i=0;i<9;i++){
 ctx.fillRect(51+i*16,99,4,4);
}

ctx.beginPath();
ctx.moveTo(83,116);
ctx.lineTo(83,102);
ctx.bezierCurveTo(83,94,89,88,97,88);
ctx.bezierCurveTo(105,88,111,94,111,102);
ctx.lineTo(111,116);
ctx.lineTo(106.333,111.333);
ctx.lineTo(101.666,116);
ctx.lineTo(97,111.333);
ctx.lineTo(92.333,116);
ctx.lineTo(87.666,111.333);
ctx.lineTo(83,116);
ctx.fill();

ctx.fillStyle = "white";
ctx.beginPath();
ctx.moveTo(91,96);
ctx.bezierCurveTo(88,96,87,99,87,101);
ctx.bezierCurveTo(87,103,88,106,91,106);
ctx.bezierCurveTo(94,106,95,103,95,101);
ctx.bezierCurveTo(95,99,94,96,91,96);
ctx.moveTo(103,96);
ctx.bezierCurveTo(100,96,99,99,99,101);
ctx.bezierCurveTo(99,103,100,106,103,106);
ctx.bezierCurveTo(106,106,107,103,107,101);
ctx.bezierCurveTo(107,99,106,96,103,96);
ctx.fill();

ctx.fillStyle = "black";
ctx.beginPath();
ctx.arc(101,102,2,0,Math.PI*2,true);
ctx.fill();

ctx.beginPath();
ctx.arc(89,102,2,0,Math.PI*2,true);
ctx.fill();

// 封装的一个用于绘制圆角矩形的函数.

function roundedRect(ctx,x,y,width,height,radius){
  ctx.beginPath();
  ctx.moveTo(x,y+radius);
  ctx.lineTo(x,y+height-radius);
  ctx.quadraticCurveTo(x,y+height,x+radius,y+height);
  ctx.lineTo(x+width-radius,y+height);
  ctx.quadraticCurveTo(x+width,y+height,x+width,y+height-radius);
  ctx.lineTo(x+width,y+radius);
  ctx.quadraticCurveTo(x+width,y,x+width-radius,y);
  ctx.lineTo(x+radius,y);
  ctx.quadraticCurveTo(x,y,x,y+radius);
  ctx.stroke();
}

ctx.clearRect(0,0,300,300);

function DrawSector(x,y,radius,startAngel,angle,color){
	ctx.beginPath();
	ctx.arc(x,y,radius,startAngel,angle,false);
	ctx.lineTo(x,y);
	ctx.fillStyle=color;
	ctx.fill();
}
DrawSector(75,75,60,Math.PI*1/2,Math.PI,"#EEB422");
DrawSector(75,75,60,Math.PI,Math.PI*3/2,"#EEAD0E");
DrawSector(75,75,60,0,Math.PI*1/2,"#EEAD0E");
DrawSector(75,75,60,Math.PI*3/2,Math.PI*2,"#EEB422");

ctx.fillStyle = "#FFF";
ctx.globalAlpha = 0.22;
for(var i=0;i<6;i++){
	ctx.beginPath();
	ctx.arc(75,75,10+10*i,0,Math.PI*2,true);
	ctx.fill();
}
ctx.globalAlpha =1;


ctx.clearRect(0,0,300,300);
var sun = new Image();
var moon = new Image();
var earth = new Image();
function init(){
  sun.src = 'https://mdn.mozillademos.org/files/1456/Canvas_sun.png';
  moon.src = 'https://mdn.mozillademos.org/files/1443/Canvas_moon.png';
  earth.src = 'https://mdn.mozillademos.org/files/1429/Canvas_earth.png';
  window.requestAnimationFrame(draw);
}

function draw() {
  var ctx = document.getElementById('canvas').getContext('2d');

  ctx.globalCompositeOperation = 'destination-over';
  ctx.clearRect(0,0,300,300); // clear canvas

  ctx.fillStyle = 'rgba(0,0,0,0.4)';
  ctx.strokeStyle = 'rgba(0,153,255,0.4)';
  ctx.save();
  ctx.translate(150,150);

  // Earth
  var time = new Date();
  ctx.rotate( ((2*Math.PI)/60)*time.getSeconds() + ((2*Math.PI)/60000)*time.getMilliseconds() );
  ctx.translate(105,0);
  ctx.fillRect(0,-12,50,24); // Shadow
  ctx.drawImage(earth,-12,-12);

  // Moon
  ctx.save();
  ctx.rotate( ((2*Math.PI)/6)*time.getSeconds() + ((2*Math.PI)/6000)*time.getMilliseconds() );
  ctx.translate(0,28.5);
  ctx.drawImage(moon,-3.5,-3.5);
  ctx.restore();

  ctx.restore();
  
  ctx.beginPath();
  ctx.arc(150,150,105,0,Math.PI*2,false); // Earth orbit
  ctx.stroke();
 
  ctx.drawImage(sun,0,0,300,300);

  window.requestAnimationFrame(draw);
}

init();