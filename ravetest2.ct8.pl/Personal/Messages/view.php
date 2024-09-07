<? include "../../header.php";
$id = $_GET['id'];
if($myu->admin != "true"){
$getGroup = $handler->query("SELECT * FROM messages WHERE id = '".$id."'"); // $getGroup = $handler->query("SELECT * FROM messages where receiver=" . $myu->id . " OR sender=" . $myu->id . " AND id = ".$id.""); 
}else{
$getGroup = $handler->query("SELECT * FROM messages WHERE id = '".$id."'");
}

$gG = $getGroup->fetch(PDO::FETCH_OBJ);
$user = $handler->query("SELECT * FROM `users` where `id` ='".$gG->sender."'"); 
$gU = $user->fetch(PDO::FETCH_OBJ);

if($myu->id == $gG->receiver OR $myu->id == $gG->sender){
if($myu->id == $gG->receiver){
if($gG->unread == "1"){
$handler->query("UPDATE messages SET unread = '0' WHERE id = '".$id."'");
Header("Location: /message/".$id);
}
}
}else{
if($myu->admin != "true"){
die("this isnt one you can see :skull:");
}
}

?>
<style data-jss="" data-meta="Unthemed">
.username-0-2-159 {
  font-weight: 700;
  margin-bottom: 0;
}
.created-0-2-160 {
  color: #969696;
  font-weight: 500;
  margin-bottom: 0;
}
.subject-0-2-161 {
  font-weight: 400;
}
.subjectBodyParagraph-0-2-162 {
  margin-bottom: 0;
}
.body-0-2-163 {
  white-space: break-spaces;
}
.backButtonWrapper-0-2-164 {
  float: left;
  width: 80px;
}
.replyButtonWrapper-0-2-165 {
  float: left;
  width: 110px;
  margin-left: 10px;
}
.replyText-0-2-167 {
  width: 100%;
  border: 1px solid #666;
  padding: 8px 10px;
  background: #eaeaea;
}
.replyWrapper-0-2-168 {
  float: right;
  width: 170px;
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
body {
  background-color: #fff!important;
}
</style>
<style data-jss="" data-meta="Unthemed">
.username-0-2-85 {
  color: #828282 !important;
  font-weight: 700;
  margin-bottom: 0;
}
.created-0-2-86 {
  color: #969696;
  font-weight: 500;
  margin-bottom: 0;
}
.subject-0-2-87 {
  color: #000;
  font-weight: 400;
}
.subjectBodyParagraph-0-2-88 {
  margin-bottom: 0;
}
.body-0-2-89 {
  color: #000;
  white-space: break-spaces;
}
.backButtonWrapper-0-2-90 {
  float: left;
  width: 80px;
}
.replyButtonWrapper-0-2-91 {
  float: left;
  width: 110px;
  margin-left: 10px;
}
.replyText-0-2-93 {
  width: 100%;
  border: 1px solid #666;
  padding: 8px 10px;
  background: #eaeaea;
}
.replyWrapper-0-2-94 {
  float: right;
  width: 170px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-62 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-62:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-63 {
  width: auto!important;
}
.cancelButton-0-2-64 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-64:hover {
  background: grey!important;
}
.continueButton-0-2-65 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-65:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-66 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-67 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-67:disabled {
  opacity: 0.5;
}
.wrapper-0-2-68 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-69 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-69:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
</style>
<style data-jss="" data-meta="Unthemed">
.username-0-2-95 {
  color: #828282 !important;
  font-weight: 700;
  margin-bottom: 0;
}
.created-0-2-96 {
  color: #969696;
  font-weight: 500;
  margin-bottom: 0;
}
.subject-0-2-97 {
  color: #000;
  font-weight: 400;
}
.subjectBodyParagraph-0-2-98 {
  margin-bottom: 0;
}
.body-0-2-99 {
  color: #000;
  white-space: break-spaces;
}
.backButtonWrapper-0-2-100 {
  float: left;
  width: 80px;
}
.replyButtonWrapper-0-2-101 {
  float: left;
  width: 110px;
  margin-left: 10px;
}
.replyText-0-2-103 {
  width: 100%;
  border: 1px solid #666;
  padding: 8px 10px;
  background: #eaeaea;
}
.replyWrapper-0-2-104 {
  float: right;
  width: 170px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-72 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-72:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-73 {
  width: auto!important;
}
.cancelButton-0-2-74 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-74:hover {
  background: grey!important;
}
.continueButton-0-2-75 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-75:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-76 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-77 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-77:disabled {
  opacity: 0.5;
}
.wrapper-0-2-78 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-79 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-79:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
</style>

<div class="messagesContainer-0-2-131">
   <div class="row mt-2">
      <div class="col-12">
         <div class="row pt-2">
            <div class="col-12">
               <div class="backButtonWrapper-0-2-164">
                  <div><a href="/My/Messages/" style="color:white!important;"><button class="btn-0-2-35 cancelButton-0-2-32" title="">Back</button></a></div>
               </div>
<div class="replyButtonWrapper-0-2-91"><div><form action="" method="POST"><button class="btn-0-2-67 continueButton-0-2-65" title="" style="padding:5px;" name="replyButton"></form>Reply</button></div></div>
            </div>
            <div class="col-12">
               <h2 class="subject-0-2-161"><?=htmlspecialchars($gG->title);?></h2>
            </div>
            <div class="col-1 pe-0"><img class="image-0-2-67" src="https://media.discordapp.net/attachments/345988575143395328/1054550595337453698/bc1eedb52be3b4b94b11e77b2e2b6f1279028be02072f5ec24408157b23fdd6a_thumbnail.png" width="69px"></div>
            <div class="col-10">
               <p class="username-0-2-159"><a class="normal" href="/Profile/?id=<?=$gU->id;?>"><?=$gU->username;?></a></p>
               <p class="created-0-2-160"><?=date("M j, Y | g:i A", $gG->date);?></p>
            </div>
            <div class="col-12">
               <p class="body-0-2-163 mt-2"><?=htmlspecialchars($gG->message);?></p>
            </div>

<?
if(isset($_POST['save'])){
$append = "


------------------------------
On ".date("m/d/Y", $gG->date)." at ".date("g:i A", $gG->date).", ".$gU->username." wrote:
".$gG->message."";
$handler->query("INSERT INTO messages (sender, receiver, title, message, date) VALUES ('$myu->id','$gU->id','RE: ".$gG->title."','".$_POST["post"].$append."','".time()."')");
Header("Location: /Personal/Messages/view.php?id=".$handler->lastInsertId()); exit; die();
}
?>


<?
if(isset($_POST['replyButton'])){
?>
<div class="col-12">
   <form action="" method="POST">
    <textarea maxlength="1000" class="replyText-0-2-103" rows="8" placeholder="Reply here..." name="post"></textarea>
       <div class="replyWrapper-0-2-104">
      <div><button class="btn-0-2-77 continueButton-0-2-75" title="" style="padding: 5px; margin-top: 5px; padding-top: 3px; padding-bottom: 3px;" name="save">Send Reply</button></div>
    </form>
   </div>
</div>
<?}?>


         </div>
      </div>
   </div>
</div>

<? include "../../footer.php"; ?>