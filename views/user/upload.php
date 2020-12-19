<?php
  session_start();
  

  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $section = 'upload';
  }
  else
  {
    header("Location: ../auth");

  }


?>


<?php include 'templates/user/header.php'?>

<h1>Upload Data</h1>
<?php include 'templates/user/footer.php'?>