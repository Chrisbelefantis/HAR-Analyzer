<?php
  session_start();
  
  if(isset($_SESSION['useremail']))
  {
    $email = $_SESSION['useremail'];
    $section = 'data-visualization';

    //Includes are added to the head section
    $includes = array('<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>',
    ' <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>');
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

<div id="mapid" class="main-div main-container ">


  <svg class="pref-button" id="pref-button" width="90" height="90" viewBox="0 0 24 24"xmlns="http://www.w3.org/2000/svg">
    <path id="svg_11" d="m22.69815,23.00616l-11.36345,-0.04928l-7.67967,-3.36756l-2.71047,-7.84394l1.3963,-4.88706l3.12115,-3.61396l3.94251,-1.60164l4.88706,-0.41068l3.73717,1.35524l3.28542,3.44969l1.64271,5.54415c-0.08624,3.80835 -0.17248,7.6167 -0.25873,11.42505z" stroke-opacity="null" stroke-width="null" stroke="null" fill="#ffffff"/>
    <path id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z" fill="#0b032d"/>
    <path id="svg_3" d="m5.90095,11.95374c-1.313,-1.44646 -1.57692,-3.42038 -0.86265,-5.08043l2.63595,2.94532l2.5984,-0.48406l0.86098,-2.39831l-2.62929,-2.93848c1.80858,-0.43598 3.80108,0.09036 5.1083,1.5311c1.37862,1.51889 1.60423,3.62225 0.75094,5.32877l6.87085,7.57071c0.73109,0.8049 0.64203,2.02569 -0.19801,2.72593c-0.84004,0.69975 -2.11386,0.61517 -2.8447,-0.18973l-6.8628,-7.56324c-1.88912,0.58343 -4.04297,0.07822 -5.42797,-1.44757l0,0z" fill-opacity="null" stroke-opacity="null" stroke-width="null" stroke="null" fill="#0b032d"/>
  </svg>


</div>

<div class="modal fade" id="preferencesModal">
				<div class="modal-dialog modal-dialog-centered ">
					<div class="modal-content">
						<div class="modal-header">
							<h3 >Visualisation preferences</h3>
						</div>

						<div></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger custom" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-success custom" id="register">Register</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	


<script src="../javaScript/admin/data-visualization.js"></script>
<?php include 'templates/admin/footer.php'?>