<?php
    if(isset($_POST['register-button'])){

        require 'db_connection.php'; // For Variable $conn

        $username =  $_POST['username'];
        $email = $_POST['email'];
        $pwd_hashed = password_hash( $_POST['password'] , PASSWORD_DEFAULT);

        
        
        $sql = "INSERT INTO users (email, username, password, isAdmin) 
                VALUES ('{$email}'  , '{$username}' , '{$pwd_hashed}' , 0 ); ";
      
     
        if (mysqli_query($conn, $sql)) {

            echo "New record created successfully";

        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }
                
    }else{
        header("Location: ../auth");
        exit();
    }


?>