<?php
    if(isset($_POST['register-button'])){

        require 'db_connection.php'; // For Variable $conn

        $username =  $_POST['username'];
        $email = $_POST['email'];
        $pwd_hashed = password_hash( $_POST['password'] , PASSWORD_DEFAULT);

        
        
        $sql = "INSERT INTO users (email, username, password, isAdmin) 
                VALUES ('{$email}'  , '{$username}' , '{$pwd_hashed}' , 0 ); ";
      
     
        if (mysqli_query($conn, $sql)) {
            session_start();
			$_SESSION['username'] =$_POST['username'];
			$_SESSION['isAdmin'] = 0;
			$_SESSION['useremail'] =  $_POST['email'];
			$_SESSION['password'] =  $_POST['password'];
			header("Location: ../user");

        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
                
    }else{
        header("Location: ../auth");
        exit();
    }


?>