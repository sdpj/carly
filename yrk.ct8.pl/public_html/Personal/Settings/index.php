<? include "../../header.php"; ?>
<?
if (isset($_POST['email'])) { $email = mysql_real_escape_string($_POST['email']);
$handler->query("UPDATE `users` SET `email`='$email' WHERE `id`='$myu->id'");
Header("Location: /Personal/Settings/");
}

if (isset($_POST['bio'])) { $bio = mysql_real_escape_string($_POST['bio']);
$handler->query("UPDATE `users` SET `bio`='$bio' WHERE `id`='$myu->id'");
Header("Location: /Personal/Settings/");
}
?>
<style data-jss="" data-meta="Unthemed">
.entry-0-2-48 {
  cursor: pointer;
  font-size: 18px;
  text-align: center;
  padding-top: 8px;
  margin-bottom: 0;
  padding-bottom: 8px;
}
.entry-0-2-48:hover {
  box-shadow: 0 -4px 0 0 #00a2ff inset;
}
.entryActive-0-2-49 {
  box-shadow: 0 -4px 0 0 #00a2ff inset;
}
</style>
<style data-jss="" data-meta="Unthemed">
.card-0-2-47 {
  background: white;
  box-shadow: 0 1px 4px 0 rgb(25 25 25 / 30%);
  border-radius: 0;
}
</style>
<style data-jss="" data-meta="Unthemed">
.editButton-0-2-60 {
  color: #666;
  float: right;
  cursor: pointer;
}
</style>
<style data-jss="" data-meta="Unthemed">
.text-0-2-59 {
  font-weight: 200;
  margin-bottom: 4px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.accountInfoLabel-0-2-50 {
  color: #c3c3c3;
  font-size: 15px;
  margin-bottom: 6px;
}
.accountInfoValue-0-2-51 {
  color: #666;
}
.descInput-0-2-52 {
  width: 100%;
  border: 1px solid #c3c3c3;
  padding: 6px 8px;
  border-radius: 4px;
}
.select-0-2-53 {
  font-size: 16px;
  border-radius: 2px;
}
.disabled-0-2-54 {
  color: #c3c3c3;
  background: white!important;
}
.disabled-0-2-54:focus {
  color: #c3c3c3;
  box-shadow: none;
}
.fakeInput-0-2-55 {
  height: 100%;
  overflow: hidden;
}
.saveButtonWrapper-0-2-56 {
  float: right;
  margin-top: 16px;
}
.saveButton-0-2-57 {
  border: 1px solid #c3c3c3;
  cursor: pointer;
  padding: 4px 8px;
  font-size: 16px;
  background: white;
  border-radius: 4px;
}
.genderUnselected-0-2-58 {
  color: #c3c3c3;
  cursor: pointer;
}
</style>
<div class="row pb-2 settingsRow-0-2-24">
   <div class="col-12">
      <h1 class="mt-0 mb-0">My Settings</h1>
   </div>
   <div class="col-12">
      <div class="row mt-4">
         <div class="col-12">
            <div class="card-0-2-47">
               <div class="row row-0-2-46">
                  <div class="col ps-0 pe-0">
                     <p class="entry-0-2-48 entryActive-0-2-49">Account Info</p>
                  </div>
                  <div class="col ps-0 pe-0">
                     <p class="entry-0-2-48 ">Security</p>
                  </div>
                  <div class="col ps-0 pe-0">
                     <p class="entry-0-2-48 ">Social</p>
                  </div>
                  <div class="col ps-0 pe-0">
                     <p class="entry-0-2-48 ">Privacy</p>
                  </div>
                  <div class="col ps-0 pe-0">
                     <p class="entry-0-2-48 ">Billing</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="row">
         <div class="col-12 mt-2">
            <h3 class="text-0-2-59">Account Info</h3>
<form action="" method="POST">
            <div class="card-0-2-47 p-3">
               <p class="accountInfoLabel-0-2-50">Username: <span class="accountInfoValue-0-2-51"><input class="form-control select-0-2-53 disabled-0-2-54" readonly="" type="text" value="<?=$myu->username;?>" style="width: 87%; display: inline-block;"></span></p>
               <p class="accountInfoLabel-0-2-50">Password: <span class="accountInfoValue-0-2-51"><input class="form-control select-0-2-53 disabled-0-2-54" readonly="" type="text" value="********" style="width: 87%; display: inline-block; margin-left: 4px;"></span></p>
               <p class="accountInfoLabel-0-2-50">Email: <span class="accountInfoValue-0-2-51"><input class="form-control select-0-2-53" type="text" value="<?=htmlspecialchars($myu->email);?>" style="width: 87%; display: inline-block; margin-left: 29px;" name="email"></span></p>
            </div>
         </div>
         <div class="col-12 mt-2">
            <h3 class="text-0-2-59">Personal</h3>
            <div class="card-0-2-47 p-3">
               <textarea class="descInput-0-2-52" rows="3" name="bio"><?=htmlspecialchars($myu->bio);?></textarea>
               <p class="mb-0 font-size-12">Do not provide any details that can be used to identify you outside <?=$sitename;?>.</p>
               <div class="mt-1">          
               <div class="mt-1 mb-4">
                  <div class="saveButtonWrapper-0-2-56"><button class="saveButton-0-2-57">Save</button></div>
               </div>
               <div class="mt-4 mb-4">&emsp;</div>
            </div>
         </div>
         
         </div>
      </div>
   </div>
</div>

</form>

<? include "../../footer.php"; ?>