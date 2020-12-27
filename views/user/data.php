<?php
  session_start();
  
  if(isset($_SESSION['useremail']) && isset($_SESSION['password']))
  {
    $email = $_SESSION['useremail'];
    $password = $_SESSION['password'];
    $section = 'data';

  }
  else
  {
    header("Location: ../auth");

  }



  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $section = 'data';
   
  }
  else
  {
    header("Location: ../auth");
  }
?>




<?php include 'templates/user/header.php'?>


<div class="main-container">

  <div class="row">
    <div class="col-sm-12">

        <h4> Profile Informations </h4>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th >Informations</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>User-Name</td>
              <td><?php echo $user; ?></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><a href="">Change password</a></td>
            
            </tr>
            <tr>
              <td>Email</td>
              <td><?php echo $email; ?></td>
            </tr>
            
          </tbody>
        </table>
        <br>
        <h4> Data Information </h4>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th >Information</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
          
            <tr>
              <td>Date Of Last Upload</td>
              <td>Something</td>
            </tr>
            <tr>
              <td>Registrations</td>
              <td>Something</td>
            </tr>
          </tbody>
        </table>
      
    </div>
  </div>

  
  



<?php include 'templates/user/footer.php'?>