<?php
  class connectivity {
    public static function createDatabaseConnection() {
      $db_username = "m27001_rhodumre";
      $db_password = "FinalZ1#";
      $db_database = "m27001_rhodumrebootedrebooted";
      $db_host = "mysql.ct8.pl";
      $db_port = 3306;
      try{
        $GLOBALS['dbcon'] = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_database, $db_username, $db_password);
        $GLOBALS['dbcon']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $GLOBALS['dbcon']->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $GLOBALS['dbcon']->setAttribute(PDO::ATTR_PERSISTENT , true);
      }catch (exception $e) {
        echo 'We could not connect to the database. Our rats are working on it.';
        exit;
      }
    }
    
    public static function closeDatabaseConnection() {
      if (isset($GLOBALS['dbcon'])) {
        $GLOBALS['dbcon'] = null;
      }
    }
  }
?>
