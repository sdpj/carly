<? include "../../header.php"; ?>
<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<div style="padding:10px 0;font-size:14px;color:#666;">
<div class="row" style="margin:0;">
<div class="col s12 m12 l6">
<a href="#" style="color:#323a45;font-weight:600;">Forum</a> » <a href="#" style="color:#323a45;font-weight:600;">BLOX Create</a> » <a href="#" style="color:#323a45;font-weight:600;">General</a>
</div>
<div class="col s12 m12 l6 right-align">
<a href="#" style="color:#323a45;font-weight:600;">My Threads</a>
&nbsp;|&nbsp;&nbsp;<a href="#" style="color:#323a45;font-weight:600;">Search Forum</a>
</div>
</div>
</div>
<div class="light-blue darken-2" style="color:white;padding:15px 25px;">
<div style="font-size:18px;">Testing</div>
</div>
<div class="content-box" style="border-top:0;border-radius:0;">
<div class="row">
<div class="col s3 center-align">
<div title="Last seen 5 days ago" style="background:#c2c2c2;width:10px;height:10px;border-radius:10px;display:inline-block;"></div>
&nbsp;<a href="../../../Profile?id=1">Creator</a>
<a href="../../../Profile?id=1">
<? echo "
<img src='../../../Market/Storage/Creator.png' width='182' height='182'>
"; ?>
</a>
<div class="row" style="padding-top:15px;font-size:14px;margin-bottom:0;">
<div class="col s3">&nbsp;</div>
<div class="col s3 right-align">
<strong>Posts</strong>
</div>
<div class="col s3 left-align">
1
</div>
</div>
<div class="row" style="font-size:14px;margin-bottom:0;">
<div class="col s3">&nbsp;</div>
<div class="col s3 right-align">
<strong>Joined</strong>
</div>
<div class="col s3 left-align">
2017
</div>
</div>
</div>
<div class="col s9"><?php $result = mysql_query("SELECT * FROM threads WHERE threadId=" . $_GET['id']) or die("That thread does not exist.");
            while($row = mysql_fetch_assoc($result)){ ?>
<div class="row" style="margin-bottom:0;">
<div class="col s6">
<div style="font-size:14px;color:#777;padding-bottom:10px;">
<i class="material-icons" style="font-size:14px;">access_time</i>
Posted 2 days ago
</div>
</div>
<div class="col s6 right-align">
<a href="#"><div class="report-abuse" style="float:right;">&nbsp;</div></a>
</div>
</div>
<div style="word-break:break-word;"><?php echo $row['threadBody']; ?></div>
</div>
</div>
</div>
</div><?php } ?>
</div>