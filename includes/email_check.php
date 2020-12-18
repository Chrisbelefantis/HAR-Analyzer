<?php
require 'db_connection.php';
$email=$_POST['email'];

$sql = "SELECT EXISTS(SELECT * FROM users WHERE email=\"$email\")";
$result=mysqli_query($conn, $sql);

$result = $result->fetch_array();
$final = intval($result[0]);

if($final==1){
  echo"false";
}else{
  echo"true";
}

?>