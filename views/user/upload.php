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

<div class="main-container">
<div class = "file-container">
<table id="filesTable" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">File Name</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody id="tbody">
  </tbody>
</table>
</div>

<div class="button-container col-xs-6">

<button  id="dropButton" class="btn btn-danger ">
  <span><svg viewBox=" 0 0 24 35 " width="24" height="35" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
  <path id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z"/>
  <path id="svg_21" d="m4.63368,8.26166l3.57155,-3.52002l3.794,3.73923l3.794,-3.73923l3.57158,3.52002l-3.794,3.73926l3.794,3.73926l-3.57158,3.52005l-3.794,-3.73926l-3.794,3.73926l-3.57155,-3.52005l3.79397,-3.73926l-3.79397,-3.73926z" fill-opacity="null"  stroke-width="0.5" stroke="currentColor" fill="currentColor"/>

</svg></span>
  <span>Drop Files</span>
</button>

<button  id='downloadButton' disabled class="btn btn-main ">
  <span><svg viewBox=" 0 0 24 35 " width="24" height="35" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
<path id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z"/>
<rect id="svg_5" height="13.83663" width="1.54815" y="4.74303" x="11.12916"  stroke="currentColor" fill="currentColor"/>
<rect transform="rotate(45, 13.9352, 16.4026)" id="svg_6" height="7.06345" width="1.54815" y="12.87084" x="13.16112"  stroke="currentColor" fill="currentColor"/>
<rect transform="rotate(-45, 10.0164, 16.4026)" id="svg_7" height="7.06345" width="1.54815" y="12.87084" x="9.24235"  stroke="currentColor" fill="currentColor"/>
</svg></span>
  <span>Download Files</span>
</button>

<button  id="chooseButton" class="btn main-button btn-main ">
  <span><svg viewBox=" 0 0 24 35 " width="24" height="35" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
  <path id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z"/>
  <line stroke-linecap="null" stroke-linejoin="null" id="svg_5" y2="8.45424" x2="5.84804" y1="3.6013" x1="1.48529" stroke-opacity="null" stroke-width="null" stroke="null" fill="none"/>
  <path id="svg_19" d="m16.96773,6.4211c-1.05067,-0.98461 -2.18387,-1.77334 -3.11344,-1.88086c-0.05061,-0.00697 -0.10302,-0.01104 -0.15844,-0.01221l-6.11784,0c-0.0976,0 -0.19399,0.03662 -0.26267,0.10462c-0.06808,0.06626 -0.10844,0.15926 -0.10844,0.254l0,14.96671c0,0.09416 0.03795,0.18425 0.10844,0.25284c0.07049,0.06742 0.16326,0.10404 0.26267,0.10404l11.06333,0c0.0976,0 0.19098,-0.03604 0.26146,-0.10404c0.07049,-0.068 0.10965,-0.15809 0.10965,-0.25284l0,-9.9594c-0.02169,-1.15607 -0.9603,-2.41676 -2.0447,-3.47286zm1.30128,13.07248l-10.32111,0l0,-14.25063l5.74854,0l0,0.00116c0.25062,-0.01453 0.4669,0.22436 0.63257,0.77071c0.15061,0.5202 0.18857,1.1985 0.18796,1.66872c0.0012,0.34467 -0.01627,0.576 -0.01627,0.576l-0.02952,0.37896l0.3952,0.00407c0.00181,0 0.91331,0.01046 1.80734,0.20634c0.85909,0.17902 1.53082,0.5359 1.59347,0.93985c0.00241,0.03604 0.00301,0.07207 0.00241,0.10578l0,9.59904l-0.0006,0z"  stroke-width="null" stroke="currentColor" fill="currentColor"/>
</svg></span>
  <span>Choose HAR Files</span>
</button>

<button id='uploadButton' disabled class="btn btn-main ">
  <span><svg viewBox=" 0 0 24 35 " width="24" height="35" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
  <path style="vector-effect: non-scaling-stroke;" id="svg_1" d="m12,0a12,12 0 0 0 0,24l12,0l0,-12a12,12 0 0 0 -12,-12zm10,22l-10,0a10,10 0 1 1 10,-10l0,10z"/>
  <line style="vector-effect: non-scaling-stroke;" id="svg_5" y2="5.60721" x2="12.02197" y1="19.66129" x1="11.97803" stroke-width="2.5" stroke="currentColor" fill="currentColor"/>
  <line style="vector-effect: non-scaling-stroke;"transform="rotate(45, 14.046, 7.83036)"  id="svg_9" y2="7.83035" x2="17.7442" y1="7.83035" x1="10.3478"  stroke-width="2.5" stroke="currentColor" fill="currentColor"/>
  <line style="vector-effect: non-scaling-stroke;"transform="rotate(-45, 9.89311, 7.81259)"  id="svg_11" y2="7.81259" x2="13.51656" y1="7.81259" x1="6.26965"  stroke-width="2.5" stroke="currentColor" fill="currentColor"/>
</svg></span>
  <span>Upload HAR Files</span>
</button>

</div>

<input id="hiddenChooseButton"  type="file" id="files" name="files" multiple style="visibility:hidden">





</div>

<script src="../javaScript/upload.js"></script>
<?php include 'templates/user/footer.php'?>