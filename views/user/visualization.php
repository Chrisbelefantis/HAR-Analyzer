<?php
  session_start();
  

  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $section = 'visualization';
  }
  else
  {
    header("Location: ../auth");

  }


?>


<?php include 'templates/user/header.php'?>
<h1>Visualization</h1>

<?php include 'templates/user/footer.php'?>