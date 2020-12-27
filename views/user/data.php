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

    <h1>User Data</h1>
    <br>
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
              <td>Email</td>
              <td><?php echo $email; ?></td>
            </tr>
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
        <br>

          <h4> Change Password-UserName </h4>
          <hr>

        <form action='../includes/change_password.php' method='POST'>    
              <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>User-Name</th>
                        <th>Old Password</th>
                        <th>Current Password</th>
                        <th>Confirm Password</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input  type="text" id="newunm" placeholder="<?php echo $user; ?>" name="newunm" class="form-control"></td>
                        <td><input type="password" id="oldpwd" placeholder="********" name="oldpwd" class="form-control">
                          <div class="invalid-feedback" >Your password is false ! </div>
                        </td>
                        <td><input type="password" id="curpwd" placeholder="********" name="currentpwd" class="form-control">
                          <div class="invalid-feedback" >Please check the password format ! </div>
                        </td>
                        <td><input type="password" id="cnfpwd" placeholder="********" name="confirmpwd" class="form-control">
                          <div class="invalid-feedback">Your Confirm password must be the same with Current ! </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary" name="Change-button">Save Changes</button>

        </form>
  
    </div>
  </div>


<?php include 'templates/user/footer.php'?>