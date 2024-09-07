<?php

include('../header.php');

// echo "<div class='container'>";

if (isset($_POST['nyaa'])) {
$nyaa = htmlspecialchars($_POST["nyaa"]);
$getUsers = mysql_query("SELECT * FROM users WHERE username LIKE '%$nyaa%' ORDER BY visittick DESC");
}else{
$getUsers = mysql_query("SELECT * FROM users ORDER BY visittick DESC");
}

$getUC = mysql_query("SELECT * FROM users");

$gUC = mysql_num_rows($getUC);

$debugthing = mysql_num_rows($getUsers);

?>
<style data-jss="" data-meta="Unthemed">
.textRight-0-2-38 {
  text-align: right;
}
.unknownStatus-0-2-39 {
  color: #494949;
}
.onlineStatus-0-2-40 {
  color: #00bf00;
}
.offlineStatus-0-2-41 {
  color: red;
}
.status-0-2-42 {
  top: -65px;
  height: 0;
  display: block;
  position: relative;
  font-size: 80px;
}
.username-0-2-43 {
  margin-left: 20px;
}
.userRow-0-2-44 {
  color: inherit;
  border-top: 1px solid #c3c3c3;
  padding-top: 20px;
  padding-bottom: 20px;
}
.userRow-0-2-44:hover {
  cursor: pointer;
  background: #e1e1e1;
}
.colorNormal-0-2-45 {
  color: rgb(20,20,20);
}
</style>
<style data-jss="" data-meta="Unthemed">
.column-0-2-27 {
  display: inline-block;
}
.input-0-2-28 {
  width: 100%;
}
.searchButton-0-2-29 {
  font-size: 16px;
  padding-left: 6px;
  padding-right: 6px;
}
body {
background-color: #fff!important;
}
</style>
<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-30 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-30:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-31 {
  width: auto!important;
}
.cancelButton-0-2-32 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-32:hover {
  background: grey!important;
}
.continueButton-0-2-33 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-33:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-34 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-35 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-35:disabled {
  opacity: 0.5;
}
.wrapper-0-2-36 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-37 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-37:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
</style>
<form action="" method="POST">
<div class="row row-0-2-26">
   <div class="col-12">
      <div class="row">
         <div class="col-2 col-lg-1">
            <p class="fw-bold">Search:</p>
         </div>
         <div class="col-8 col-lg-9"><input class="input-0-2-28" type="text" placeholder="Username" name="nyaa" <? if (isset($_POST['nyaa'])) {?>value="<?=$nyaa;?>"<?}?>></div>
         <div class="col-2">
            <div><input type="submit" name="save" value="Search" class="btn-0-2-35 buyButton-0-2-30 normal-0-2-31 searchButton-0-2-29" title="" style="height: 24px; padding-top: 0px; padding-bottom: 28px; position: relative; bottom: 2px;"></div>
         </div>
      </div>
</form>
      <div class="row">
         <div class="col-12">
<p class="mt-4 hideifresults">No results for "<?=$nyaa;?>"</p>
<? while($gU = mysql_fetch_object($getUsers)) {?>
<style>.hideifresults{display:none!important;}</style>
            <div class="userRow-0-2-44">
               <a href="/users/<?=$gU->id;?>/profile">
                  <div class="row">
                     <div class="col-6 col-md-2 col-lg-1">

<iframe frameborder="0" src="/avatar.php?id=<? echo $gU->id ?>" scrolling="no" style=" width: 200px; height: 200px" class="image-0-2-41"></iframe>



</div>
<? // echo "current time: ".$now." | expire time: ".$gU->expiretime; ?>
<? if($now < $gU->expiretime){ $indicator = "status-0-2-42 onlineStatus-0-2-40"; }else{ $indicator = "status-0-2-42 offlineStatus-0-2-41"; } ?>
                     <div class="col-6 col-md-7 col-lg-8">
                        <p style="margin-left: 12rem;"><span class="<?=$indicator;?>">.</span> <span class="username-0-2-43"><?=$gU->username;?></span> </p>
                     <p style="margin-left: 12rem; color: black;"><?=mb_strimwidth(htmlspecialchars($gU->bio), 0, 279, "...");?></p>
</div>
                     <div class="col-12 col-md-3 col-lg-3">
                        <p class="textRight-0-2-38 colorNormal-0-2-45"><?=date("m/d/Y g:i A", $gU->visittick);?></p>
                     </div>
                  </div>
               </a>
            </div>
<?}?>
</div></div></div></div></div>
<? include "../footer.php"; ?>