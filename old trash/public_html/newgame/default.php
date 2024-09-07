
<link rel="stylesheet" href="http://avatar-gamer.ga/style.css">
<script type='text/javascript'>
function moveuser() {
var y = $("1").offset().top;
var x = $("1").offset().top;
document.getElementById("u1").innerHTML = 'ddd';
document.getElementById("u2").innerHTML = 'ddd';
var boundary1_y = 347;
var boundary2_y = 550;
var boundary1_x = -10;
var boundary2_x = 1090;
interval = 5;
if (window.event) keycode = window.event.keyCode;
if (keycode==87) {
if(y>boundary1_y) y = y - interval;
  $('1').offset().marginTop = y+'px';
}
if (keycode==65) {
if(x>boundary1_x) x = x - interval;
  $('1').offset().marginLeft = x+'px';
}
if (keycode==83) {
if(y<boundary2_y) y = y + interval;
  $('1').offset().marginTop = y+'px';
}
if (keycode==68) {
if(x<boundary2_x) x = x+ interval;
  $('1').offset().marginLeft = x+'px';
}
}
</script>
<body onkeydown='moveuser()'>
<div id='world' style='margin:0 auto; margin-top:30px; background-image:url(/newgame/buildbg.png); border:2px solid black; height:550px; width:1100px;'>
<div id='clickevents' style='height:550px; width:1100px; border:1px solid grey; position:absolute;'></div>
<div id='user_<?echo$myU->ingamenum;?>' style='height:100px; width:100px; background-image:url(/newgame/soldier.png); position:absolute; margin-top:347px;'></div>
</div>
<br />
<div id='u1'></div>
<br />
<div id='u2'></div>

</body>