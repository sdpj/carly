//javascript to submit users' comments
$(document).ready(function () {
	$('#submit_comment').submit(function (event) {
		
		event.preventDefault();
		
		console.log("Submitted");

		$.ajax({
			type: 'POST',
			url: 'post_comment.php',			
			data: $("#submit_comment").serialize(),
			success: function(data) {
				console.log(data);
			}               
		});
	});
});