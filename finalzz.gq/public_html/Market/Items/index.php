<? include"../../header.php";?>
<?
$item = $handler->query("SELECT * FROM items WHERE id=" . $_GET['id']);
$gB = $item->fetch(PDO::FETCH_OBJ); ?>
<div id="RepositionBody"><div id="Body" style="width:970px;">
<div id="ItemContainer" class="text">
<div>
<div id="ctl00_cphRoblox_GearDropDown" class="SetList ItemOptions invisible">
<a href="#" class="btn-dropdown">
<img src="/images/icons/gearicon.png">
</a>
<div class="clear"></div>
<div class="SetListDropDown">
<div class="SetListDropDownList invisible">
<div class="menu invisible">
<div id="ctl00_cphRoblox_ItemOwnershipPanel" class="invisible">

 <a onclick="confirmDelete(this);return false;" id="ctl00_cphRoblox_btnDelete" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$btnDelete&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Delete from My Stuff</a>
</div>
</div>
</div>
</div>
</div>
<h1 class="notranslate" data-se="item-name">
<? echo "$gB->name"; ?></h1>
<h3>
Rhodum Item
</h3>
</div>
<div id="Item">
<div id="Details">
<div id="assetContainer">
<div id="Thumbnail">
<img src="<? echo "$gB->image"; ?>" alt="<? echo "$gB->name"; ?>" width="320" height="320">
<div class="roblox-item-image image-big" data-item-id="2226" data-image-size="big" data-no-click="true"></div>
</a>
</div>
</div>
<div id="Summary">
<div class="SummaryDetails">
<div id="Creator" class="Creator">
<div class="Avatar">
<a id="ctl00_cphRoblox_AvatarImage" class="tooltip-right" href="/User.aspx?ID=370" style="display:inline-block;height:70px;width:70px;cursor:pointer;" original-title="<? echo "$gB->creator"; ?>">
<div class="roblox-avatar-image image-small" data-user-id="370" data-image-size="custom" data-image-size-x="70" data-image-size-y="70" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<? echo "$gB->creator"; ?>"><div style="position: relative;"><a href="/Profile/?username=<? echo "$gB->creator"; ?>"></a></div></div>
</a>
</div>
</div>
<div class="item-detail">
<span class="stat-label notranslate">Creator:</span>
<a id="ctl00_cphRoblox_CreatorHyperLink" class="stat notranslate" href="/Profile/?username=<? echo "$gB->creator"; ?>"><? echo "$gB->creator"; ?></a>
<div>
<span class="stat-label">Created:</span>
<span class="stat">
9/2/2020 </span>
</div>
<div id="LastUpdate">
<span class="stat-label">Updated:</span>
<span class="stat">
9/2/2020 </span>
</div>
</div>
<div id="ctl00_cphRoblox_DescriptionPanel" class="DescriptionPanel notranslate">
<pre class="Description Full text"><? echo "$gB->description"; ?></pre>
<pre class="Description body text"><? echo "$gB->description"; ?></pre>
</div>
<div class="ReportAbuse">
<div id="ctl00_cphRoblox_AbuseReportButton1_AbuseReportPanel" class="ReportAbuse">
<span class="AbuseIcon"><a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseIconHyperLink" href="AbuseReport/Asset.aspx?ID=2226&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fitem.aspx%3fseoname%3dGravity-Coil%26id%3d16688968"><img src="/images/abuse.PNG?v=2" alt="Report Abuse" style="border-width:0px;"></a></span>
<span class="AbuseButton"><a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseTextHyperLink" href="AbuseReport/Asset.aspx?ID=2226&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fitem.aspx%3fseoname%3dGravity-Coil%26id%3d16688968">Report Abuse</a></span>
</div>
</div>
</div>
<div class="BuyPriceBoxContainer">
<div class="BuyPriceBox">
<div id="ctl00_cphRoblox_TicketsPurchasePanel">
<div id="TicketsPurchase">
<div id="PriceInTickets">
Price: <span class="tickets " data-se="item-priceintickets"><? echo "$gB->price"; ?></span>
</div>
<div id="BuyWithTickets">
<div onclick="location.href='/../Market/purchase.php?id=<?echo "$gB->id"; ?>';" data-asset-type="Hat" class="btn-primary btn-medium PurchaseButton " data-se="item-buyfortickets" data-item-name="<? echo "$gB->name"; ?>" data-seller-name="<? echo "$gB->creator"; ?>">
Buy
<span class="btn-text">Buy with Posties</span>
</div>

