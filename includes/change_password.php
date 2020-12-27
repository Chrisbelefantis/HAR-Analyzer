<?php

    session_start();
    require 'db_connection.php';


    if (isset($_POST["Change-button"]) && isset($_SESSION['useremail']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {

        $userName = $_SESSION['username'];
        $userEmail = $_SESSION['useremail'];
        $password = $_SESSION['password'];
        $oldPwd = $_POST['oldpwd'];
        $curPwd = password_hash($_POST['currentpwd'], PASSWORD_DEFAULT);
        $cnfPwd = $_POST['confirmpwd'];
        $newunm = $_POST['newunm'];

        if (!password_verify($oldPwd, $password))
        {
            header("Location: ../user/data?error=Flase-OldPassword");
            exit();
        }
        else 
        {
            $sql = "SELECT * FROM users WHERE username = ? and email = ? and password = ?;";
            $stmt = mysqli_stmt_init($conn);
        
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
    
                echo 'Failed SQL statement';
                exit();
                
            } else {
                
                mysqli_stmt_bind_param($stmt, "sss", $userName, $userEmail, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) {
                    
                    if ( $row['username'] == $userName and $row['email'] == $userEmail and password_verify($oldPwd, $row['password']) ) {
    
                        if (password_verify($cnfPwd,$curPwd)) {
    
                            $conn = mysqli_query($conn, "UPDATE users set password = '$curPwd' WHERE email = '$userEmail'");
                            header("Location: ../user/data");
    
                        } 
                    }
    
                }
    
            }
    
        }

    } else {
        header("Location: ../auth");
        exit();
    }  

?>