<?php
 session_start();
  
 if(isset($_SESSION['useremail']))
 {
   $email = $_SESSION['useremail'];
   $section = 'response-times';
 }
 else
 {
   header("Location: ../auth");
 }

 if($_SESSION['isAdmin']==0){
   header("Location: ../accessDenied");
 }

include "includes/admin/waiting_times_params.php";



?>

<?php include 'templates/admin/header.php'?>

<div class="main-container">
  
  <div class="chart-container">
    <div class='chart-title'>
      <h3>Avarage Response Time</h3>
      <span class='chart-samples'></span>
    </div>
    <canvas id="myChart"></canvas>
  </div>


  <div class='controls-container'>
    <div class="param-choice days text-center">
      <h4>Day of the Week</h4>
      <div class="btn-group" role="group" aria-label="Button group">
        <button type="button"  class="btn">MO</button>
        <button type="button" class="btn">TU</button>
        <button type="button" class="btn">WE</button>
        <button type="button" class="btn">TH</button>
        <button type="button" class="btn">FR</button>
        <button type="button" class="btn">SU</button>
        <button type="button" class="btn">SA</button>
        <button type="button" class="btn selected all-button">ALL</button>
      </div>
    </div>

    <div class="param-choice methods text-center">
      <h4>HTTP Request Method</h4>
      <div class="btn-group" role="group" aria-label="Button group">
        <?php
          for($i=0 ; $i<count($request_methods); $i++){
            echo "<button type=\"button\" class=\"btn\">
            $request_methods[$i]
            </button>";
          }
        ?>
        <button type="button" class="btn selected all-button">ALL</button>
      </div>
    </div>

    <div class="param-choice content-types text-center">
      <h4>Response Content Types</h4>
      <div class="btn-group" role="group" aria-label="Button group">
        <?php
          for($i=0 ; $i<count($request_content_types); $i++){
            echo "<button type=\"button\" class=\"btn\">
            $request_content_types[$i]
            </button>";
          }
        ?>
        <button type="button" class="btn selected all-button">ALL</button>
      </div>
    </div>



    <div class="param-choice providers text-center">
      <h4>Internet Provider</h4>
      <div class="btn-group" role="group" aria-label="Button group">
        <?php
          for($i=0 ; $i<count($request_providers); $i++){
            echo "<button type=\"button\" class=\"btn\">
            $request_providers[$i]
            </button>";
          }
        ?>
        <button type="button" class="btn selected all-button">ALL</button>
      </div>
    </div>

    </div>
   
  </div>

  <div class="alert alert-danger alert-dismissible fade" role="alert">
    At least one of the options must be selected
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="../javaScript/admin/response-times.js"></script>
<?php include 'templates/admin/footer.php'?>