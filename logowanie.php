<?php
  session_start();
  if((!isset($_POST['login'])) || (!isset($_POST['haslo']))){
    header('Location: www1.php');
    exit();
  }

  require_once 'cfg/sqlparametry.php';

  $login=$_POST['login'];
  $haslo=$_POST['haslo'];

  $login = htmlentities($login, ENT_QUOTES, "UTF-8");
  $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

  $zapytanie = "SELECT * FROM users WHERE user='$login' AND password='$haslo'";

  if($result = $conn->query($zapytanie)){
    $ile = $result->num_rows;
    if($ile>0){
    $_SESSION['logintrue'] = true;
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $row['user'];
    $_SESSION['id_user'] = $row['id'];

    unset($_SESSION['error']);
    mysqli_free_result($result);
    header('Location: plan.php');
    }
    else{
    $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło.</span>';
    header('Location: www1.php');
    }
  }
  $conn->close();
?>
