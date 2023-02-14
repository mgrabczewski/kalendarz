<?php
function dodaj_user($DAT, $conn){
  $newuser = new Person($_POST['newuser'], $_POST['newpassword']);
  $newuser->add($conn);
  //unset($newuser);
}
?>
