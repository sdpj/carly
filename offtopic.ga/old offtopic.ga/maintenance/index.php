<?php include "../src/nav.php";if (!$maintenance){header('location: /');}?>
<div class="card" style="width: 18rem;margin:auto;">
  
   <img class="card-img-top" src="/src/img/icon.png" alt="Card image cap" style="background:url(/src/img/maintenancebg.png)">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;">Maintenance</h5>
    <p class="card-text" style="text-align:center;">Amazing things are happening to <?php echo $name;?>! Check back soon!</p>
    <a href="/maintenance" class="btn btn-primary d-flex justify-content-center" style="margin:auto;">Refresh</a>
  </div>
</div>

<?php include "../src/footer.php"; ?>