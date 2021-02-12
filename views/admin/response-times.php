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


  <svg class="pref-button" id="pref-button" width="90" height="90" viewBox="0 0 24 24"xmlns="http://www.w3.org/2000/svg">
      <path id="svg_11" d="m22.69815,23.00616l-11.36345,-0.04928l-7.67967,-3.36756l-2.71047,-7.84394l1.3963,-4.88706l3.12115,-3.61396l3.94251,-1.60164l4.88706,-0.41068l3.73717,1.35524l3.28542,3.44969l1.64271,5.54415c-0.08624,3.80835 -0.17248,7.6167 -0.25873,11.42505z" stroke-opacity="null" stroke-width="null" stroke="null" fill="#ffffff"/>
      <path id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z" fill="#0b032d"/>
      <path id="svg_3" d="m5.90095,11.95374c-1.313,-1.44646 -1.57692,-3.42038 -0.86265,-5.08043l2.63595,2.94532l2.5984,-0.48406l0.86098,-2.39831l-2.62929,-2.93848c1.80858,-0.43598 3.80108,0.09036 5.1083,1.5311c1.37862,1.51889 1.60423,3.62225 0.75094,5.32877l6.87085,7.57071c0.73109,0.8049 0.64203,2.02569 -0.19801,2.72593c-0.84004,0.69975 -2.11386,0.61517 -2.8447,-0.18973l-6.8628,-7.56324c-1.88912,0.58343 -4.04297,0.07822 -5.42797,-1.44757l0,0z" fill-opacity="null" stroke-opacity="null" stroke-width="null" stroke="null" fill="#0b032d"/>
  </svg>

</div>

<div class="modal fade" id="preferencesModal">
				<div class="modal-dialog modal-dialog-centered ">
					<div class="modal-content">
						<div class="modal-header text-center">
              <h2 >Change Chart's Parameters</h2>
              
						</div>

              <div class='controls-container'>
                <div class="param-choice days text-center">
                  <!-- <h4>Day</h4> -->
                  <div class='my-btn-group'>
                    <button type="button"  class="btn">MONDAY</button>
                    <button type="button" class="btn">TUESDAY</button>
                    <button type="button" class="btn">WENDSDAY</button>
                    <button type="button" class="btn">THURSDAY</button>
                    <button type="button" class="btn">FRIDAY</button>
                    <button type="button" class="btn">SATURDAY</button>
                    <button type="button" class="btn">SUNDAY</button>
                    <button type="button" class="btn selected all-button">ALL</button>
                  </div>
                </div>

                <div class="param-choice methods text-center">
                  <!-- <h4>Method</h4> -->
                  <div class='my-btn-group'>
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
                  <!-- <h4>Content Type</h4> -->
                  <div class='my-btn-group'>
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
                  <!-- <h4>Provider</h4> -->
                  <div class='my-btn-group'>
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
                <button type="button" id="close" data-dismiss="modal" aria-hidden="true">close</button>
              </div>

              <div class="alert alert-danger alert-dismissible fade" role="alert">
                At least one of the options must be selected
              </div>
             
          </div> 
          
        </div>
        
      </div>
</div>
                      

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="../javaScript/admin/response-times.js"></script>
<?php include 'templates/admin/footer.php'?>