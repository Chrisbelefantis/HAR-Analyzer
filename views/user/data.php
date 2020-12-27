<?php
  session_start();
  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $section = 'data';
   
  }
  else
  {
    header("Location: ../auth");
  }
?>

<?php include 'templates/user/header.php'?>



<h1>User Data</h1>



<?php include 'templates/user/footer.php'?>