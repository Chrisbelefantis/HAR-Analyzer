<?php
require 'db_connection.php';
$username=$_POST['username'];

$sql = "SELECT EXISTS(SELECT * FROM users WHERE username=\"$username\")";
$result=mysqli_query($conn, $sql);

$result = $result->fetch_array();
$final = intval($result[0]);

if($final==1){
  echo"false";
}else{
  echo"true";
}

?>