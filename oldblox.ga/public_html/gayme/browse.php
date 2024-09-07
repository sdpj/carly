<?
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
?>
<style>
#place_item {
    height:125px;
    width:125px;
    -webkit-box-shadow: 0px 0px 7px rgba(50, 50, 50, 0.8);
    -moz-box-shadow:    0px 0px 7px rgba(50, 50, 50, 0.8);
    box-shadow:         0px 0px 7px rgba(50, 50, 50, 0.8);
    background-image:url(http://tekcraft.net16.net/new/gamebg.png);
    background-size:100% 100%;
}
#place_label {
    padding:5px;
    color:#427DB8;
    font-size:16px;
}
#place:hover
{
    -webkit-box-shadow: 0px 0px 11px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 11px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 11px rgba(50, 50, 50, 0.75);
    cursor:pointer
}
#place_launch {
    position:absolute;
    background-color:#FEFEFE;
    height:200px;
    width:400px;
    -webkit-box-shadow: 0px 0px 11px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 11px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 11px rgba(50, 50, 50, 0.75);
}
#close_item {
    height:22px;
    width:22px;
    -webkit-box-shadow: 0px 0px 3px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 3px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 3px rgba(50, 50, 50, 0.75);
    font-size:15px;
    font-weight:bold;
    color:#FCFCFC;
    text-align:center;
    background-color:#E62E00;
    border-radius:3px;
    position:absolute;
    right:0px;
}
#close_item:hover {
    cursor:pointer;
    background-color:#B22400;
}
#place_preview {
    height:150px;
    width:150px;
    -webkit-box-shadow: 0px 0px 7px rgba(50, 50, 50, 0.8);
    -moz-box-shadow:    0px 0px 7px rgba(50, 50, 50, 0.8);
    box-shadow:         0px 0px 7px rgba(50, 50, 50, 0.8);
    background-size:100% 100%;
    margin-left:30px;
}
#place_play
{
    -webkit-box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 4px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 4px rgba(50, 50, 50, 0.75);
    cursor:pointer;
    font-size:18px;
    font-weight:bold;
    color:white;
    width:125px;
    text-align:center;
    padding:5px;
    margin-top:10px;
    border-radius:4px;
background: #7db9e8; /* Old browsers */
background: -moz-linear-gradient(top, #7db9e8 0%, #2989d8 50%, #1e5799 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7db9e8), color-stop(50%,#2989d8), color-stop(100%,#1e5799)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #7db9e8 0%,#2989d8 50%,#1e5799 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #7db9e8 0%,#2989d8 50%,#1e5799 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #7db9e8 0%,#2989d8 50%,#1e5799 100%); /* IE10+ */
background: linear-gradient(to bottom, #7db9e8 0%,#2989d8 50%,#1e5799 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7db9e8', endColorstr='#1e5799',GradientType=0 ); /* IE6-9 */
}
#place_play:hover {
background: #bcd2e2; /* Old browsers */
background: -moz-linear-gradient(top, #bcd2e2 1%, #5d9ed3 51%, #446d99 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,#bcd2e2), color-stop(51%,#5d9ed3), color-stop(100%,#446d99)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #bcd2e2 1%,#5d9ed3 51%,#446d99 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #bcd2e2 1%,#5d9ed3 51%,#446d99 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #bcd2e2 1%,#5d9ed3 51%,#446d99 100%); /* IE10+ */
background: linear-gradient(to bottom, #bcd2e2 1%,#5d9ed3 51%,#446d99 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bcd2e2', endColorstr='#446d99',GradientType=0 ); /* IE6-9 */
}
#game_border {
    -webkit-box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 4px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 4px rgba(50, 50, 50, 0.75);
	background-color:rgb(270,270,270);
border-bottom:1px solid grey;
width:85%;
padding-top:10px;
padding:15px;
}
#game_tab
{
    -webkit-box-shadow: 0px 0px 4px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 4px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 4px rgba(50, 50, 50, 0.75);
	font-size:16px;
	padding:15px;
	font-weight:bold;
	width:100px;
	text-align:center;
	cursor:pointer;
}
#game_tab:hover
{
    -webkit-box-shadow: 0px 0px 10px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 10px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 10px rgba(50, 50, 50, 0.75);
	color:grey;
}
</style>
<div style='padding-top:15px;'>
<div id='ProfileText'>Browse through free user-created games</div>
<div id='game_border'><br />
<span id='game_tab' class='redirect' redirect='?all'>All Places</span>
<span id='game_tab' class='redirect' redirect='?sort=myplaces'>My Places</span>
<span id='game_tab' class='redirect' redirect='?sort=contests'>Contests</span>
<br /><br /><br />
<table>
<tr>
<?
$sort = mysql_real_escape_string(strip_tags(stripslashes($_GET['sort'])));
if(!$sort || $sort != 'myplaces')
{
$get_all_places = mysql_query("SELECT * FROM places ORDER BY id DESC");
}
if($sort == 'myplaces')
{
$get_all_places = mysql_query("SELECT * FROM places WHERE creator='$myU->Username' ORDER BY id DESC");
}
$p_tick = 0;
while($p_item = mysql_fetch_object($get_all_places))
{
$p_tick++;
?>
<td>
    <div id='place_holder'>
        <div id='place_launch' class='p_launch_<?echo$p_tick;?>' style='display:none;'>
            <div id='close_item' onclick='close_launch(<?echo$p_tick;?>)' class='p_close_<?echo$p_tick;?>'>X</div>
            <br />
            <table>
                <tr>
                    <td>
            <div id='place_preview' style='background-image:url(<?echo$p_item->background;?></div>
                    </td>
                    <td style='width:15px;'></td>
                    <td>
                        <div style='position:absolute; top:25px;'>
                        <span id='place_label'><?echo$p_item->name;?></span>
                        <br />
                        <span id='place_label' style='color:black; font-size:14px;'>Creator: <?echo$p_item->creator;?></span>
                        <br />
                        <span id='place_label' style='color:#B20000; font-size:14px;'>Players: 0 / <?echo$p_item->max_players;?></span>
                            <br />
                            <div id='place_play' onclick=(eval(window.location="play.aspx?gameid=<?echo$p_item->id;?>")) class='p_play_<?echo$p_tick;?>'>Play</div>
                        </div>
                    </td>
            </table>
        </div>
    <div id='place' style='width:150px; padding:10px;'>
        <center>
        <div id='place_item' onclick='show_launch(<?echo$p_tick;?>)' class='p_item_<?echo$p_tick;?>'></div>
            <span id='place_label'><?echo$p_item->name;?></span>
        <br />
        <center><span id='place_label' style='color:#B20000; font-size:14px;'>Players: 0 / <?echo$p_item->max_players;?></span></center>
        </center>
    </div>
</div>
</td>
<?
}
?>
</tr>
</table>
<script>
function e_nums(string)
{
    var new_string = '';
 var tick = 0;
while(tick < parseFloat(string.length))
{
    var cur_char = parseFloat(string.substr(tick,tick));
    if(cur_char > -1)
    {
        new_string = new_string+cur_char;
    }
    else
    {
    }
tick++;
}
    return new_string;
}
function show_launch(item_id)
{
$('.p_launch_'+parseFloat(item_id)).show();
}
function close_launch(item_id)
{
$('.p_launch_'+parseFloat(item_id)).hide();
}
</script>
</div>
<?
	include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>