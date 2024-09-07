$(document).ready(function() {
  $("#lSubmit").click(function() {
    if ($("#lSubmit").is(":disabled") == false) {
      $("#lSubmit").prop("disabled", true);
      $("#lUsername").prop("disabled", true);
      $("#lPassword").prop("disabled", true);
      $("#lForgot").prop("disabled", true);
      
      var user = $("#rUsername").val(); 
      var passwd = $("#rPassword1").val();
      //var csrf_token = $('meta[name="csrf-token"]').attr('content');
      $.post('/core/func/api/auth/login.php', {
        username: user,
        passwd: passwd,
       // csrf: csrf_token
      })
      .done(function(response) {
        $("#lSubmit").prop("disabled", false);
        $("#lUsername").prop("disabled", false);
        $("#lPassword").prop("disabled", false);
                $("#lForgot").prop("disabled", false);
        if (response == "error") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</div>");
        }else if (response == "missing-info") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please fill in all fields.</div>");
        }else if (response == "no-user") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">No user found with this name.</div>");
        }else if (response == "success") {
          window.location.reload();
        }else if (response == "incorrect-password") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Incorrect password specified.</div>");
        }else if (response == "rate-limit") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please wait a bit...</div>");
        }else if (response == "joe") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">joe</div>");
        }else{
                    $("#rStatus").html(response);
        }
      })
      .fail(function() {
                $("#rStatus").html("<div class=\"alert alert-danger\">shut the fuck up</div>");
      });
    }
  });

      $("#lForgot").click(function() {
    if ($("#lForgot").is(":disabled") == false) {
      $("#lSubmit").prop("disabled", true);
      $("#lUsername").prop("disabled", true);
      $("#lPassword").prop("disabled", true);
      $("#lForgot").prop("disabled", true);
      var user = $("#lUsername").val(); 
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      $.post('/core/func/api/auth/forgot.php', {
        username: user,
        csrf: csrf_token
      })
      .done(function(response) {
        $("#lSubmit").prop("disabled", false);
        $("#lForgot").prop("disabled", false);
        $("#lUsername").prop("disabled", false);
        $("#lPassword").prop("disabled", false);
        console.log(response);
        if (response == "no-user") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">User not found</div>");
        }else if (response == "rate-limit") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please wait</div>");
        }else if (response == "success") {
                    $("#rStatus").html("<div class=\"alert alert-success\">Check your email for a password reset link.</div>");
        }
      })
      .fail(function() {
                $("#rStatus").html("<div class=\"alert alert-danger\">Reset password request failed.</div>");
      });
    }
  })
});