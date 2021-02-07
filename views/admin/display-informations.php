<?php
 session_start();
  
 if(isset($_SESSION['useremail']))
 {
   $email = $_SESSION['useremail'];
   $section = 'display-informations';
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
    <div class="col-sm-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Information</th>
                <th >Values</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Users</strong></td>
                <td id="numberOfUsers"></td>
              </tr>
              <tr>
                <td><strong>Unique Domains</strong></td>
                <td id="numberUniqueDomains"></td>
              </tr>
              <tr>
                <td><strong>Number of Providers<strong></td>
                <td id="numberofproviders"></td> 
              </tr>            
            </tbody>
          </table>
    </div>  
  </div>

  <div class="row">
    <div class="col-lg-6 col-md-12 animation " style="width:auto;height:auto;">
        <div>
            <canvas id="myChart" style="padding:20px; height:auto;"></canvas>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 animation "style="width:auto;height:auto;">
        <div>
            <canvas id="myChartsecond" style="padding:20px; height:auto;"></canvas>
        </div>
    </div>      
  </div>

  <div class="row">
    <div class="col-12 animation">
      <div style="width:90%; height:auto;">
            <canvas id="myPieChart" style="margin:50px; height:auto; width:auto;"></canvas>
      </div>
    </div>
  </div>

</div>
  <script src="../javascript/admin/display-informations.js"></script>
<?php include 'templates/admin/footer.php'?>