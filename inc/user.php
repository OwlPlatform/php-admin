<?php
class User {
  private $name;
  private $userName;

  public function __construct($userName, $name) {
    $this->name = $name;
    $this->userName = $userName;
    
  }
  
  public function getName(){
    return $this->name;
  }
  
  public function getUserName(){
    return $this->userName;
  }
}
?>
