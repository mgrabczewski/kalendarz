<?php
  session_start();
  require_once ('cfg/sqlparametry.php');
  require_once ('cfg/class.php');
  require_once('inc/funkcje.php');
  if (!isset($_SESSION['logintrue']))
  {
    //header('Location: www1.php');
    exit();
  }
  if (isset($_POST['rqt']))
  {
    require_once("rqt/". $_POST['rqt'] . '.rqt.php');
    $_POST['rqt']($_POST, $conn);
  }
  else{
    require_once('rqt/kalendarz.rqt.php');
    kalendarz($conn);
}
?>
