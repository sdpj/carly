<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php');?>
<?php if(isset($_GET['id'])&& $_GET['id'] == '1')
  {
    echo'<script src="https://unpkg.com/@ruffle-rs/ruffle"></script>
      <h2 style="text-align:center;">Super Mario Flash 1</h2>
<embed src="/files/swf/SMF1.swf" width="550" height="400" style="margin:auto;text-align:center;display:block;"> </embed>';
}
  else
    {
      echo '<div class="card-panel red white-text center-align lighten-1">This ID is invalid</div>';
        }
?>