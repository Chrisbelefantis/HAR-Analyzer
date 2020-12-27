
<!DOCTYPE html>
<html>
<head>
	<title>Website</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Roboto:ital,wght@0,400;1,100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/auth.css">

</head>
<body>


<nav id="navbar" class="navbar navbar-custom justify-content-center">
    <a class="navbar-brand" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 35" width="24px" height="35px" fill="currentColor"><title>Analytics</title>
    <path d="M12,0a12,12,0,0,0,0,24H24V12A12,12,0,0,0,12,0ZM22,22H12A10,10,0,1,1,22,12Z"/>
    <polygon points="14.49 7.67 10.54 12.95 8.75 11.04 6.44 13.5 5 13.5 5 15.5 7.31 15.5 8.75 13.96 10.71 16.05 14.26 11.33 16.6 15.5 20 15.5 20 13.5 17.77 13.5 14.49 7.67"/>
    </svg> HAR Analyzer</a>
</nav>




  	<div class="container ">

  		<div class="row ">
  			<div class="col-md-7 col-sm-12 text-center pl-0 pr-0">
  			 	<div class="colored-div">
	  				<h1 class="display-4">Welcome</h1>
	  				<hr>
	  				<ul>
	  					<li>Upload your <strong>HTTP Archive</strong> files</li>
	  					<li>Clean all the unnecessary information</li>
	  					<li>Monitor your network traffic</li>
	  				</ul>
	  				<p class="font-italic">We make sure that all your data is private and cannot be shared with third parties.</p>
	  			</div>
  			</div>
  			<div class="col-md-5 col-sm-12 align-self-center" >
  				
  				
	  			<form action="includes/login_script.php" method="POST">
					  <div class="form-group">
					  	 <img src="images/login.png">
					    <label for="username">Username</label>
					    <input type="text" class="form-control"  placeholder="Username" id="username" name="username" aria-describedby="usernameHelp">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" placeholder="***********" id="exampleInputPassword1" name="password">

					 </div>
					 <div class="text-center">	
					   <button type="submit" class="btn btn-primary btn-sm btn-block" name="login-button">Login</button>
				     </div>
				</form>
				

					<?php
					

						if (isset($error)) {
							if ($error == 'emptyfields') {
								echo '<p style="text-align:center; color:red;"> Fill in all fields! </p>';
							}
							else if ($error == 'unSuccess-Login') {
								echo '<p style="color:red; text-align:center;">Username and Password don\'t match.</p>';
							}
							else if ($error == 'falsePassword') {
								echo '<p style="color:red; text-align:center;"> Your password is wrong. Please try again </p>';
							}
							else if ($error == 'falseUsername') {
								echo '<p style="color:red; text-align:center;"> Your Username is wrong. Please try again </p>';
							}
						}

					?>

				<hr>
					<div class="text-center">	
					   <button type="submit" class="btn btn-success btn-sm btn-block" data-toggle = "modal" data-target = "#registerModal">Register</button>
				   </div>
				</div>

		



			<!-- Here starts the Register Modal -->
			<div class="modal fade" id="registerModal">
				<div class="modal-dialog modal-dialog-centered ">
					<div class="modal-content">
						<div class="modal-header">
							<h3 >Register New User</h3>
						</div>
						<div class="modal-body">


							<form autocomplete="off" action='includes/registration_script.php' method='POST' class='reg-form'> 

								<div class="form-group input-container"  id="emailDiv">
									<label for="inputEmail">Email address</label>
									<input type="email" class=" input form-control form-control-md" placeholder="example@email.com" name="email" id="inputEmail" >
									<div class="invalid-feedback" id="email-invalid-feedback">Please use a valid email</div>
								</div>

								<div class="form-group input-container"  id="usernameDiv">
									<label for="inputUsername">Username</label>
									<input type="username" name="username" placeholder="Username" class=" input form-control form-control-md" id="inputUsername"   aria-describedby="usernameHelp">
									<div class="invalid-feedback" id="username-invalid-feedback">Please choose a username</div>
								</div>

								<div class="row">

									<div class="col-md-6 col-sm-12  input-container" id="password1div">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" name="password" placeholder="***********" class=" input form-control form-control-md"  id="inputPassword1">
										<div class="invalid-feedback" >Please check the password format</div>	
									</div>

									<div class="col-md-6 col-sm-12 input-container" id="password2div">
										<label for="exampleInputPassword1">Repeat password</label>
										<input type="password" placeholder="***********"  class="input form-control form-control-md" id="inputPassword2">
										<div class="invalid-feedback">Passwords in both fields must be the same</div>
									</div>

									<small id="passwordHelp" class="form-text text-muted">Password must consist of at least 8 chatacters, one capital letter, one number and a character (e.g. #$*&@).</small>

								</div>
								<button type="submit" class='register-button' name='register-button' style='display:none'></button>
							</form>
						
						</div>
						<div id="errorMessage"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger custom" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-success custom" id="register">Register</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	




		
		
		<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
<script src="javaScript/auth.js"></script> 

