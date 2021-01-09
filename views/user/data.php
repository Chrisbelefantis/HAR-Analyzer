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

          <h4> Profile Information </h4>
          <hr>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Labels</th>
                <th colspan="2">Data</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>User-Name</strong></td>
                <td><?php echo $user; ?></td>
                <td style="padding:0px;"><button type="button" class="btn btn-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                </svg>               
                Edit</button></td>
              </tr>
              <tr>
                <td><strong>Email</strong></td>
                <td colspan="2"><?php echo $email;?></td>
              </tr>
              <tr>
                <td><strong>Password<strong></td>
                <td colspan="2" style="padding:0px;">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#PasswordModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                </svg>               
                Change Password</button>
                <!-- Modal -->
                <div class="modal fade" id="PasswordModal">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="PasswordModalLabel">Change Your Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                          <div class="modal-body">                     
                              <form id="password-form">
                                  <div class="form-group input-container">
                                    <label for="CurrentPassword">Current Password</label>
                                    <input id='mail-crnpwd' type="password" class=" input form-control form-control-md" placeholder="********" name="crnpwd">
                                    <div class="invalid-feedback">Your Current Password is false</div>
                                  </div>
                                  

                                  <div class="form-group input-container">
                                    <label for="NewPassword">New Password</label>
                                    <input id='mail-newpwd' type="password" class=" input form-control form-control-md" placeholder="********" name="newpwd">
                                    <div class="invalid-feedback" >Please check the password format</div>
                                  </div>

                                  <div class="form-group input-container">
                                    <label for="RepeatPassword">Confirm Password</label>
                                    <input id='mail-rptpwd' type="password" class=" input form-control form-control-md" placeholder="********" name="rptpwd">
                                    <div class="invalid-feedback">Confirm Password with New password field must be the same</div>
                                  </div>
                                  
                                  <hr>
                                  <small id="passwordHelp" class="form-text text-muted"> New Password must consist of at least 8 chatacters, one capital letter, one number and a character (e.g. #$*&@).</small>
                                  
                                  <p id="form-message"></p>
                                  <p id="Success-message"></p> 
                                  
                                  <hr>

                                  <input type="hidden" id="myInput" value="<?php echo $user; ?>">
                                  
                              </form>

                              <div style="text-align:center;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id='mail-submit' type="submit" class="btn btn-primary">Save changes</button>
                              <div>
                              
                          </div>          
                    </div>
                  </div>
                </div>         
              </td> 
              </tr>            
            </tbody>
          </table>
          <br>

          <h4> Statistic Information </h4>
          <hr>
          <table class="table table-hover">
            <thead>
              <tr>
                <th >Information</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Date Of Last Upload<strong></td>
                <td>Something</td>
              </tr>
              <tr>
                <td><strong>Registrations</strong></td>
                <td>Something</td>
              </tr>
            </tbody>
          </table>
        
      </div>
    </div>

<?php include 'templates/user/footer.php'?>