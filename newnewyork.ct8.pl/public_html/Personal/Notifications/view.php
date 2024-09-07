<? include "../../header.php"; 
$getGroup = $handler->query("SELECT * FROM messages where receiver=" . $myu->id); ?>
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

<div class="messagesContainer-0-2-131">
   <div class="row mt-2">
      <div class="col-12">
         <div class="row pt-2">
            <div class="col-12">
               <div class="backButtonWrapper-0-2-164">
                  <div><a href="/My/Notifications/" style="color:white!important;"><button class="btn-0-2-35 cancelButton-0-2-32" title="">Back</button></a></div>
               </div>
            </div>
            <div class="col-12">
               <h2 class="subject-0-2-161">Welcome To <?=$sitename;?>!</h2>
            </div>
            <div class="col-1 pe-0"><img class="image-0-2-67" src="https://media.discordapp.net/attachments/345988575143395328/1054550595337453698/bc1eedb52be3b4b94b11e77b2e2b6f1279028be02072f5ec24408157b23fdd6a_thumbnail.png" width="69px"></div>
            <div class="col-10">
               <p class="username-0-2-159"><a class="normal" href="#"><?=$sitename;?></a></p>
               <p class="created-0-2-160">Jan 1, 2000 | 00:00 AM</p>
            </div>
            <div class="col-12">
               <p class="body-0-2-163 mt-2">Hello there, <?=$myu->username;?>!

Welcome to <?=$sitename;?>, we're glad to have you here. We hope you have a wonderful time, but to make sure you can make the most here, we ask that you brush up on a few of our guidelines.

Here are some basic rules to get you settled in with the crowd! If you're unsure about anything then you can always take a look at our Terms of Service, which will always be situated at the footer of each page!

Thanks for stopping by,
<?=$sitename;?></p>
            </div>
         </div>
      </div>
   </div>
</div>

<? include "../../footer.php"; ?>