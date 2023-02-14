<?php
session_start();
if(isset($_SESSION['logintrue'])&&($_SESSION['logintrue']==true)){
  header('Location: plan.php');
  exit();
}
echo 'PHP version: ' . phpversion();
?>

<html lang="pl">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1"/>
  <title>Plan tygodnia</title>
  <link rel="stylesheet" href="http://localhost/skrypty/kalendarz/jquery/jquery-ui.min.css">
  <script src="http://localhost/skrypty/kalendarz/js/jquery-3.6.0.js"></script>
  <script src="http://localhost/skrypty/kalendarz/js/skrypt.js"></script>
  <script src="http://localhost/skrypty/kalendarz/jquery/jquery-ui.min.js"></script>
  <script src="http://localhost/skrypty/kalendarz/js/jquery-ui.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div align = "center">
  <form style="margin-top: 300px" action = "logowanie.php" method = "post">
    Login:<br /><input type="text"name="login"/><br/>
    Hasło:<br /><input type="password"name="haslo"/><br/> <br/>
    <?php
    if(isset($_SESSION['error']))
    {
      echo'<div class="error">'.$_SESSION['error'].'</div>';
      unset($_SESSION['error']);
    }
   ?>
    <input class = "button-59" style="margin-top: 10px" type="submit"value="Zaloguj się"/>
  </form>
</div>
<div style = "text-align: center;">
<button class = "button-59" id = "zarejestruj"> Zarejestruj się! </button>
</div>
<div id = "dialog-form-newuser">
  <input type="text" name="newuser">   <input type="password" name="newpassword">
  <div id="dialog-error6" style="color:red; display: none">
    <p>
      To pole nie może zostać puste!
    </p>
  </div>
</div>
</body>
</html>
