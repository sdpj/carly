<?php
$id = $_GET['id'];
$pagename = "$id";
include('../header.php');

if (isset($_POST['status'])) { $status = mysql_real_escape_string($_POST['status']);
$handler->query("UPDATE `users` SET `status`='$status' WHERE `id`='$myu->id'");
Header("Location: /users/".$id."/profile");
}
?>
<style data-jss="" data-meta="Unthemed">
.container-0-2-29 {
  top: 0;
  left: 0;
  z-index: 999;
  position: fixed;
}
.card-0-2-30 {
  width: 175px;
  height: 100vh;
  background: #f2f2f2;
  padding-left: 10px;
  padding-right: 10px;
}
.username-0-2-31 {
  color: #1e1e1f;
  font-size: 18px;
  padding-top: 8px;
  margin-bottom: 0;
  padding-bottom: 5px;
}
.divider-0-2-32 {
  width: 100%;
  height: 2px;
  border-bottom: 2px solid #c3c3c3;
}
.upgradeNowButton-0-2-33 {
  color: white;
  width: 100%;
  font-size: 15px;
  background: #01a2fd;
  margin-top: 10px;
  text-align: center;
  font-weight: 500;
  padding-top: 8px;
  border-radius: 4px;
  padding-bottom: 8px;
}
.upgradeNowButton-0-2-33:hover {
  background: #3ab8ff;
}
</style><style data-jss="" data-meta="Unthemed">
.text-0-2-40 {
  color: white;
  display: inline;
  font-size: 16px;
  margin-top: 2px;
  text-align: right;
  font-weight: 400;
  white-space: nowrap;
  border-bottom: 0;
  margin-bottom: 0;
}
.link-0-2-41 {
  color: white;
  padding: 4px 8px;
  text-decoration: none;
}
.link-0-2-41:hover {
  color: white;
  cursor: pointer;
  background: rgba(25,25,25,0.1);
  border-radius: 4px;
}
.settingsIcon-0-2-42 {
  float: right;
}
.linkContainerCol-0-2-44 {
  float: right;
  max-width: 250px;
}
.robuxText-0-2-45 {
  margin-left: 5px;
  margin-right: 20px;
}
</style><style data-jss="" data-meta="Unthemed">
.col-0-2-10 {
  max-width: 140px;
}
</style><style data-jss="" data-meta="Unthemed">
.container-0-2-12 {
  margin-top: 3px;
  padding-left: 0;
  margin-bottom: 0;
  padding-bottom: 0;
}
.linkEntry-0-2-13 {
  color: white;
  padding: 4px 8px;
  font-size: 16px;
  text-align: center;
  transition: none;
  font-weight: 400;
  margin-bottom: 0;
  padding-bottom: 0;
  text-decoration: none;
}
.linkEntry-0-2-13:hover {
  color: white;
  cursor: pointer;
  background: rgba(25,25,25,0.1);
  transition: none;
  border-radius: 4px;
}
.navItem-0-2-14 {
  padding-right: 2rem;
}
@media(max-width: 1300px) {
  .navItem-0-2-14 {
    padding-right: 1.75rem;
  }
}
@media(max-width: 1250px) {
  .navItem-0-2-14 {
    padding-right: 1.5rem;
  }
}
@media(max-width: 1175px) {
  .navItem-0-2-14 {
    padding-right: 1rem;
  }
}
.col-0-2-15 {
  margin-left: 0;
  padding-left: 0;
}
</style><style data-jss="" data-meta="Unthemed">
.icon-0-2-18 {
  float: right;
  margin-top: -24px;
  padding-top: 0;
}
</style><style data-jss="" data-meta="Unthemed">
.wrapper-0-2-16 {
  width: 100%;
  border: 1px solid #c3c3c3;
  padding: 4px 2px;
  background: white;
  border-radius: 2px;
}
.searchInput-0-2-17 {
  width: 100%;
  border: none;
  padding-top: 0;
  padding-bottom: 0;
}
.searchInput-0-2-17:focus {
  border: none!important;
  box-shadow: none!important;
}
</style><style data-jss="" data-meta="Unthemed">
</style><style data-jss="" data-meta="Unthemed">
.text-0-2-25 {
  color: #B8B8B8;
  font-size: 12px;
  font-weight: 400;
}
.link-0-2-26 {
  font-size: 21px;
  text-align: center;
  font-weight: 300;
  text-decoration: none;
}
.link-0-2-26:hover {
  color: #191919;
}
.footer-0-2-27 {
  background: #ffffff;
}
.footerContainer-0-2-28 {
  padding-top: 5px;
  padding-bottom: 20px;
}
</style><style data-jss="" data-meta="Unthemed">
.main-0-2-23 {
  min-height: 95vh;
}
</style><style data-jss="" data-meta="Unthemed">
.alertBg-0-2-19 {
  background: #F68802;
}
.alertText-0-2-20 {
  color: #fff;
  padding: 12px 0;
  font-size: 18px;
  text-align: center;
  font-weight: bold;
}
.alertLink-0-2-21 {
  color: #fff;
}
.alertLink-0-2-21:hover {
  text-decoration: underline;
}
.fakeAlert-0-2-22 {
  width: 100%;
  height: 40px;
  position: relative;
}
</style><style data-jss="" data-meta="Unthemed">
.image-0-2-57 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 400px;
}
</style><style data-jss="" data-meta="Unthemed">
.adImage-0-2-48 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
}
@media(max-width: 800px) {
  .adImage-0-2-48 {
    padding-top: 10px;
    padding-bottom: 10px;
  }
}
</style><style data-jss="" data-meta="Unthemed">
.image-0-2-46 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 728px;
}
</style><style data-jss="" data-meta="Unthemed">
.image-0-2-79 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 400px;
}
</style><style data-jss="" data-meta="Unthemed">
.header-0-2-65 {
  margin: 0;
  font-size: 26px;
  margin-top: 10px;
  font-weight: 300;
  margin-bottom: 5px;
}
</style><style data-jss="" data-meta="Unthemed">
.avatarImageWrapper-0-2-74 {
  margin: 0 auto;
  display: block;
  max-width: 300px;
}
.assetContainerCard-0-2-75 {
  height: 100%;
  background: #3b7599;
  border-radius: 0;
}
.avatarImageCard-0-2-76 {
  border-radius: 0;
}
.pagination-0-2-77 {
  color: white;
  font-size: 28px;
  text-align: center;
  font-family: serif;
  margin-bottom: 0;
}
.pagination-0-2-77>span {
  cursor: pointer;
}
</style><style data-jss="" data-meta="Unthemed">
.card-0-2-56 {
  background: white;
  box-shadow: 0 1px 4px 0 rgb(25 25 25 / 30%);
  border-radius: 0;
}
</style><style data-jss="" data-meta="Unthemed">
.imageWrapper-0-2-86 {
  border: 1px solid #c3c3c3;
  border-radius: 4px;
}
.image-0-2-87 {
  width: 100%;
  margin: 0 auto;
  display: block;
}
.itemLabel-0-2-88 {
  color: #666;
  overflow: hidden;
  font-size: 16px;
  font-weight: 300;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.buttonWrapper-0-2-89 {
  float: right;
  width: 100px;
  margin-top: 10px;
}
.labelWrapper-0-2-90 {
  width: 100%;
  overflow: hidden;
  margin-top: -27px;
}
.overlayLimited-0-2-91 {
  height: 28px;
  margin-left: -14px;
}
.overlayLimitedUnique-0-2-92 {
  height: 28px;
  margin-left: -14px;
}
</style><style data-jss="" data-meta="Unthemed">
.text-0-2-71 {
  font-size: 10px;
  margin-top: 15px;
  margin-bottom: 0;
}
.text-0-2-71:hover > a {
  color: #F00;
}
.text-0-2-71:hover > span {
  background-image: url("/img/abuse.png");
}
.link-0-2-72 {
  color: #F99;
  padding-left: 2px;
}
.image-0-2-73 {
  float: left;
  width: 14px;
  height: 13px;
  display: block;
}
</style><style data-jss="" data-meta="Unthemed">
.body-0-2-66 {
  padding: 15px 20px;
  font-size: 16px;
  font-weight: 300;
  margin-bottom: 0;
}
.previousNamesLabel-0-2-67 {
  cursor: pointer;
  font-size: 18px;
  user-select: none;
}
.previousNamesToolTip-0-2-69 {
  width: 150px;
  padding: 4px 8px;
  z-index: 99;
  position: absolute;
  background: rgba(0,0,0,0.65);
}
.previousName-0-2-70 {
  color: #fff;
  margin-bottom: 0;
}
</style><style data-jss="" data-meta="Unthemed">
.body-0-2-62 {
  padding: 15px 20px;
  font-size: 16px;
  font-weight: 300;
  white-space: break-spaces;
  margin-bottom: 0;
}
.report-0-2-63 {
  padding-bottom: 40px;
}
.reportWrapper-0-2-64 {
  float: right;
}
</style><style data-jss="" data-meta="Unthemed">
.friendCol-0-2-80 {
  width: 12%;
  min-width: 100px;
  padding-left: 0;
  padding-right: 0;
}
.imageWrapper-0-2-81 {
  border: 1px solid #c3c3c3;
}
.username-0-2-82 {
  color: #666;
  overflow: hidden;
  font-size: 16px;
  font-weight: 300;
  margin-bottom: 0;
  text-overflow: ellipsis;
}
.cardWrapper-0-2-83 {
  margin: 0 auto;
  padding-left: 8px;
  padding-right: 8px;
}
.buttonWrapper-0-2-84 {
  float: right;
  width: 100px;
  margin-top: 10px;
}
.sideRow-0-2-85 {
  overflow: auto;
  flex-flow: row;
}
</style><style data-jss="" data-meta="Unthemed">
.buttonsGroup-0-2-93 {
  padding-top: 10px;
}
.buttonInUse-0-2-94 {
  padding-top: 0;
  padding-bottom: 0;
}
.buttonNotInUse-0-2-95 {
  border: 1px solid #c3c3c3;
  background: white !important;
  padding-top: 0;
  padding-bottom: 0;
}
</style><style data-jss="" data-meta="Unthemed">
.wrapper-0-2-103 {
  cursor: pointer;
  margin-top: -20px;
  user-select: none;
}
.dropdown-0-2-104 {
  right: -20px;
  width: 125px;
  position: absolute;
  background: white;
  border-radius: 2px;
}
.dropdownEntry-0-2-105 {
  width: 100%;
}
.dropdownEntry-0-2-105:hover {
  background: #e3e3e3;
}
.dropdownText-0-2-106 {
  color: rgb(33, 37, 41);
  padding: 8px 10px;
  font-size: 16px;
  margin-bottom: 0;
}
.dropdownDots-0-2-107 {
  font-weight: 100;
  letter-spacing: 3px;
}
</style><style data-jss="" data-meta="Unthemed">
.statHeader-0-2-58 {
  color: #c3c3c3;
  font-size: 18px;
  text-align: center;
  font-weight: 400;
  margin-bottom: 0;
}
.statValue-0-2-59 {
  font-size: 20px;
  text-align: center;
  font-weight: 300;
  margin-bottom: 0;
}
.statValue-0-2-59> a {
  color: #00A2FF;
}
.statValue-0-2-59> a:hover {
  text-decoration: underline!important;
}
</style><style data-jss="" data-meta="Unthemed">
.iconWrapper-0-2-49 {
  border: 1px solid #B8B8B8;
  margin: 0 auto;
  max-width: 110px;
}
.username-0-2-50 {
  font-size: 30px;
  font-weight: 400;
}
.userStatus-0-2-51 {
  font-size: 16px;
  font-weight: 300;
}
.dropdown-0-2-52 {
  float: right;
}
.updateStatusInput-0-2-53 {
  width: calc(100% - 140px);
  border: 1px solid #c3c3c3;
  border-radius: 4px;
}
@media(max-width: 992px) {
  .updateStatusInput-0-2-53 {
    width: 100%;
  }
}
.updateStatusButton-0-2-54 {
  cursor: pointer;
  font-size: 12px;
  margin-top: 2px;
}
.activityWrapper-0-2-55 {
  float: right;
  position: relative;
  margin-top: -18px;
  margin-right: -10px;
}
</style><style data-jss="" data-meta="Unthemed">
.label-0-2-97 {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.imageWrapper-0-2-98 {
  width: 100%;
  border: 1px solid #b8b8b8;
  height: auto;
  overflow: hidden;
  min-width: 142px;
  border-radius: 4px;
}
.buttonWrapper-0-2-99 {
  float: right;
  width: 100px;
}
.badgeLink-0-2-100 {
  color: inherit;
}
</style><style data-jss="" data-meta="Unthemed">
.label-0-2-101 {
  color: #B8B8B8;
  overflow: hidden;
  font-size: 16px;
  text-align: center;
  font-weight: 400;
  white-space: nowrap;
  margin-bottom: 0;
}
.value-0-2-102 {
  font-size: 18px;
  margin-top: 5px;
  text-align: center;
}
</style><style data-jss="" data-meta="Unthemed">
.entry-0-2-60 {
  cursor: pointer;
  font-size: 18px;
  text-align: center;
  padding-top: 8px;
  margin-bottom: 0;
  padding-bottom: 8px;
}
.entry-0-2-60:hover {
  box-shadow: 0 -4px 0 0 #00a2ff inset;
}
.entryActive-0-2-61 {
  box-shadow: 0 -4px 0 0 #00a2ff inset;
}
</style><style data-jss="" data-meta="Unthemed">

</style><style data-jss="" data-meta="Unthemed">
.buttonWrapper-0-2-96 {
  float: right;
  width: 100px;
  margin-top: 10px;
}
</style><style data-jss="" data-meta="Unthemed">
.profileContainer-0-2-24 {
  background: #e3e3e3;
}


.mainthing {
    flex: 0 0 auto;
    width: 100% !important;
}
</style>
<?php
if (!$id) {
echo "error";
} else {
$getUser = $handler->query("SELECT * FROM users WHERE id='".$id."'");
$gU = $getUser->fetch(PDO::FETCH_OBJ);
$id = $gU->id;
$username = htmlspecialchars($gU->username);
$userExist = ($getUser->rowCount());
if ($userExist == "0") {
header("Location: /");
}}
?>
<form action="" method="POST" style="display: unset!important; margin-top: unset!important; margin-block-end: unset!important;">
<div class="container">
   <div class="row">
      <div class="col-12">
         <div style="width: 100%; height: 90px;"></div>
      </div>
   </div>
   <div class="profileContainer-0-2-24">
      <div class="row mt-2">
         <div class="col-12">
            <div class="card card-0-2-56">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12 col-lg-2 pe-0">
                        <div class="iconWrapper-0-2-49"></div></div>
                     <div class="col-12 col-lg-10 ps-0">
                        <h2 class="username-0-2-50">
                           <?=$username;?>  
                           <div class="dropdown-0-2-52">
                              <div class="wrapper-0-2-103">
                                 <p class="mb-0 dropdownDots-0-2-107">...</p>
                              </div>
                           </div>
                        </h2>
<?php if($gU->status == ""){?><style>.statusinput{border:0px!important;}</style><?}?>
                        <p class="userStatus-0-2-51"><? if($gU->id != $myu->id){?><?if($gU->status){?>"<?=htmlspecialchars($gU->status);?>"<?}?><?}else{?><input value="<?=htmlspecialchars($gU->status);?>" placeholder="What's on your mind?" style="width:49%;border:1px solid #b8b8b8;" class="statusinput" name="status"><?}?></p>
                        <div class="row">
                           <div class="col-12 col-lg-2">
                              <p class="statHeader-0-2-58">Friends</p>
                              <p class="statValue-0-2-59"><a href="/users/42/friends#!friends">0</a></p>
                           </div>
                           <div class="col-12 col-lg-2">
                              <p class="statHeader-0-2-58">Followers</p>
                              <p class="statValue-0-2-59"><a href="/users/42/friends#!followers">0</a></p>
                           </div>
                           <div class="col-12 col-lg-2">
                              <p class="statHeader-0-2-58">Following</p>
                              <p class="statValue-0-2-59"><a href="/users/42/friends#!followings">0</a></p>
                           </div>

<style data-jss="" data-meta="Unthemed">
.btn-0-2-60 {
  width: 100%;
  border: 1px solid #B8B8B8;
  font-size: 18px;
  background: white;
  text-align: center;
  padding-top: 6px;
  border-radius: 2px;
  padding-bottom: 6px;
}
.btn-0-2-60:hover {
  box-shadow: 0 1px 3px rgb(150 150 150 / 74%);
}
</style>
<style data-jss="" data-meta="Unthemed">
.buttonsGroup-0-2-94 {
  padding-top: 10px;
}
.buttonInUse-0-2-95 {
  padding-top: 0;
  padding-bottom: 0;
}
.buttonNotInUse-0-2-96 {
  border: 1px solid #c3c3c3;
  background: white !important;
  padding-top: 0;
  padding-bottom: 0;
}
</style>
<style data-jss="" data-meta="Unthemed">
.button-0-2-109 {
  color: white;
  text-align: center;
}
.buttonWrapper-0-2-110 {
  color: white;
  width: 100%;
  padding: 5px 10px;
  background: #00A2FF;
  text-align: center;
  border-radius: 4px;
}
.buttonWrapper-0-2-110:hover {
  background: #32B5FF;
  box-shadow: 0 1px 3px rgb(150 150 150 / 74%);
}
</style>
<style data-jss="" data-meta="Unthemed">
.header-0-2-66 {
  margin: 0;
  font-size: 26px;
  margin-top: 10px;
  font-weight: 300;
  margin-bottom: 5px;
}
</style>

<? if($gU->id != $myu->id){?>
                          <div class="col-6 col-lg-2 offset-lg-2 pe-1">
                              <button class="btn-0-2-60">
                              <a class="text-dark" href="/messages/compose?recipientId=<?=$gU->id;?>">Message</a>
                              </button>
                          </div>

                          <div class="col-6 col-lg-2 ps-1">
                              <button class="btn-0-2-60">
                              <a class="text-dark" href="#">Add Friend</a>
                              </button>
                          </div>
<?}?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-12">
            <div class="card-0-2-56">
               <div class="row">
                  <div class="col-6 pe-0">
                     <p class="entry-0-2-60 entryActive-0-2-61">About</p>
                  </div>
                  <div class="col-6 ps-0">
                     <p class="entry-0-2-60 ">Creations</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <h3 class="header-0-2-65">About</h3>
            <div class="card-0-2-56"><!-- -->
               <p class="body-0-2-62"><?=htmlspecialchars($gU->bio);?></p>
               <div class="divider-top me-4 ms-4"></div>
               <div class="row">
                  <div class="col-6"></div>
                  <div class="col-6">
                     <div class="report-0-2-63 me-4">
                        <div class="reportWrapper-0-2-64">
                           <p class="text-0-2-71"><span class="image-0-2-73"></span><a class="link-0-2-72" href="/abusereport/UserProfile?id=42&amp;RedirectUrl=https%3A%2F%2Fes.syn.wtf%2Fusers%2F42%2Fprofile">Report Abuse</a></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <h3 class="header-0-2-65">Currently Wearing</h3>
         </div>
         <div class="col-12 col-lg-6 pe-0">
            <div class="card avatarImageCard-0-2-76">
               <div class="avatarImageWrapper-0-2-74"><iframe frameborder="0" src="/avatar.php?id=<? echo $id ?>" scrolling="no" style="overflow: hidden; width: 200px; height: 200px"></iframe></div>
            </div>
         </div>
         <div class="col-12 col-lg-6 ps-0">
            <div class="card assetContainerCard-0-2-75">
               <!--<div class="row ps-4 pe-4 pt-4 pb-4"></div>
               <div class="row">
                  <div class="colggggggggg-12">-->

<div class="row" style="margin-left:5px;">

<? // WEARING ITEMS ?>
   
<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->hat."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->hat."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->body."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->body."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->hair."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->hair."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->shirt."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->shirt."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->pants."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->pants."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->face."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->face."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$gU->tshirt."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$gU->tshirt."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
   <div class="col-3 pt-2 ps-1 pe-1">
      <div class="card" title="<?=htmlspecialchars($gI->name);?>"><a title="<?=htmlspecialchars($gI->name);?>" href="/Market/Items/?id=<?=htmlspecialchars($gI->id);?>"><img class="image-0-2-135 pt-0" src="<?=htmlspecialchars($gI->image);?>" style="width:100px;"></a></div>
   </div>
<?}?>


</div>




               </div>
            </div>
         </div>
      </div>

<?$getinv = $handler->query("SELECT * FROM groupmembers WHERE userid=" . $id);
if($getinv->rowCount() > 0) {
?>

<!-- begin groups section -->

<style data-jss="" data-meta="Unthemed">
.groupImage-0-2-140 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
}
.name-0-2-141 {
  color: #757575;
  overflow: hidden;
  font-size: 16px;
  font-weight: 300;
  white-space: nowrap;
  margin-bottom: 0;
  text-overflow: ellipsis;
}
.memberCount-0-2-142 {
  color: #757575;
  overflow: hidden;
  font-size: 12px;
  margin-top: 2px;
  font-weight: 400;
  white-space: nowrap;
  margin-bottom: 0;
  text-overflow: ellipsis;
}
</style>


<div class="row">
   <div class="col-6">
      <h3 class="header-0-2-66">Groups</h3>
   </div>
   <div class="col-3 col-lg-1 offset-lg-4 pe-1 buttonsGroup-0-2-94">
      <a class="button-0-2-109">
         <div class="buttonWrapper-0-2-110 buttonNotInUse-0-2-96"><span class="container-buttons"><span class="icon-slideshow"></span></span></div>
      </a>
   </div>
   <div class="col-3 col-lg-1 ps-1 buttonsGroup-0-2-94">
      <a class="button-0-2-109">
         <div class="buttonWrapper-0-2-110 buttonInUse-0-2-95"><span class="container-buttons"><span class="icon-grid"></span></span></div>
      </a>
   </div>
   <div class="col-12">
      <div class="row ps-3 pe-3">

<?
while($gIN = $getinv->fetch(PDO::FETCH_OBJ)){ 
$item = $handler->query("SELECT * FROM `groups` WHERE id=" . $gIN->groupid); 
$gI = $item->fetch(PDO::FETCH_OBJ);
$getGroupM = $handler->query("SELECT * FROM groupmembers WHERE groupid='$gIN->groupid'");
?>
         <div class="col-6 col-lg-2 pe-0 ps-0">
            <a href="/Groups/Club/?id=<?=htmlspecialchars($gI->id);?>">
               <div class="card pt-1 pb-1 pe-1 ps-1">
                  <img class="groupImage-0-2-140" src="<?=htmlspecialchars($gI->image);?>" style="height: 148px; width: 148px;">
                  <div class="pe-1 ps-1">
                     <p class="name-0-2-141"><?=htmlspecialchars($gI->title);?></p>
                     <p class="memberCount-0-2-142"><?=$getGroupM->rowCount();?> Members</p>
                     <p class="memberCount-0-2-142">Role Not Available</p>
                  </div>
               </div>
            </a>
         </div>
<?}?>


      </div>
   </div>
</div>
<?}?>


