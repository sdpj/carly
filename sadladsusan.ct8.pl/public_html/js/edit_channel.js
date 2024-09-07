//subscription functions...
function edit_avatar(user_id, avatar_url) { //url will alaso contain extension
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("demo").innerHTML = xmlhttp.responseText;
		document.getElementById("demo").innerHTML = "";
	  }
	};
	xmlhttp.open("GET", "edit_avatar.php?user="+user_id+"&avatar_data="+avatar_url, true);
	xmlhttp.send();
	//update the avatar on the channel page
	/*
	document.getElementById('yellow').innerHTML = "Subscribed";
	document.getElementById("yellow").disabled = true;
	*/
}
function show_avatar_popup() {
	//show popup
	var popup = document.getElementById("popup_edit_avatar");
	popup.style.display = "block";
}
function cancel() {
	//hide popup
	var popup = document.getElementById("popup");
	popup.style.display = "none";
}