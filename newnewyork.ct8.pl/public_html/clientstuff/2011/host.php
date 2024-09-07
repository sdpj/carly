<?php
header("Content-Type: text/plain");
if(!empty($_GET['port']))
{
    $port = $_GET['port'];
?>
-- Resize script
coroutine.resume(coroutine.create(function()
	loadstring('\108\111\99\97\108\32\67\111\114\101\71\117\105\32\61\32\103\97\109\101\58\71\101\116\83\101\114\118\105\99\101\40\34\67\111\114\101\71\117\105\34\41\59\10\119\104\105\108\101\32\110\111\116\32\67\111\114\101\71\117\105\58\70\105\110\100\70\105\114\115\116\67\104\105\108\100\40\34\82\111\98\108\111\120\71\117\105\34\41\32\100\111\10\9\67\111\114\101\71\117\105\46\67\104\105\108\100\65\100\100\101\100\58\119\97\105\116\40\41\59\10\101\110\100\10\108\111\99\97\108\32\82\111\98\108\111\120\71\117\105\32\61\32\67\111\114\101\71\117\105\46\82\111\98\108\111\120\71\117\105\59\10\108\111\99\97\108\32\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\32\61\32\82\111\98\108\111\120\71\117\105\58\70\105\110\100\70\105\114\115\116\67\104\105\108\100\40\34\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\34\41\10\108\111\99\97\108\32\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\32\61\32\82\111\98\108\111\120\71\117\105\58\70\105\110\100\70\105\114\115\116\67\104\105\108\100\40\34\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\34\41\10\108\111\99\97\108\32\84\111\112\76\101\102\116\67\111\110\116\114\111\108\32\61\32\82\111\98\108\111\120\71\117\105\58\70\105\110\100\70\105\114\115\116\67\104\105\108\100\40\34\84\111\112\76\101\102\116\67\111\110\116\114\111\108\34\41\10\108\111\99\97\108\32\66\117\105\108\100\84\111\111\108\115\32\61\32\82\111\98\108\111\120\71\117\105\58\70\105\110\100\70\105\114\115\116\67\104\105\108\100\40\34\66\117\105\108\100\84\111\111\108\115\34\41\10\102\117\110\99\116\105\111\110\32\109\97\107\101\89\82\101\108\97\116\105\118\101\40\41\10\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\50\10\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\50\10\105\102\32\84\111\112\76\101\102\116\67\111\110\116\114\111\108\32\116\104\101\110\32\84\111\112\76\101\102\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\50\32\101\110\100\10\105\102\32\66\117\105\108\100\84\111\111\108\115\32\116\104\101\110\32\66\117\105\108\100\84\111\111\108\115\46\70\114\97\109\101\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\50\32\101\110\100\10\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\80\111\115\105\116\105\111\110\32\61\32\85\68\105\109\50\46\110\101\119\40\48\44\48\44\49\44\45\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\89\41\10\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\80\111\115\105\116\105\111\110\32\61\32\85\68\105\109\50\46\110\101\119\40\49\44\45\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\88\44\49\44\45\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\89\41\10\101\110\100\10\102\117\110\99\116\105\111\110\32\109\97\107\101\88\82\101\108\97\116\105\118\101\40\41\10\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\49\10\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\49\10\105\102\32\84\111\112\76\101\102\116\67\111\110\116\114\111\108\32\116\104\101\110\32\84\111\112\76\101\102\116\67\111\110\116\114\111\108\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\49\32\101\110\100\10\105\102\32\66\117\105\108\100\84\111\111\108\115\32\116\104\101\110\32\66\117\105\108\100\84\111\111\108\115\46\70\114\97\109\101\46\83\105\122\101\67\111\110\115\116\114\97\105\110\116\32\61\32\49\32\101\110\100\10\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\80\111\115\105\116\105\111\110\32\61\32\85\68\105\109\50\46\110\101\119\40\48\44\48\44\49\44\45\66\111\116\116\111\109\76\101\102\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\89\41\10\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\80\111\115\105\116\105\111\110\32\61\32\85\68\105\109\50\46\110\101\119\40\49\44\45\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\88\44\49\44\45\66\111\116\116\111\109\82\105\103\104\116\67\111\110\116\114\111\108\46\65\98\115\111\108\117\116\101\83\105\122\101\46\89\41\10\101\110\100\10\108\111\99\97\108\32\102\117\110\99\116\105\111\110\32\114\101\115\105\122\101\40\41\10\105\102\32\82\111\98\108\111\120\71\117\105\46\65\98\115\111\108\117\116\101\83\105\122\101\46\120\32\62\32\82\111\98\108\111\120\71\117\105\46\65\98\115\111\108\117\116\101\83\105\122\101\46\121\32\116\104\101\110\10\109\97\107\101\89\82\101\108\97\116\105\118\101\40\41\10\101\108\115\101\10\109\97\107\101\88\82\101\108\97\116\105\118\101\40\41\10\101\110\100\10\101\110\100\10\82\111\98\108\111\120\71\117\105\46\67\104\97\110\103\101\100\58\99\111\110\110\101\99\116\40\102\117\110\99\116\105\111\110\40\112\114\111\112\101\114\116\121\41\10\105\102\32\112\114\111\112\101\114\116\121\32\61\61\32\34\65\98\115\111\108\117\116\101\83\105\122\101\34\32\116\104\101\110\10\119\97\105\116\40\41\10\114\101\115\105\122\101\40\41\10\101\110\100\10\101\110\100\41\10\119\97\105\116\40\41\10\114\101\115\105\122\101\40\41\10')()
end))
<?
    $data = '-- StartGame -- 
game:GetService("RunService"):Run()
-- REQUIRES: StartGanmeSharedArgs.txt
-- REQUIRES: MonitorGameStatus.txt
------------------- UTILITY FUNCTIONS --------------------------
function waitForChild(parent, childName)
    while true do
        local child = parent:findFirstChild(childName)
        if child then
            return child
        end
        parent.ChildAdded:wait()
    end
end
-- returns the player object that killed this humanoid
-- returns nil if the killer is no longer in the game
function getKillerOfHumanoidIfStillInGame(humanoid)
    -- check for kill tag on humanoid - may be more than one - todo: deal with this
    local tag = humanoid:findFirstChild("creator")
    -- find player with name on tag
    if tag then
        local killer = tag.Value
        if killer.Parent then -- killer still in game
            return killer
        end
    end
    return nil
end
-- This code might move to C++
function characterRessurection(player)
    if player.Character then
        local humanoid = player.Character.Humanoid
        humanoid.Died:connect(function()
            wait(5)
            player:LoadCharacter()
            fixhealthgui(player)
        end)
    end
end
------------------- CUSTOM FUNCTIONS --------------------------
local assetPropertyNames = {"Texture", "TextureId", "SoundId", "MeshId", "SkyboxUp", "SkyboxLf", "SkyboxBk", "SkyboxRt", "SkyboxFt", "SkyboxDn", "PantsTemplate", "ShirtTemplate", "Graphic", "Image", "LinkedSource", "AnimationId"}
local variations = {"http://www%.roblox%.com/asset/%?id=", "http://www%.roblox%.com/asset%?id=", "http://%.roblox%.com/asset/%?id=", "http://%.roblox%.com/asset%?id=", "http://www%.roblox%.com/asset%?version=1%&id=", "http://www%.roblox%.com/asset/%?version=1%&id="}
function GetDescendants(o)
    local allObjects = {}
    function FindChildren(Object)
       for _,v in pairs(Object:GetChildren()) do
            table.insert(allObjects,v)
            FindChildren(v)
        end
    end
    FindChildren(o)
    return allObjects
end
function fixassets(model)
    for i, v in pairs(GetDescendants(model)) do
        for _, property in pairs(assetPropertyNames) do
            pcall(function()
                if v[property] and not v:FindFirstChild(property) then --Check for property, make sure we`re not getting a child instead of a property
                    assetText = string.lower(v[property])
                    for _, variation in pairs(variations) do
                        v[property], matches = string.gsub(assetText, variation, "http://yrk%.ct8%.pl/asset?id=")
                        if matches > 0 then
                            break
                        end
                    end
                end
            end)
        end
    end
end
function fixhealthgui(player) -- fix the healthgui from not showing up [happens due to old roblox asset links]
    local healthgui = waitForChild(player.PlayerGui, "HealthGUI")
    fixassets(healthgui)
end
-----------------------------------END UTILITY/CUSTOM FUNCTIONS -------------------------
-----------------------------------"CUSTOM" SHARED CODE----------------------------------
pcall(function() settings().Network.UseInstancePacketCache = true end)
pcall(function() settings().Network.UsePhysicsPacketCache = true end)
--pcall(function() settings()["Task Scheduler"].PriorityMethod = Enum.PriorityMethod.FIFO end)
pcall(function() settings()["Task Scheduler"].PriorityMethod = Enum.PriorityMethod.AccumulatedError end)
--settings().Network.PhysicsSend = 1 -- 1==RoundRobin
settings().Network.ExperimentalPhysicsEnabled = true
settings().Network.WaitingForCharacterLogRate = 100
pcall(function() settings().Diagnostics:LegacyScriptMode() end)
-----------------------------------START GAME SHARED SCRIPT------------------------------
local assetId = placeId -- might be able to remove this now
game:SetPlaceID(1818, false)
game:GetService("ChangeHistoryService"):SetEnabled(false)
-- establish this peer as the Server
if url~=nil then
    pcall(function() game:GetService("Players"):SetAbuseReportUrl(url .. "/AbuseReport/InGameChatHandler.ashx") end)
    pcall(function() game:GetService("ScriptInformationProvider"):SetAssetUrl(url .. "/Asset/") end)
    pcall(function() game:GetService("ContentProvider"):SetBaseUrl(url .. "/") end)
    pcall(function() game:GetService("Players"):SetChatFilterUrl(url .. "/Game/ChatFilter.ashx") end)
    game:GetService("BadgeService"):SetPlaceId(placeId)
    if access~=nil then
        game:GetService("BadgeService"):SetAwardBadgeUrl(url .. "/Game/Badge/AwardBadge.ashx?UserID=%d&BadgeID=%d&PlaceID=%d&" .. access)
        game:GetService("BadgeService"):SetHasBadgeUrl(url .. "/Game/Badge/HasBadge.ashx?UserID=%d&BadgeID=%d&" .. access)
        game:GetService("BadgeService"):SetIsBadgeDisabledUrl(url .. "/Game/Badge/IsBadgeDisabled.ashx?BadgeID=%d&PlaceID=%d&" .. access)
        game:GetService("FriendService"):SetMakeFriendUrl(servicesUrl .. "/Friend/CreateFriend?firstUserId=%d&secondUserId=%d&" .. access)
        game:GetService("FriendService"):SetBreakFriendUrl(servicesUrl .. "/Friend/BreakFriend?firstUserId=%d&secondUserId=%d&" .. access)
        game:GetService("FriendService"):SetGetFriendsUrl(servicesUrl .. "/Friend/AreFriends?userId=%d&" .. access)
    end
    game:GetService("BadgeService"):SetIsBadgeLegalUrl("")
    game:GetService("InsertService"):SetBaseSetsUrl(url .. "/Game/Tools/InsertAsset.php?nsets=10&type=base")
    game:GetService("InsertService"):SetUserSetsUrl(url .. "/Game/Tools/InsertAsset.php?nsets=20&type=user&userid=%d")
    game:GetService("InsertService"):SetCollectionUrl(url .. "/Game/Tools/InsertAsset.php?sid=%d")
    game:GetService("InsertService"):SetAssetUrl(url .. "/Asset/?id=%d")
    game:GetService("InsertService"):SetAssetVersionUrl(url .. "/Asset/?assetversionid=%d")
    
    pcall(function() loadfile(url .. "/Game/LoadPlaceInfo.ashx?PlaceId=" .. placeId)() end)
    
    pcall(function() 
        if access then
            loadfile(url .. "/Game/PlaceSpecificScript.ashx?PlaceId=" .. placeId .. "&" .. access)()
        end
    end)
end
pcall(function() game:GetService("NetworkServer"):SetIsPlayerAuthenticationRequired(false) end)
settings().Diagnostics.LuaRamLimit = 0

if placeId~=nil and killID~=nil and deathID~=nil and url~=nil then



-- send kill and death stats when a player dies
function onDied(victim, humanoid)
	local killer = getKillerOfHumanoidIfStillInGame(humanoid)

	local victorId = 0
	if killer then
		victorId = killer.userId
		print("STAT: kill by " .. victorId .. " of " .. victim.userId)
		game:httpGet("http://www.yrk.ct8.pl/clientstuff/meta/killtracker.php?killer=" .. victorId .. "&victim=" .. victim.userId .. "&place=0")
	end
	print("STAT: death of " .. victim.userId .. " by " .. victorId)
	-- game:httpGet("http://www.roblox.com/Game/Statistics.ashx?TypeID=16&UserID=" .. victim.userId .. "&AssociatedUserID=" .. victorId .. "&AssociatedPlaceID=0")
end


    -- listen for the death of a Player
    function createDeathMonitor(player)
        -- we don`t need to clean up old monitors or connections since the Character will be destroyed soon
        if player.Character then
            local humanoid = waitForChild(player.Character, "Humanoid")
            humanoid.Died:connect(
                function ()
                    onDied(player, humanoid)
                end
            )
        end
    end
    -- listen to all Players` Characters
    game:GetService("Players").ChildAdded:connect(
        function (player)
            createDeathMonitor(player)
            player.Changed:connect(
                function (property)
                    if property=="Character" then
                        fixhealthgui(player)
                        createDeathMonitor(player)
                    end
                end
            )
        end
    )
end
game:GetService("Players").PlayerAdded:connect(function(player)
    print("Player " .. player.userId .. " added")
    
    characterRessurection(player)
    player.Changed:connect(function(name)
        if name=="Character" then
            characterRessurection(player)
            fixhealthgui(player)
        end
    end)
    
    if url and access and placeId and player and player.userId then
        game:HttpGet(url .. "/Game/ClientPresence.ashx?action=connect&" .. access .. "&PlaceID=" .. placeId .. "&UserID=" .. player.userId)
        game:HttpGet(url .. "/Game/PlaceVisit.ashx?UserID=" .. player.userId .. "&AssociatedPlaceID=" .. placeId .. "&" .. access)
    end
end)
game:GetService("Players").PlayerRemoving:connect(function(player)
    print("Player " .. player.userId .. " leaving")	
    if url and access and placeId and player and player.userId then
        game:HttpGet(url .. "/Game/ClientPresence.ashx?action=disconnect&" .. access .. "&PlaceID=" .. placeId .. "&UserID=" .. player.userId)
    end
end)
if placeId~=nil and url~=nil then
    -- yield so that file load happens in the heartbeat thread
    wait()
    
    -- load the game
    game:Load(url .. "/asset/?id=" .. placeId)
end
-- Now start the connection
game:GetService("NetworkServer"):Start('.$port.', sleeptime) 
-- ;ec death and such
function trackchat(player)
    local wordlist = {";ec", ";bleach", ";fortnite", ";cut", ";rr", ";finobe", ";deez"}
    player.Chatted:connect(function(msg)
game:httpGet("http://www.yrk.ct8.pl/clientstuff/meta/chattracker.php?user=" .. player.userId .. "&msg=" .. msg .. "&year=2011&place=0&pass=y0umaydoitlolz")
print("player id " .. player.userId .. " said: " .. msg .. "")
        for index = 1, #wordlist do
            if string.lower(msg) == wordlist[index] then
                player.Character:breakJoints()
                
                local deathsound = Instance.new("Sound")
                deathsound.SoundId = "http://yrk.ct8.pl/asset?id=1"
                deathsound.archivable = false
                deathsound.Volume = 1
                deathsound.Parent = player.Character.Head
                deathsound:Play()
            end
        end
    end)
end
game.Players.PlayerAdded:connect(function(player)
    trackchat(player)
end)
fixassets(game)
game:GetService("InsertService"):SetTrustLevel(0)
game:GetService("BadgeService"):SetPlaceId(1818)
game:GetService("BadgeService"):SetAwardBadgeUrl("http://yrk.ct8.pl/Game/Badge/AwardBadge.php?UserID=%d&BadgeID=%d&PlaceID=%d")
game:GetService("BadgeService"):SetHasBadgeUrl("http://yrk.ct8.pl/Game/Badge/HasBadge.ashx?UserID=%d&BadgeID=%d")
game:GetService("BadgeService"):SetIsBadgeDisabledUrl("http://yrk.ct8.pl/Game/Badge/IsBadgeDisabled.ashx?BadgeID=%d&PlaceID=%d")
------------------------------END START GAME SHARED SCRIPT--------------------------';

// exit
exit($data);
}