<?php
class Module {
  private $enabled;
  private $status;
  private $id;
  private $displayName;
  
  public function __construct($id, $displayName, $enabled, $status) {
    $this->id = $id;
    $this->displayName = $displayName;
    $this->enabled = $enabled;
    $this->status = $status;
  }
  
  public function getId(){
    return $this->id;
  }
  
  public function getDisplayName() {
    return $this->displayName;
  }
  
  public function isEnabled() {
    return $this->enabled;
  }
  
  public function getStatus() {
    return $this->status;
  }
}
?>
