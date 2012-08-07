<?php
class WorldState {
  private $id;
  private $attributes;
  
  public function __construct($id,$attributes) {
    $this->id = $id;
    $this->attributes = $attributes;
  }
  
  public function getId(){
    return $this->id;
  }
  
  public function getAttributes() {
    return $this->attributes;
  }
}
?>
