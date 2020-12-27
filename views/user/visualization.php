<?php
  session_start();
  
  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $section = 'visualization';

    //Includes are added to the head section
    $includes = array('<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>',
    ' <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>',
    '<script src="../plugins/heatmaps.js"></script>',
    '<script src="../plugins/leaflet-heatmap.js"></script>');
  }
  else
  {
    header("Location: ../auth");

  }
?>


<?php include 'templates/user/header.php'?>


<div id="mapid">

  <!-- <div class="backdrop">

    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>

  </div> -->

  <div class="alert alert-light alert-dismissible fade show" role="alert">
    This map illustrates the IP locations of all HTTP requests.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>

</div>





<script src="../javaScript/visualization.js"></script>
<?php include 'templates/user/footer.php'?>