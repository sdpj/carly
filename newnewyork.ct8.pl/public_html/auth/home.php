<? include("head.php"); ?>
<title>Relive your favorite years with <?=$sitename;?></title>
<div class="row">
    <div class="col-12">
        <div class="carousel-text">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Relive Your Favorites.</h1>
                        <p><?=$sitename;?> is a revival like no other. No invite keys, multiple years, and free!</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="carouselIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image1.png" class="c-home d-block w-100" alt="An in game screenshot">
                </div>
                <div class="carousel-item">
                    <img src="image2.png" class="c-home d-block w-100" alt="An in game screenshot">
                </div>
                <div class="carousel-item">
                    <img src="image3.png" class="c-home d-block w-100" alt="An in game screenshot">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<div class="container container-one">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">How do I join?</h3>
            <p class="text-center">The only thing you have to do in order to join is register! No keys, no application, nothing like that. Click the button below to register.</p>
            <p class="text-center">
                <a href="/auth/register" class="btn btn-primary">Register</a>
            </p>
        </div>
    </div>
</div>

<div class="container-one bg-dark text-light">
    <div class="container container-one">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">What makes this place different?</h3>
                <div class="row mt-4 mb-4">
                    <div class="col-2 col-md-1">
                        <h1 class="text-center">&#x1f511;</h1>
                    </div>
                    <div class="col-10 col-md-11">
                        <p><span class="fw-bolder">No invite key required. </span>You don't need to be in the right friend group, constantly track discord servers, or buy keys from people - all you have to do is register to join.</p>
                    </div>
                </div>

<div class="row mt-4 mb-4">
                    <div class="col-2 col-md-1">
                        <h1 class="text-center">&#x1f5d3;&#xfe0f;</h1>
                    </div>
                    <div class="col-10 col-md-11">
                        <p><span class="fw-bolder">A variety of years to choose from. </span>Not only do we have many client years to play on, but we also have many site years. Be fully immersed while you game with others.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container container-one">
    <div class="row">
        <div class="col-12">
            <h3>Privacy Taken Seriously.</h3>
            <ul class="selling-points">
                <li>
                    <span class="fw-bolder">You don't have to provide any personal information. </span>The only thing we ask for during registration is your email address - this is only done to assist you if you forget your password.
                </li>
                <li>
                    <span class="fw-bolder">VPN use encouraged. </span>We highly recommend players use VPNs if they are able to - it helps you out a lot in the event that an exploit is discovered or our database is breached.
                </li>
            </ul>
        </div>
    </div>
</div>
<? include("footer.php"); ?>