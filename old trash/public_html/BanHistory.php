<?php
include "Header.php";
$ID = mysql_real_escape_string($_GET['ID']);


header("Location: ../Administration/ManageUser.php?ID=$ID"); exit();
