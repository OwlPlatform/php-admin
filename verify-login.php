<?php
session_start();
require_once('constants.php');
require_once(ABSPATH.'inc/user.php');

// Remove these lines for real authentication

$username=$_POST['login'];
trim($username);

if(empty($username)){

  if(!isset($_SESSION['login_attempts'])){
    $_SESSION['login_attempts'] = 1;
  }else {
    $_SESSION['login_attempts'] = $_SESSION['login_attempts'] + 1;
  }
    $_SESSION['error'] = 'Invalid username or password ('.$_SESSION['login_attempts'].').';
  header('location:login.php');
  exit;
}
unset($_SESSION['error']);

$username = stripslashes($username);

$_SESSION['currentUser'] = new User($username, 'Jane Smith');
if (isset($_SESSION['nextPage'])){
  header("location:".$_SESSION['nextPage']);
} else {
  header("location:index.php");
}
/*

$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
*/
?>
