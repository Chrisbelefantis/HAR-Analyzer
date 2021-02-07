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


<div class="main-container">

    <div class="row">
        <div class="col-12 animation">
          <div style="width:auto; height:auto;">
                <canvas id="myTTLChart" style=" height:auto;"></canvas>
          </div>
        </div>
    </div>

</div>

<script src="../javascript/admin/http-headers-analysis.js"></script>
<?php include 'templates/admin/footer.php'?>