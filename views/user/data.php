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


  if($_SESSION['isAdmin']==1){

    header("Location: ../accessDenied");
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
                <td class='usernameField'><?php echo $user; ?></td>
                <td style="padding:0px;">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#UserNameModal">
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
                <td id='DateLastUpload'></td>
              </tr>
              <tr>
                <td><strong>Time Of Last Upload<strong></td>
                <td id='TimeLastUpload'></td>
              </tr>
              <tr>
                <td><strong>Uploads</strong></td>
                <td id='numberOfRegistrations'></td>
              </tr>
            </tbody>
          </table>
        
      </div>
    </div>

    <!-- Username Modal -->
    <div class="modal fade" id="UserNameModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="UserNameModalLabel">Change Your Username</h5>
            <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"> 

                  <form id="username-form">
                      <div class="form-group input-container">
                        <label for="CurrentUsername">Current Username</label>
                        <input 
                          id='mail-crnusername' 
                          type="text" 
                          class=" input text-center form-control form-control-md"
                          name="crnusername"
                          disabled
                          value = <?php echo "$user" ?>
                          >
                      </div>
                      

                      <div class="form-group input-container">
                        <label for="NewUsername">New Username</label>
                        <input 
                          id='mail-newusername' 
                          type="text" 
                          class=" input form-control text-center form-control-md" 
                          name="newusername">
                        <div class="text-center invalid-feedback" id="mail-newusername-feedback"></div>
                      </div>
                     
                      <input type="hidden" id="usernamemyInput" value="<?php echo $user; ?>">

                      <p id="form-usernameMessage"></p>
                      <p id="Success-usernameMessage"></p>
      
                  </form>

                  <hr>

                  <div style="text-align:center;">
                        <button id='username-submit' type="submit" class="btn btn-primary">Save changes</button>
                  <div>
                  
                </div>          
            </div>
          </div>
        </div>    
      </div>
    </div>
     <!-- Password Modal -->
     <div class="modal fade" id="PasswordModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="PasswordModalLabel">Change Your Password</h5>
              <button type="button"  onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close">
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
                      
                        <hr>
                        <input type="hidden" id="myInput" value="<?php echo $user; ?>">
                        
                        <p id="form-message"></p>
                        <p id="Success-message"></p> 

                        
                        
                    </form>

                    <div style="text-align:center;">
                          <button id='mail-submit' type="submit" class="btn btn-primary">Save changes</button>
                    <div>
                    
                </div>          
          </div>
        </div>
      </div>       
    </div>
  </div>
  <script src="../javascript/user/data.js"></script>
<?php include 'templates/user/footer.php'?>