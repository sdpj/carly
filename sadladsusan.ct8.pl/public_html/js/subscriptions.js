//subscription functions...
function subscribe(sub_from, sub_to) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("demo").innerHTML = xmlhttp.responseText;
		document.getElementById("demo").innerHTML = "";
	  }
	};
	xmlhttp.open("GET", "subscribe.php?data1="+sub_from+"&data2="+sub_to, true);
	xmlhttp.send();
	document.getElementById('yellow').innerHTML = "Subscribed";
	document.getElementById("yellow").disabled = true;
}
function confirm_unsubscribe() {
	//show popup
	var popup = document.getElementById("popup");
	popup.style.display = "block";
}
function cancel() {
	//hide popup
	var popup = document.getElementById("popup");
	popup.style.display = "none";
}
function unsubscribe(sub_from, sub_to) {
	//hide popup
	var popup = document.getElementById("popup");
	popup.style.display = "none";
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("demo").innerHTML = xmlhttp.responseText;
		document.getElementById("demo").innerHTML = "";
	  }
	};
	alert("unsubscribe.php?data1="+sub_from+"&data2="+sub_to);
	xmlhttp.open("GET", "unsubscribe.php?data1="+sub_from+"&data2="+sub_to, true);
	xmlhttp.send();
	document.getElementById('yellow').innerHTML = "Subscribe";
	document.getElementById("yellow").disabled = true;
}