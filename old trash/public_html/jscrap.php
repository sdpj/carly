<script type="text/javascript">
 
chatroom(this.str);
 
function chatroom(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
    updateAll();
 
function updateAll()
{
xmlhttp.open("GET","ctgetaverage.php");
xmlhttp.send();
setTimeout(function(){ updateAll(); },3000);
}
}
</script>