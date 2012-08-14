<?php
class User {
  private $login;
  private $name;

  public function __construct($login, $name) {
    $this->login = $login;
    $this->name = $name;
    
  }
  
  public function getName(){
    return $this->name;
  }
  
  public function getLogin(){
    return $this->login;
  }
}
?>
