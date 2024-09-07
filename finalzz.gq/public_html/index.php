<?php
$pagename = 'Home';
$pagelink = 'www.finalzz.gq';
include($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>
<?php
$id = $myu->id;
if ($user) {
?>
<div id="Body" style="width:970px">
<div id="HomeContainer" class="home-container" data-facebook-share="/facebook/share-character" data-update-status-url="/home/updatestatus" data-get-feed-url="/feeds/getuserfeed">
<div>
<h1>Hello, <span class="notranslate"><?php echo "$user"; ?></span>!</h1>
</div>
<div class="left-column">
<div class="left-column-boxes user-avatar-container">


<div id="UserAvatar" class="thumbnail-holder" data-3d-thumbs-enabled="" data-url="/thumbnail/user-avatar?userId=445&amp;thumbnailFormatId=124&amp;width=210&amp;height=210" style="width:210px; height:210px;">
<div class="roblox-avatar-image image-medium"><div style="position: relative;">
<iframe frameborder="0" src="/chingchonk.php?id=<?php echo "$id"; ?>" scrolling="no" style=" width: 200px; height: 200px"></iframe></div></div>
</div>
<div id="UserInfo" class="text">

<br clear="all">
<br class="rbx2hide">
<div>
</div>
</div> </div>

<div class="left-column-boxes">
<div>
<h3 class="best-friends-title">My Best Friends</h3>
<div class="edit-friends-button">
<a href="/my/EditFriends.aspx" class="btn-small btn-neutral">Edit</a>
</div>
<div class="clear"></div>
</div>
<div id="bestFriendsContainer" class="best-friends-container"><div class="best-friends">
</div></div>
<div style="clear:both;"></div>
</div>
<div class="left-column-boxes text">
<div id="fbNotLoggedIn">
</div>
<a class="facebook-login" href="/Market">
<span class="left"></span>
<span class="right"></span>
</a>
<div class="facepile">
<iframe src="https://www.facebook.com/plugins/facepile.php?%20app_id=190191627665278" scrolling="yes" style="border: none; overflow: hidden; width: 210px;" frameborder="0"></iframe>
</div>
</div>
</div>
</div>
<div class="middle-column">
<div id="statusUpdateBox" class="middle-column-box status-update">
<div>
<input name="txtStatusMessage" type="text" id="txtStatusMessage" maxlength="254" class="translate text-box text-box-large status-textbox" placeholder="What are you up to?" value="">
<span class="btn-control btn-control-large share-button" id="shareButton">Share</span>
<img id="loadingImage" class="status-update-image" style="display: none" alt="Sharing..." src="https://images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif">
<div class="clear"></div>
</div>
</div>
<div id="FeedificationsContainer" class=""></div>
<div id="FeedContainer" class="middle-column-box feed-container">
<h2>My Feed</h2>
<div id="FeedPanel">
<div class="divider-top feed-container">
<div class="feed-image-container notranslate">
<a href="/User.aspx?ID=445" class="feed-asset">
<img class="feed-asset-image" title="wafkee" alt="wafkee" src="/img/slaveguy.png" width="48" height="48" border="0">
</a>
</div>
<div class="feed-text-container text">
<span class="notranslate">
<a href="/Profile/?username=wafkee">wafkee</a><br>
<div class="Feedtext">"I have disabled feed due to security concerns."</div>
</span>
<span style="display: block; padding-top: 5px; color: #AAA; font-size: 11px;">11/29/2020 at 6:49 AM</span>
</div>
<div class="feed-report-abuse">
<a href="/abusereport/feed?id=90938582&amp;redirectUrl=%2Fhome">
</a>
</div>
<div class="clear"></div>
</div>
<div id="AjaxFeedError" style="display: none" class="error-message">An error occurred while fetching your feed.</div>
</div>
</div>
</div>
<div class="right-column">
<div id="RecentlyVisitedPlacesContainer" class="right-column-box">
<h3 style="padding-bottom: 6px;">Recently Played Games</h3>
<div id="RecentlyVisitedPlaces">
<div id="RecentlyVisitedPlaceTemplate" class="recent-place-container">
<div class="recent-place-thumb"></div>
<div class="recent-place-Info">
<div class="recent-place-name"></div>
<div class="recent-place-players-online text"></div>
</div>
</div>
<div id="SeeMore" style="display: none;">
<a href="/Games" class="text-link">See More <img alt="See more! " src="https://images.rbxcdn.com/efe86a4cae90d4c37a5d73480dea4cb1.png" class="see-more-img"></a>
</div>
<div id="PlayGames" style="">
You haven't played any games recently.
<a href="/Games" class="text-link">Play Now <img alt="See more! " src="https://images.rbxcdn.com/efe86a4cae90d4c37a5d73480dea4cb1.png" class="see-more-img"></a>
</div>
</div>
<div id="Skyscraper-Ad" class="right-column-box">
<div style="width: 160px">
<span id="3439303639313930" class="GPTAd skyscraper" data-js-adtype="gptAd">
<script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3439303639313930");
            });
        </script>
<div id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__container__" style="border: 0pt none;"><iframe id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0" name="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0" scrolling="no" marginwidth="0" marginheight="0" src="javascript:" <html="" width="160" height="600" frameborder="0"><body style='background:transparent'></body></html>"" style="border: 0px; vertical-align: bottom;"></iframe></div><iframe id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__hidden__" name="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__hidden__" scrolling="no" marginwidth="0" marginheight="0" src="javascript:" <html="" width="0" height="0" frameborder="0"><body style='background:transparent'></body></html>"" style="border: 0px; vertical-align: bottom; visibility: hidden; display: none;"></iframe></span>
<div class="ad-annotations " style="width: 160px">
</div>
</div> </div>
</div>
<div class="clear"></div>
<div id="UserScreenContainer">
</div>
</div>
<div style="clear:both"></div>
</div>
</div>
<?php
} else {
header('Location: /Register');
}
?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>