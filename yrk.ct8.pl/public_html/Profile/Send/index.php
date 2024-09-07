<?php

$id = $_GET['recipientId'];

include($_SERVER['DOCUMENT_ROOT']."/header.php");

$user = $handler->query("SELECT * FROM `users` where `id` ='".$id."'"); 

$gU = $user->fetch(PDO::FETCH_OBJ);

?>

<style data-jss="" data-meta="Unthemed">
.box-0-2-29 {
  border: 1px solid #c3c3c3;
}
.input-0-2-30 {
  width: 100%;
  border: 1px solid #c3c3c3;
  padding: 5px 10px;
  font-size: 16px;
}
.textArea-0-2-31 {
  background: #eaeaea;
}
.sendWrapper-0-2-32 {
  float: right;
  width: 100px;
}
.messagesContainer-0-2-33 {
  background-color: #fff;
}
</style>

<style data-jss="" data-meta="Unthemed">
.header-0-2-55 {
  font-size: 38px;
  font-weight: 400;
  margin-bottom: 0;
}
</style>

<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-24 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-24:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-25 {
  width: auto!important;
}
.cancelButton-0-2-26 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-26:hover {
  background: grey!important;
}
.continueButton-0-2-27 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-27:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-28 {
  margin-top: 70px;
}
</style>

<style data-jss="" data-meta="Unthemed">
.btn-0-2-56 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-56:disabled {
  opacity: 0.5;
}
.wrapper-0-2-57 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-58 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-58:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
body {
  background-color: #ffffff !important;
</style>

<div class="container messagesContainer-0-2-33">
   <div class="row">
      <div class="col-12">
         <h1 class="header-0-2-55">New Message</h1>
         <p class="mb-4"><a href="#" onclick="history.back();return false;">Back</a></p>
      </div>
   </div>
   <div class="row">
      <div class="col-12 mt-4">
        <form action="" method="POST">
         <input class="input-0-2-30" readonly="" value="To: <?=$gU->username;?>"><input maxlength="256" class="input-0-2-30 mt-2" placeholder="Subject:" name="title">
         <textarea maxlength="1000" class="input-0-2-30 mt-2 textArea-0-2-31" rows="8" placeholder="Write your message..." name="post"></textarea>
         <div class="sendWrapper-0-2-32">
            <div><button class="btn-0-2-56 continueButton-0-2-27" title="" style="padding: 5px; margin-top: 5px; padding-top: 3px; padding-bottom: 3px;" name="save">Send</button></div>
         </form>
        </div>
     </div>
   </div>
</div>


<?

if(isset($_POST['save'])){

$hi = $handler->query("INSERT INTO messages (sender, receiver, title, message, date) VALUES ('$myu->id','$id','".$_POST["title"]."','".$_POST["post"]."','".time()."')");

Header("Location: /message/".$handler->lastInsertId()); exit; die();

} include($_SERVER['DOCUMENT_ROOT']."/footer.php");

?>