<?php include "../header.php"; if ($user){
$items = $handler->query("SELECT * FROM inventory WHERE user='".$myu->id."'"); ?>
<style data-jss="" data-meta="Unthemed">
.itemName-0-2-187 {
  height: 36px;
  overflow: hidden;
  font-weight: 700;
  margin-bottom: 0;
}
.image-0-2-188 {
  margin: 0 auto;
  display: block;
  max-width: 100px;
}
.wearButton-0-2-189 {
  float: right;
  width: auto;
  font-size: 12px;
  padding-top: 2px;
  margin-bottom: -25px;
  padding-bottom: 2px;
}
.wearButtonWrapper-0-2-190 {
  position: relative;
}
.assetTypeLabel-0-2-191 {
  color: #666;
  font-weight: 600;
}
.assetType-0-2-192 {
  color: #0055b3;
}
.assetTypeWrapper-0-2-193 {
  font-size: 12px;
}
.thumbWrapper-0-2-194 {
  margin-top: -10px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-36 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-36:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-37 {
  width: auto!important;
}
.cancelButton-0-2-38 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-38:hover {
  background: grey!important;
}
.continueButton-0-2-39 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-39:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-40 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-183 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-183:disabled {
  opacity: 0.5;
}
.wrapper-0-2-184 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-185 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-185:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
</style>
<style data-jss="" data-meta="Unthemed">
.itemName-0-2-187 {
  height: 36px;
  overflow: hidden;
  font-weight: 700;
  margin-bottom: 0;
}
.image-0-2-188 {
  margin: 0 auto;
  display: block;
  max-width: 100px;
}
.wearButton-0-2-189 {
  float: right;
  width: auto;
  font-size: 12px;
  padding-top: 2px;
  margin-bottom: -25px;
  padding-bottom: 2px;
}
.wearButtonWrapper-0-2-190 {
  position: relative;
}
.assetTypeLabel-0-2-191 {
  color: #666;
  font-weight: 600;
}
.assetType-0-2-192 {
  color: #0055b3;
}
.assetTypeWrapper-0-2-193 {
  font-size: 12px;
}
.thumbWrapper-0-2-194 {
  margin-top: -10px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.vTab-0-2-54 {
  cursor: pointer;
  display: inline-block;
  border-top: 1px solid #9e9e9e;
  border-left: 1px solid #9e9e9e;
  border-right: 1px solid #9e9e9e;
  margin-right: 4px;
}
.vTabLabel-0-2-55 {
  padding: 10px 5px 8px 5px;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}
.buttonCol-0-2-57 {
  border-bottom: 2px solid #c3c3c3;
}
.btnBottomSeperator-0-2-58 {
  width: 100%;
  height: 5px;
  background: white;
  margin-bottom: -5px;
}
.vTabUnselected-0-2-59 {
  background: #d6d6d6;
  padding-top: 7px;
}
.vTabUnselected-0-2-59:hover {
  background: #e8e8e8;
}
.count-0-2-60 {
  border: 1px solid #84a5c9;
  background: #e0f1fc;
  padding-left: 4px;
  padding-right: 4px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.categoryEntry-0-2-61 {
  color: #0055b3;
  cursor: pointer;
  text-align: center;
  margin-bottom: 0;
}
.categoryWrapper-0-2-62 {
  margin: 0 auto;
}
.selected-0-2-63 {
  font-weight: 700;
}
.paginationText-0-2-64 {
  text-align: center;
  user-select: none;
  margin-bottom: 0;
}
.pageEnabled-0-2-65 {
  color: #0055b3;
  cursor: pointer;
}
.pageDisabled-0-2-66 {
  color: inherit;
}
body {
  background-color: #ffffff!important;
}
</style>
<style data-jss="" data-meta="Unthemed">
.head-0-2-42 {
  width: 60px;
  border: 1px solid #dededd;
  cursor: pointer;
  height: 50px;
  margin: 0 auto;
  display: block;
}
.torso-0-2-43 {
  width: 120px;
  border: 1px solid #dededd;
  cursor: pointer;
  height: 110px;
  margin: 0 auto;
  display: block;
  margin-top: 10px;
}
.leftArm-0-2-44 {
  width: 40px;
  border: 1px solid #dededd;
  cursor: pointer;
  height: 110px;
  margin: 0 auto;
  display: block;
  z-index: 99;
  margin-left: -50px;
}
.rightArm-0-2-45 {
  width: 40px;
  border: 1px solid #dededd;
  cursor: pointer;
  height: 110px;
  margin: 0 auto;
  display: block;
  z-index: 99;
  margin-top: -110px;
  margin-left: 130px;
}
.leftLeg-0-2-46 {
  float: left;
  width: calc(50% - 10px);
  border: 1px solid #dededd;
  cursor: pointer;
  height: 110px;
  margin-right: 10px;
}
.rightLeg-0-2-47 {
  float: right;
  width: calc(50% - 10px);
  border: 1px solid #dededd;
  cursor: pointer;
  height: 110px;
  margin-left: 10px;
}
.header-0-2-48 {
  margin: 0;
  font-size: 24px;
  font-weight: 400;
}
.legs-0-2-49 {
  width: 120px;
  height: 100%;
  margin: 10px auto 0 auto;
  display: block;
}
.colorSelectorWrapper-0-2-50 {
  width: 200px;
  border: 1px solid #9e9e9e;
  height: 300px;
  padding: 5px 15px;
  position: absolute;
  background: white;
  overflow-y: auto;
  margin-left: 10px;
}
.colorPaletteEntry-0-2-51 {
  width: 25px;
  height: 25px;
  margin: 0 auto;
  display: block;
}
.colorPaletteEntry-0-2-51:hover {
  border: 1px solid white;
  cursor: pointer;
}
.close-0-2-52 {
  cursor: pointer;
}
.row-0-2-53 {
  margin-top: 20px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.image-0-2-41 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 400px;
}
</style>
<div class="characterContainer-0-2-25">
   <div class="row mt-2">
      <div class="col-12 ps-4 pe-4">
         <h1 class="header-0-2-24">Character Customizer</h1>
      </div>
   </div>
   <div class="row mt-4">
      <div class="col-12 col-lg-4">
         <div class="row">
            <div class="col-12">
               <h2 class="header-0-2-33">Avatar</h2>
            </div>
            <div class="col-12">
               <iframe frameborder="0" src="/avatar.php?id=<? echo $myu->id ?>" scrolling="no" style=" width: 200px; height: 200px" class="image-0-2-41"></iframe>
               <div class="renderButtonWrapper-0-2-34"></div>
            </div>
            <div class="col-12">
               <p class="mb-0">Something wrong with your Avatar?</p>
               <p class="mb-0"><a href="/Customize/">Click here to refresh it!</a></p>
            </div>
         </div>
         <div class="row-0-2-53 row">
            
         </div>
      </div>
      <div class="col-12 col-lg-8">
         <div class="row">
            <div class="col-12">
               <div class="row">
                  <div class="buttonCol-0-2-57 col-12">
                     <div class="vTab-0-2-54">
                        <p class=" vTabLabel-0-2-55">Wardrobe </p>
                        <div class="btnBottomSeperator-0-2-58"></div>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="row">
                        <div class="col-12">
                        </div>
                        <div class="col-12">
                           <div class="row">
<p class="text-center hideifinventory" style="margin-top: 1rem;">No items available</p>
<? while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE id='".$gN->item."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifinventory{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 continueButton-0-2-39" title="" href="/Market/Items/render.php?id=<?=$gI->id;?>" style="color:white!important;">Wear</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

                           </div>
                           <div class="row mt-4">
                              <div class="col-12">
                                 <p class="paginationText-0-2-64"><span class="pageDisabled-0-2-66">Previous </span><span class="pageDisabled-0-2-66"> 1 </span><span class="pageDisabled-0-2-66"> Next</span></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="divider-top divider-thick divider-light mt-4 mb-4"></div>
            </div>
            <div class="col-12">
               <h2 class="subtitle-0-2-67">Currently Wearing</h2>
               <div class="row">
                  <p class="hideifwearing">You aren't wearing anything</p>


<? // item wearing things ?>


<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->hat."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->hat."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->body."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->body."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->hair."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->hair."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->shirt."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->shirt."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->pants."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->pants."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->face."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->face."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>

<? $items = $handler->query("SELECT * FROM items WHERE wearable='".$myu->tshirt."'");
while($gN = $items->fetch(PDO::FETCH_OBJ)){ 
$inventory = $handler->query("SELECT * FROM items WHERE wearable='".$myu->tshirt."'");
$gI = $inventory->fetch(PDO::FETCH_OBJ)
?>
<style>.hideifwearing{display:none!important;}</style>                              

<div class="col-3 mt-4">
                                 <div class="image-0-2-188">
                                    <div class="wearButtonWrapper-0-2-190">
                                       <div><a class="btn-0-2-183 wearButton-0-2-189 cancelButton-0-2-38" title="" href="/Market/Items/remove.php?id=<?=$gI->id;?>" style="color:white!important;">Remove</a></div>
                                    </div>
                                    <div class="thumbWrapper-0-2-194"><img class="image-0-2-163 " src="<?=$gI->image;?>" height="73"></div>
                                 </div>
                                 <p class="itemName-0-2-187"><a href="/Market/Items/?id=<?=$gI->id;?>"><?=htmlspecialchars($gI->name);?></a></p>
                              </div>
<?}?>


               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<? } include("../footer.php"); ?>