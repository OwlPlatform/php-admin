<?php
class Attribute {
  private $name;
  private $value;
  private $origin;
  private $creation;
  private $expiration;
  
  public function __construct($name,$value,$origin,$creation,$expiration) {
    $this->name = $name;
    $this->value = $value;
    $this->origin = $origin;
    $this->creation = $creation;
    $this->expiration = $expiration;
  }
  
  public function getName(){
    return $this->name;
  }
  
  public function getValue(){
    return $this->value;
  }
  
  public function getOrigin(){
    return $this->origin;
  }
  
  public function getCreation(){
    return $this->creation;
  }
  
  public function getExpiration(){
    return $this->expiration;
  }
}
?>
