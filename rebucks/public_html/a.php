<?php include "src/nav.php"; ?>
  <div class="p-5 text-center bg-image bg-light" style="/*background-image: url('/src/img/maintenancebg.png');background-size: cover;*/"> <!--nvm, the image didnt look too good on this-->
    <h1 class="mb-1">Welcome to <?php echo $name;?>!</h1>
    <h6 class="mb-5" style="font-weight:normal;">We are a new upcoming sandbox!</h6>
    <a class="btn btn-primary" href="" role="button">Login</a> <a class="btn btn-primary" href="" role="button">Register</a>
  </div>
<div class="row" style="margin-top: 1rem!important;">

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Creativity</div>
                    <div class="card-body">
                        <p class="card-text">Here at <?php echo $name;?>, we encourage creativity at all times. Unleash all of your creativity by creating items and selling them in the store, or even by customizing your avatar! The possibilities are endless!</p>
                    </div>
                </div>
            <!--</div>-->
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Communities</div>
                    <div class="card-body">
                        <p class="card-text">You can find the right community for you by searching through our groups and forums. No matter how unique your interests are, you'll always have people to talk about them with on <?php echo $name;?>!</p>
                    </div>
                </div>
            </div>
            <!--</div>-->

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Fun</div>
                    <div class="card-body">
                        <p class="card-text">Have fun by playing on our vast collection of worlds made by the community, or even make your own worlds! Start or join in a discussion on our forums! Hang out with the community and just be offtopic!</p>
                    </div>
                </div>
            </div>
            <!--</div>-->

</div>
<?php include "src/footer.php"; ?>