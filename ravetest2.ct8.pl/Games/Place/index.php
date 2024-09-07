<script>alert("This page does not function yet.")</script>
<? include "../../header.php";
$id = $_GET['id'];
$baseplate = $handler->query("SELECT * FROM games WHERE id=" . $_GET['id']);
$gB = $baseplate->fetch(PDO::FETCH_OBJ);
?>
<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-61 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-61:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-62 {
  width: auto!important;
}
.cancelButton-0-2-63 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-63:hover {
  background: grey!important;
}
.continueButton-0-2-64 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-64:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-65 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.vTab-0-2-69 {
  cursor: pointer;
  display: inline-block;
  border-top: 1px solid #9e9e9e;
  border-left: 1px solid #9e9e9e;
  border-right: 1px solid #9e9e9e;
  margin-right: 4px;
}
.vTabLabel-0-2-70 {
  padding: 10px 5px 8px 5px;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}
.buttonCol-0-2-72 {
  border-bottom: 2px solid #c3c3c3;
}
.btnBottomSeperator-0-2-73 {
  width: 100%;
  height: 5px;
  background: white;
  margin-bottom: -5px;
}
.vTabUnselected-0-2-74 {
  background: #d6d6d6;
  padding-top: 7px;
}
.vTabUnselected-0-2-74:hover {
  background: #e8e8e8;
}
.count-0-2-75 {
  border: 1px solid #84a5c9;
  background: #e0f1fc;
  padding-left: 4px;
  padding-right: 4px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.redBg-0-2-53 {
  width: 100%;
  height: 5px;
  background: #CE645B;
}
.greenBg-0-2-54 {
  height: 5px;
  background: #52A846;
}
.borderLeft-0-2-55 {
  border-left: 1px solid #c3c3c3;
}
.thumbsText-0-2-56 {
  font-size: 12px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-66 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-66:disabled {
  opacity: 0.5;
}
.wrapper-0-2-67 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-68 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-68:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
body {
  background-color: #fff!important;
}
</style>
<style data-jss="" data-meta="Unthemed">
.favoriteStar-0-2-79 {
  width: 16px;
  height: 16px;
  display: inline-block;
  background: url("/img/FavoriteStar.png");
  margin-bottom: -2px;
}
.favoriteCount-0-2-80 {
  text-align: center;
}
</style>
<style data-jss="" data-meta="Unthemed">
.createCommentTextArea-0-2-83 {
  width: 100%;
  border: 2px solid #dee1ec;
  background: #ecf4ff;
  border-radius: 4px;
}
.createCommentTextArea-0-2-83:focus-visible {
  outline: none;
}
.buttonWrapper-0-2-84 {
  float: right;
  width: 80px;
  position: relative;
  margin-top: -45px;
  margin-right: 13px;
}
.continueButton-0-2-85 {
  font-size: 14px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.commentEntryDiv-0-2-86 {
  width: 100%;
  border: 2px solid #e6e6e6;
  height: 120px;
  background: #f6f6f5;
  border-radius: 4px;
}
.commentText-0-2-87 {
  padding: 10px 10px;
}
.commentCreatedAt-0-2-88 {
  color: #666;
  font-size: 12px;
  margin-bottom: 8px;
}
.report-0-2-89 {
  float: right;
  margin-top: -15px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.text-0-2-90 {
  font-size: 10px;
  margin-top: 15px;
  margin-bottom: 0;
}
.text-0-2-90:hover > a {
  color: #F00;
}
.text-0-2-90:hover > span {
  background-image: url("/img/abuse.png");
}
.link-0-2-91 {
  color: #F99;
  padding-left: 2px;
}
.image-0-2-92 {
  float: left;
  width: 14px;
  height: 13px;
  display: block;
}
</style>

<div class="gameContainer-0-2-45">
   <div class="row mt-2">
      <div class="col-12 col-lg-10">
         <div class="row">
            <div class="col-12">
               <h1 class="gameTitle-0-2-49"><?=htmlspecialchars($gB->title);?> <? if ($myu->admin == "true"){ ?><a href="#">(Delete)</a><?}?></h1>
            </div>
            <div class="col-12 col-lg-8">
               <div class="row">
                  <div class="col-12"><img class="image-0-2-50" src="<?=htmlspecialchars($gB->image);?>" width="100%"></div>
                  <div class="col-12">
                     <p class="fw-bolder font-size-30 user-select-none mb-0 pageButtons-0-2-51"></p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <p class="mb-0 mt-4 descriptionText-0-2-57"><?=htmlspecialchars($gB->description);?></p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-lg-4">
               <div class="row">
                  <div class="col-3 ps-0 pe-0"><img class="image-0-2-58" src="/Market/Storage/Avatar.png" alt="Placeholder" width="66px"></div>
                  <div class="col-9">
                     <p class="mb-0 fw-600 lighten-2 font-size-15">Builder:</p>
                     <p class="mb-0 fw-500 font-size-18"><a href="/users/1/profile">Placeholder</a></p>
                  </div>
               </div>
               <div class="divider-top mb-3"></div>
               <div class="row">
                  <div class="col-12 mx-auto buttonWrapper-0-2-59">
                     <div><button class="btn-0-2-66 button-0-2-60 buyButton-0-2-61" title="">Play</button></div>
                  </div>
               </div>
               <div class="row mt-4">
                  <div class="col-12">
                     <p class="mb-0 font-size-12 mb-1"><span class="fw-600">Created:</span> 12/16/2022</p>
                     <p class="mb-0 font-size-12 mb-1"><span class="fw-600">Favorited:</span> 0</p>
                     <p class="mb-0 font-size-12 mb-1"><span class="fw-600">Visited:</span> 0</p>
                     <p class="mb-0 font-size-12 mb-1"><span class="fw-600">Max Players:</span> 0</p>
                  </div>
               </div>
               <div class="divider-top mb-2"></div>
               <div class="wrapper-0-2-78">
                  <div class="favoriteCount-0-2-80">
                     <div class="favoriteStar-0-2-79"></div>
                     0<span class="ms-1"><a href="#">Favorite</a></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col-12">
               <div class="row">
                  <div class="buttonCol-0-2-72 col-12">
                     <div class="vTab-0-2-69">
                        <p class=" vTabLabel-0-2-70">Comments </p>
                        <div class="btnBottomSeperator-0-2-73"></div>
                     </div>
                  <div class="col-12">
                     <div class="row row-0-2-76"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
<div class="col-12">
   <div class="row">
      <div class="col-12 col-lg-9">
         <div class="row mt-4 mb-4">
            <div class="col-3 pe-4"><img class="image-0-2-58" src="/Market/Storage/Avatar.png" width="150%"></div>
            <div class="col-9">
               <textarea maxlength="200" rows="8" class="createCommentTextArea-0-2-83"></textarea>
               <div class="buttonWrapper-0-2-84">
                  <div><button class="btn-0-2-66 continueButton-0-2-64 continueButton-0-2-85" title="">Continue</button></div>
               </div>
            </div>
            <div class="col-12">
               <div class="divider-top-thick divider-light mt-3"></div>
            </div>
         </div>



         <div class="row mt-3">
            <div class="col-3 pe-4"><img class="image-0-2-58" src="/Market/Storage/Avatar.png" width="150%"></div>
            <div class="col-9">
               <div class="commentEntryDiv-0-2-86">
                  <div class="commentText-0-2-87">
                     <div class="row">
                        <div class="col-7">
                           <p class="commentCreatedAt-0-2-88">Posted 1 second ago by <a href="#">Placeholder</a></p>
                        </div>
                        <div class="col-5">
                           <div class="report-0-2-89">
                              <p class="text-0-2-90"><span class="image-0-2-92"></span><a class="link-0-2-91" href="/abusereport/comment?id=5&amp;RedirectUrl=https%3A%2F%2Fes.syn.wtf%2Fgames%2F5%2FTest-Place">Report Abuse</a></p>
                           </div>
                        </div>
                     </div>
                     <p class="mb-0">Placeholder</p>
                  </div>
               </div>
            </div>
         </div>



      <div class="col-12"></div>
   </div>
</div>


   </div>
</div>

</div>
</div>
</div>
<? include "../../footer.php"; ?>