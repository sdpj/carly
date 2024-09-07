<? include "../../header.php"; 
$getGroup = $handler->query("SELECT * FROM messages where receiver=" . $myu->id); ?>
<style data-jss="" data-meta="Unthemed">
.username-0-2-79 {
  color: #828282;
  font-weight: 700;
  margin-bottom: 0;
}
.subject-0-2-80 {
  color: #828282;
  font-weight: 700;
}
.subjectUnread-0-2-81 {
  color: #000;
}
.subjectBodyParagraph-0-2-82 {
  overflow: hidden;
  white-space: nowrap;
  margin-bottom: 0;
  text-overflow: ellipsis;
}
.body-0-2-83 {
  color: #969696;
  font-weight: 500;
}
.messageRow-0-2-84 {
  cursor: pointer;
}
.userImage-0-2-85 {
  display: inline-block;
  position: relative;
  max-width: 100%;
  margin-top: -15px;
  padding-left: 15px;
}
.markRead-0-2-86 {
  cursor: pointer;
  z-index: 99;
}
.markReadWrapper-0-2-87 {
  top: 20px;
  width: 10px;
  display: inline-block;
  z-index: 99;
  position: relative;
}
.userCheckAndImage-0-2-88 {
  width: 65px;
  display: inline-block;
}
.subjectAndContent-0-2-89 {
  width: calc(100% - 65px);
  display: inline-block;
  vertical-align: super;
}
</style>
<style data-jss="" data-meta="Unthemed">
.vTab-0-2-63 {
  cursor: pointer;
  display: inline-block;
  border-top: 1px solid #9e9e9e;
  border-left: 1px solid #9e9e9e;
  border-right: 1px solid #9e9e9e;
  margin-right: 4px;
}
.vTabLabel-0-2-64 {
  padding: 10px 5px 8px 5px;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}
.buttonCol-0-2-66 {
  border-bottom: 2px solid #c3c3c3;
}
.btnBottomSeperator-0-2-67 {
  width: 100%;
  height: 5px;
  background: white;
  margin-bottom: -5px;
}
.vTabUnselected-0-2-68 {
  background: #d6d6d6;
  padding-top: 7px;
}
.vTabUnselected-0-2-68:hover {
  background: #e8e8e8;
}
.count-0-2-69 {
  border: 1px solid #84a5c9;
  background: #e0f1fc;
  padding-left: 4px;
  padding-right: 4px;
}
body {
  background-color: #fff!important;
}
</style>
<style data-jss="" data-meta="Unthemed">
.button-0-2-77 {
  color: #777777;
  border: 1px solid #777777;
  margin: 0 auto;
  display: block;
  font-size: 15px;
  background: linear-gradient(0deg, rgba(224,224,224,1) 0%, rgba(255,255,255,1) 100%);
}
.button-0-2-77:hover {
  background: linear-gradient(0deg, rgba(203,216,255,1) 0%, rgba(255,255,255,1) 100%);
}
.col-0-2-78 {
  padding-left: 0;
  padding-right: 0;
}
</style>

<div class="messagesContainer-0-2-59">
   <div class="row mt-2">
      <div class="col-12">
         <div class="row">
            <div class="buttonCol-0-2-66 col-12">
<a href="/My/Messages/" style="color: var(--bs-body-color)!important;">
               <div class="vTab-0-2-63 vTabUnselected-0-2-68" style="padding-top: 0px;">
                  <p class=" vTabLabel-0-2-64" style="padding-top: 8px;">Messages </p>
                  <div class="btnBottomSeperator-0-2-67"></div>
               </div>
</a>
               <div class="vTab-0-2-63">
                  <p class="vTab-0-2-68 vTabLabel-0-2-64">Notifications <span class="count-0-2-69">1</span></p>
               </div>
            </div>
            <div class="col-12">
               <div class="row">
                  <div class="col-12 col-lg-6 mt-2"></div>
                  <div class="col-12 col-lg-6">
                     <div class="row">
                        <div class="col-12 col-lg-4 offset-lg-8 mt-3 mb-2">
                           <div class="row">
                              <div class="col-12">
                                 <div class="row">
                                    <div class="col-0-2-78 col-3"><button class="button-0-2-77">&#x25C4;</button></div>
                                    <div class="col-0-2-78 col-6">
                                       <p class="mb-0 pl-2 pr-2 text-center">Page 1  of 1</p>
                                    </div>
                                    <div class="col-0-2-78 col-3"><button class="button-0-2-77">&#x25BA;</button></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 row-0-2-70">
                     
<a href="/notification/1">
<div class="pt-2 messageRow-0-2-84">
                        <div class="userCheckAndImage-0-2-88" style="padding-top: 5px; padding-bottom: 5px;">
                           <div class="userImage-0-2-85"><img class="image-0-2-90" src="https://media.discordapp.net/attachments/345988575143395328/1054550595337453698/bc1eedb52be3b4b94b11e77b2e2b6f1279028be02072f5ec24408157b23fdd6a_thumbnail.png" width="50px"></div>
                        </div>
                        <div class="subjectAndContent-0-2-89" style="float: right; position: relative; bottom: 9px;">
                           <p class="username-0-2-79"><?=$sitename;?></p>
                           <p class="subjectBodyParagraph-0-2-82"><span class="subject-0-2-80 ">Welcome To <?=$sitename;?>!</span> - <span class="body-0-2-83">Hello there, <?=$myu->username;?>!

Welcome to <?=$sitename;?>, we're glad to have you here. We hope you have a wonderful time, but to make sure you can make the most here, we ask that you brush up on a few of our guidelines.

Here are some basic rules to get you settled in with the crowd! If you're unsure about anything then you can always take a look at our Terms of Service, which will always be situated at the footer of each page!

Thanks for stopping by,
<?=$sitename;?></span></p>
                        </div>
</a>
                        <div>
                           <div class="divider-top"></div>
                        </div>
                     </div>                    

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<? include "../../footer.php"; ?>