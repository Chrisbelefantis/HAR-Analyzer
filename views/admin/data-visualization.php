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
<script src="../plugins/leaflet.curve.js"></script>

<div id="mapid" class="main-div main-container ">
  <div id="scale_div"class="scale">
  <span style="width:12.1%">0</span>
  <span style="width: 12.1%">10</span>
  <span style="width: 12.1%">20</span>
  <span style="width: 12.1%">30</span>
  <span style="width: 12.1%">40</span>
  <span style="width: 12.1%">50</span>
  <span style="width: 12.1%">60</span>
  <span style="width: 12.1%">70</span>
  </div>
</div>

<script src="../javaScript/admin/data-visualization.js"></script>
<?php include 'templates/admin/footer.php'?>