<?php
class Event {
  private $timestamp;
  private $message;
  private $extraInfo;
  
  public function __construct($timestamp, $message, $extraInfo){
    $this->timestamp = $timestamp;
    $this->message = $message;
    $this->extraInfo = $extraInfo;
  }
  
  public function getTimestamp() {
    return $this->timestamp;
  }
  
  public function getMessage() {
    return $this->message;
  }
  
  public function getExtraInfo() {
    return $this->extraInfo;
  }
}
?>
