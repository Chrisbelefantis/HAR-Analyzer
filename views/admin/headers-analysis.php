<?php
 session_start();
  
 if(isset($_SESSION['useremail']))
 {
   $email = $_SESSION['useremail'];
   $section = 'headers-analysis';
 }
 else
 {
   header("Location: ../auth");
 }

 if($_SESSION['isAdmin']==0){
   header("Location: ../accessDenied");
 }

?>




<?php include 'templates/admin/header.php'?>

<h3>Header analysis</h3>


<?php include 'templates/admin/footer.php'?>