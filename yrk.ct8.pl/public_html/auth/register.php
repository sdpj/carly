<? include("head.php"); $authpage = "true"; include('../api/user/create_account.php'); ?>
<div class="container mt-4">
<? if($loginalert){ ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <p class="mb-0"><!--<span class="fw-bolder">Warning:</span> --><?=$loginalert;?></p>
                </div>
            </div>
        </div>
<? } ?>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card card-body">
                <h2>Register</h2>
                    <p>If you already have an account, you can <a href="/auth/login">login here</a>.</p>
                <form method="post">
                    <input type="text" placeholder="Username" name="username" class="form-control mb-1">
                    <input type="text" placeholder="Email" name="email" class="form-control mb-1">
                    <input type="password" placeholder="Password" name="password" class="form-control mb-1">
                    <input type="password" placeholder="Confirm Password" name="confirmpassword" class="form-control mb-1">
                        <p><a href="/auth/password-reset">Reset Password</a></p>
                    <!-- <div class="h-captcha mt-4 mb-2" data-sitekey="a772bf98-17e8-401c-b21a-5847ff1b9ac0" data-theme="light"></div> -->
                    <!--  <input name="__RequestVerificationToken" type="hidden" value="CfDJ8KI4wG7Y_lxMlWQNw9RZp1wTFYJfkjbto3835Ge0AuiLvEwBrgH8YsjeN17YcgpBrBIok5UFKX49ptYOQIUwUQgxiFPdRpTlkqWQUaW-qx9HLgtjP6OGUSXe34YyiG2AvQ8SO9Tr4nFh7nHZbKUgjaI">-->
                    <input class="btn btn-primary" type="submit" value="Register" id="login-submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<? include("footer.php"); ?>