<?php include "../header.php"; 

if($myu->admin != "true"){
    header("Location:..");
}
?>
<style>body{background-color:#fff!important;}</style>
<?
if(isset($_POST['save'])){
$hi = $handler->query("INSERT INTO blog (author, title, content) VALUES ('$myu->id','".mysql_real_escape_string($_POST["title"])."','".mysql_real_escape_string($_POST["post"])."')");
Header("Location: /Blog/ShowPost.php?id=".$handler->lastInsertId()); exit; die();
}
?>


<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Blog/"><?=$sitename;?> Blog</a></p>
      </div>
   </div>
   <h3 class="mt-4 mb-4">New Post</h3>
   <table class="w-100">
      <thead>
         <tr>
            <td class="leftTable-0-2-56"></td>
            <td></td>
         </tr>
      </thead>
      <tbody>
      <form action="" method="POST">
         <tr>
            <td class="fw-bolder text-end">Subject:</td>
            <td><input type="text" class="w-100" name="title"> </td>
         </tr>
         <tr>
            <td class="fw-bolder text-end align-top">Body:</td>
            <td><textarea class="w-100" rows="12" name="post"></textarea><input type="submit" name="save" class="mt-1" value="Post" style="border: 2px solid black;"></td>
         </tr>
       </form>
      </tbody>
   </table>
</div>


<?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>