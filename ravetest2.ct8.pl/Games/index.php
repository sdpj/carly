<? include"../header.php"; 
$game = $handler->query("SELECT * FROM games");
?>
<style data-jss="" data-meta="Unthemed">
.title-0-2-57 {
  color: rgb(33, 37, 41);
  margin-top: 10px;
  font-weight: 300;
  margin-left: 10px;
  margin-bottom: 10px;
}
.gameRow-0-2-58 {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: hidden;
  margin-left: -4px;
}
.gameRow-0-2-58>div {
  flex: 0 0 auto;
}
.gameCard-0-2-59 {
  width: 170px;
  padding-left: 5px;
  padding-right: 5px;
}
.pagerButton-0-2-60 {
  color: #666;
  width: 40px;
  border: 1px solid #c3c3c3;
  cursor: pointer;
  height: calc(100% - 34px);
  position: relative;
  background: rgba(255,255,255,1);
  box-shadow: 0 0 3px 0 #ccc;
}
.pagerButton-0-2-60:hover {
  color: black;
}
.goBack-0-2-61 {
  float: left;
  margin-left: 10px;
}
.goForward-0-2-62 {
  float: right;
  margin-left: 10px;
}
.pagerCaret-0-2-63 {
  font-size: 40px;
  margin-top: 240%;
  text-align: center;
  user-select: none;
}
.caretLeft-0-2-64 {
  display: block;
  transform: rotate(90deg);
  margin-right: 10px;
}
.caretRight-0-2-65 {
  display: block;
  transform: rotate(-90deg);
  margin-left: 10px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.card-0-2-82 {
  background: white;
  box-shadow: 0 1px 4px 0 rgb(25 25 25 / 30%);
  border-radius: 0;
}
</style>

   <div class="col-12">
      <div class="row">
         <div class="row">
            <div class="col-12">
               <h3 class="title-0-2-57" style="margin-bottom: 0px!important;">GAMES</h3><j style="margin-bottom: 10px; margin-left: 11px; display: block;">NOTE: Games are not publicly released yet.</j>
            </div>
            <!--<div class="col-12 col-lg-9">
               <div class="goBack-0-2-61 pagerButton-0-2-60 opacity-25" style="height: 236px;">
                  <p class="pagerCaret-0-2-63"><span class="caretRight-0-2-65">^</span></p>
               </div>-->
               <div class="row gameRow-0-2-58">

<?
while($gT = $game->fetch(PDO::FETCH_OBJ)){ ?>

                  <div class="gameCard-0-2-59">
                     <div class="card-0-2-82 ">
                        <a href="/games/<?echo "$gT->id"; ?>/<?=preg_replace('#[ -]+#', '-', $gT->title);?>">
                           <div class="imageWrapper-0-2-68"><img class="image-0-2-69" src="<?=htmlspecialchars($gT->image);?>" alt="<?=htmlspecialchars($gT->title);?>" height="160" width="160"></div>
                        </a>
                        <div class="pe-2 pb-2 pt-2 ps-2">
                           <p class="label-0-2-66 truncate" style="margin-bottom:0px;"><?=htmlspecialchars($gT->title);?></p>
                           
<div class="pt-2 pe-1">
      <div class="divider-top"></div>
   <p class="pt-2 pb-0 creatorText-0-2-72">By <a href="/My/Groups.aspx?gid=2">Builderman</a></p>
</div>


                        </div>
                     </div>
                  </div>
<?}?>

                  
            </div>
            <div class="col-12 col-lg-3">
               <div style="width: 100%; height: 270px;"></div>
            </div>
         </div>
                     <div class="col-12 col-lg-3">
               <div style="width: 100%; height: 270px;"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<? include "../footer.php"; ?>