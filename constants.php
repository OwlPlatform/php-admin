<?php
/*
  Constants for the entire application.  These values should never be 
  site- or installation-specific.  Instead, they should be fixed for all
  sites, or dyanmically-generated constants that adapt to various
  installations.
*/
  
  /*
   * From http://stackoverflow.com/questions/176712/how-can-i-find-an-applications-base-url
   * Provided by Andrew Moore http://stackoverflow.com/users/26210/andrew-moore
   */
  define("ABSPATH", str_replace('\\', '/', dirname(__FILE__)) . '/');

  $tempPath1 = explode('/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])));
  $tempPath2 = explode('/', substr(ABSPATH, 0, -1));
  $tempPath3 = explode('/', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));

  for ($i = count($tempPath2); $i < count($tempPath1); $i++)
      array_pop ($tempPath3);

  $urladdr = $_SERVER['HTTP_HOST'] . implode('/', $tempPath3);

  if ($urladdr{strlen($urladdr) - 1}== '/')
      define("URLADDR", 'http://' . $urladdr);
  else
      define("URLADDR", 'http://' . $urladdr . '/');

  unset($tempPath1, $tempPath2, $tempPath3, $urladdr);
  /*
   * End Andrew Moore's code
   */
  
  define("NULLDATE", mktime(0,0,0,1,1,1970));

?>
