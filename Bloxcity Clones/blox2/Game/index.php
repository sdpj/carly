<?php
$title = "Games";


{
 
}
?>
<!--
 <div class="grid-x grid-margin-x">
<div class="large-6 large-offset-3 medium-12 small-12 cell">
-->
    <script src="/games/threejs/roboto.js?r=<?=rand()?>"></script>

		<style type="text/css">
		/* override */
.site-container-margin {
    padding-bottom: 0px !important;
    overflow: hidden !important;
    padding: 0px !important; /* 10px */
}
.grid-container{
    max-width: 1920px !important;
    margin: 0 auto !important;
}

			html, body {
				overflow:hidden !important;
				background-image: url("https://cdn.cnn.com/cnnnext/dam/assets/200310023417-01-xi-jinping-wuhan-0310-full-169.jpg")  !important;
				background-size: 100% !important;
			}

			.infobox {
				position:fixed;
				top:30px;
				left:50%;
				width:600px;
				height:360px;
				padding:10px 30px;
				margin:0 0 0 -300px;
				background:#7ec0ee;
				box-sizing:border-box;
			}

			.fade-out {
				opacity:0;
				transition:opacity 2000ms;
				-webkit-transition:opacity 2000ms;
			}
		</style>

		<div id="game">
		    <canvas width="1920" height="100"></canvas></div>

		<div id="infobox-intro" class="infobox fade-out">
			<h2>Welcome to BPRewritten test game!</h2>
			<p>This is a work in progress.</p>
		</div>
		<script src="/games/threejs/libs/stats.min.js?r=<?=rand()?>"></script>

		<script src="/games/threejs/libs/detector.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/libs/three.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/libs/cannon.js?r=<?=rand()?>"></script>

		<script src="/games/threejs/game/game.static.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.three.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.cannon.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.events.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.helpers.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.ui.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.core.demo1.js?r=<?=rand()?>"></script>
		<script src="/games/threejs/game/game.models.js?r=<?=rand()?>"></script>

		<script>
		console.log("BrickPlanet Rewritten Games v0.1 test");
		
			if (!Detector.webgl) {
				Detector.addGetWebGLMessage();
			} else {
				window.gameInstance = window.game.core();
				window.gameInstance.init({
					domContainer: document.querySelector("#game"),
					rendererClearColor: window.game.static.white
				});
			}

			// STATS VIA MONKEY PATCH
			(function() {
				var gameLoop = window.gameInstance.loop;
				var stats = new Stats();

				stats.domElement.style.position = "absolute";
				stats.domElement.style.left = "0px";
				stats.domElement.style.top = "0px";

				document.body.appendChild( stats.domElement );

				window.gameInstance.loop = function() {
					stats.begin();
					gameLoop();
					stats.end();
				}
			})();
		</script>
		<div id="stats" style="width: 80px; opacity: 0.9; cursor: pointer; position: absolute; left: 0px; top: 0px;">
		    <div id="fps" style="padding: 0px 0px 3px 3px; text-align: left; background-color: rgb(0, 0, 34);">
		        <div id="fpsText" style="color: rgb(0, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 9px; font-weight: bold; line-height: 15px;">26 FPS (0-60)</div>
		        <div id="fpsGraph" style="position: relative; width: 74px; height: 30px; background-color: rgb(0, 255, 255);">
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 15.6px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 12.9px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 12.3px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 12.9px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 12.6px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 12.3px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 13.5px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 12.9px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 13.8px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 15px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 17.1px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 13.5px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 20.4px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 18.3px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
		            <span style="width: 1px; height: 23.1px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span><span style="width: 1px; height: 17.1px; float: left; background-color: rgb(17, 17, 51);?r=<?=rand()?>"></span>
</div>
</div>

</div>
	
<!--
</div>
</div>
-->
<?php
//include('../../html/footer.php');
?>