</div>
</div>
<div class="clear"></div>
</div>
<div class="clear">
</div>
<div class="footnote">
<div id="ctl00_cphRoblox_Sold">
(<span data-se="item-numbersold"><?echo "$gB->sales"; ?></span>
Sold)
</div>
</div>
</div>
<div class="clear"></div>
<span>
<span class="FavoriteStar" data-se="item-numberfavorited">
0
</span>
</span>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="PrivateSales divider-top invisible">
<h2>PRIVATE SALES</h2>
<div id="UserSalesTab">
<div class="empty">
Sorry, no one is privately selling this item at the moment.
</div>
<div class="pgItemsForResale">
<span id="ctl00_cphRoblox_pgItemsForResale"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
</div>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div class="ItemPurchaseAjaxContainer">
<div id="ItemPurchaseAjaxData" data-authenticateduser-isnull="False" data-user-balance-robux="0" data-user-balance-tickets="145" data-user-bc="0" data-continueshopping-url="/Catalog" data-imageurl="http://roblonium.com/Game/Tools/ThumbnailAsset.ashx?aid=2226&amp;fmt=png&amp;wd=320&amp;ht=320" data-alerturl="http://images.rbxcdn.com/cbb24e0c0f1fb97381a065bd1e056fcb.png" data-builderscluburl="http://images.rbxcdn.com/ae345c0d59b00329758518edc104d573.png"></div>
<div id="BCOnlyModal" class="modalPopup unifiedModal smallModal" style="display:none;">
<div style="margin:4px 0px;">
<span>Builders Club Only</span>
</div>
<div class="simplemodal-close">
<a class="ImageButton closeBtnCircle_20h" style="margin-left:400px;"></a>
</div>
<div class="unifiedModalContent" style="padding-top:5px; margin-bottom: 3px; margin-left: 3px; margin-right: 3px">
<div class="ImageContainer">
<img class="GenericModalImage BCModalImage" alt="Builder's Club" src="https://images.rbxcdn.com/ae345c0d59b00329758518edc104d573.png">
<div id="BCMessageDiv" class="BCMessage Message">
This is a premium item only available to our Builders Club members.
</div>
</div>
<div style="clear:both;"></div>
<div style="clear:both;"></div>
<div class="GenericModalButtonContainer" style="padding-bottom: 13px">
<div class="modal-footer" style="text-align:center">
<button class="btn-primary btn-large" onclick="location.reload();" style="height:50px;">
Upgrade Now
<span class="btn-text">Upgrade Now</span>
</button>
<button type="button" class="btn-negative btn-large" onclick="$.modal.close();" style="height:50px;">
Cancel
<span class="btn-text">Cancel</span>
</button>
</div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
</div>
<script type="text/javascript">
    function showBCOnlyModal(modalId) {
        var modalProperties = { overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" } };
        if (typeof modalId === "undefined")
            $("#BCOnlyModalSelling").modal(modalProperties);
        else
            $("#" + modalId).modal(modalProperties);
    }
</script>
<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
<div class="Title"></div>
<div class="GenericModalBody">
<div>
<div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays="" data-no-click="">
<img class="GenericModalImage" alt="generic image">
</div>
<div class="Message"></div>
<div style="clear:both"></div>
</div>
<div class="GenericModalButtonContainer">
<a class="ImageButton btn-neutral btn-large roblox-ok">OK</a>
<span class="btn-text">OK</span>
</div>
</div>
</div>
<div id="ProcessingView" style="display:none">
<div class="ProcessingModalBody">
<p style="margin:0px"><img src="https://images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif" alt="Processing..."></p>
<p style="margin:7px 0px">Processing Transaction</p>
</div>
</div>
<script type="text/javascript">
        //<sl:translate>
        Roblox.ItemPurchase.strings = {
            insufficientFundsTitle : "Insufficient Funds",
            insufficientFundsText : "You need {0} more to purchase this item.",
            cancelText : "Cancel",
            okText : "OK",
            buyText : "Buy",
            buyTextLower : "buy",
            tradeCurrencyText : "Trade Currency",
            priceChangeTitle : "Item Price Has Changed",
            priceChangeText : "While you were shopping, the price of this item changed from {0} to {1}.",
            buyNowText : "Buy Now",
            buildersClubOnlyTitle : "{0} Only",
            buildersClubOnlyText : "You need {0} to buy this item!",
            buyItemTitle : "Buy Item",
            buyItemText : "Would you like to {0} the {1} {2} from {3} for {4}?",
            balanceText : "Your balance after this transaction will be {0}",
            freeText : "Free",
            purchaseCompleteTitle : "Purchase Complete!",
            purchaseCompleteText : "You have successfully {0} the {1} {2} from {3} for {4}.",
            continueShoppingText : "Continue Shopping",
            customizeCharacterText : "Customize Character",
            orText : "or",
            rentText : "rent"
        }
    //</sl:translate>
    </script>
</div>
<div id="ctl00_cphRoblox_CreateSetPanelDiv" class="createSetPanelPopup">
</div>
<script type="text/javascript"> 
        Roblox.Resources = {};
        Roblox.Resources.PlaceProductPromotion = {
            //<sl:translate>
            anErrorOccurred: 'An error occurred, please try again.'
            , youhaveAdded: "You have added "
            , toYourGame: " to your game, "
            , youhaveRemoved: "You have removed "
            , fromYourGame: " from your game, "
            , ok: "OK"
            , success: "Success!"
            , error: "Error"
            , sorryWeCouldnt: "Sorry, we couldn't remove the item from your game. Please try again."
	        , notForSale: "This item is not for sale."
	        , rent: "Rent"
            //<sl:translate>
        };
        
        var commentsLoaded = false;

        //Tabs
        function SwitchTabs(nextTabElem) {
            $('.WhiteSquareTabsContainer .selected,  .TabContent.selected').removeClass('selected');
            nextTabElem.addClass('selected');
            $('#' + nextTabElem.attr('contentid')).addClass('selected');

            var label = $.trim(nextTabElem.attr('contentid'));
            if(label == "CommentaryTab" && !commentsLoaded) {
                Roblox.CommentsPane.getComments(0);
                commentsLoaded = true;
                if(Roblox.SuperSafePrivacyMode != undefined) {
                    Roblox.SuperSafePrivacyMode.initModals();
                }
                return false;
            }
        }
        
            SwitchTabs($('#RecommendationsTabHeader'));
        
        $('.WhiteSquareTabsContainer li').bind('click', function (event) {
            event.preventDefault();
            SwitchTabs($(this));
        });
        
        
        function confirmDelete() {
            Roblox.GenericConfirmation.open({
                //<sl:translate>
                titleText: "Delete Item",
                bodyContent: "Are you sure you want to permanently DELETE this item from your inventory?",
                //</sl:translate>
                onAccept: function () {
                    javascript: __doPostBack('ctl00$cphRoblox$btnDelete', '');
                },
                acceptColor: Roblox.GenericConfirmation.blue,
                //<sl:translate>
                acceptText: "OK"
                //</sl:translate>
            });
        }

        function confirmSubmit() {
            Roblox.GenericConfirmation.open({
                //<sl:translate>
                titleText: "Create New Badge Giver",
                bodyContent: "This will add a new badge giver model to your inventory. Are you sure you want to do this?",
                //</sl:translate>
                onAccept: function () {
                    window.location.href = $('#ctl00_cphRoblox_btnSubmit').attr('href');
                },
                acceptColor: Roblox.GenericConfirmation.blue,
                //<sl:translate>
                acceptText: "OK"
                //</sl:translate>
            });
        }

        modalProperties = { escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000"} };
        
        // Code for Modal Popups
        $(function() {
            $(".btn-disabled-primary").removeClass("Button").tipsy({ gravity: 's' }).attr("href", "javascript: return false;");
        });
        function ModalClose(popup) {
            $.modal.close('.' + popup);
        }
    </script>
<div style="clear:both"></div>
</div>