<?php

   $posterthreadssql = $handler->query("SELECT * FROM threads WHERE threadAdmin='$gU->id'");
   $posterthreads = $posterthreadssql->fetch(PDO::FETCH_OBJ);
   
   $posterrepliessql = $handler->query("SELECT * FROM replies WHERE postBy='$gU->id'"); 
   $posterreplies = $posterrepliessql->fetch(PDO::FETCH_OBJ);
   
   $totalposts = $posterthreadssql->rowCount() + $posterrepliessql->rowCount();

?>

      <div class="row">
         <div class="col-12">
            <h3 class="header-0-2-65">Statistics</h3>
         </div>
         <div class="col-12">
            <div class="card-0-2-56">
               <div class="row pt-4 pb-2">
                  <div class="col-4">
                     <p class="label-0-2-101">Join Date</p>
                     <p class="value-0-2-102"><?=date("m/d/Y", $gU->datecreated);?></p>
                  </div>
                  <div class="col-4">
                     <p class="label-0-2-101">Place Visits</p>
                     <p class="value-0-2-102">0</p>
                  </div>
                  <div class="col-4">
                     <p class="label-0-2-101">Forum Posts</p>
                     <p class="value-0-2-102"><?=$totalposts;?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</form>
<?php include("../footer.php"); ?>