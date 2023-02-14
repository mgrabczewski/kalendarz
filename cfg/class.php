<?php
class Person {
  public $user;
  public $password;

  public function __construct($user, $password){
    $this->user = $user;
    $this->password = $password;
  }
  public function add($conn) {
    return $conn->query("INSERT INTO users (user, password) VALUES ('".$this->user."', '".$this->password."')");
  }
}
?>
