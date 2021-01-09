<?php

      require 'db_connection.php';

      class response{
         public $isValid;

         function set_validity($isValid){
            $this->isValid = $isValid;
         }
      }

      $username = $_POST['username'];
      $currentPwd = $_POST['currentPwd'];
     /* $newPwd = $_POST['newPwd'];
      $confirmPwd = $_POST['confirmPwd'];*/

      $sql = "SELECT * FROM users WHERE username = ?;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {

			echo 'Failed SQL statement';
         exit();
         
		} else {

         mysqli_stmt_bind_param($stmt, "s", $username);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);

         $validity = new response();
         if ($row = mysqli_fetch_assoc($result)) {
         
            if ( $row['username'] == $username and password_verify($currentPwd, $row['password'])) {
               $validity->set_validity(True);
               echo json_encode($validity);    
            }
            else {
               $validity->set_validity(False);
               echo json_encode($validity);
            }
            
         }
      }


?>

 
