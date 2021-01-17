<?php

    $newpwd = $_POST['newPwd'];
    $username = $_POST['username'];
    $pwd_hashed = password_hash( $newpwd, PASSWORD_DEFAULT);

    require '../db_connection.php';

    $sql = "UPDATE users SET password = \"$pwd_hashed\" WHERE username = \"$username\" ";
    $run = mysqli_query($conn, $sql);

        if($run)
        {
            echo "Successful Changes";

        } else {
            echo "No Succesful Changes";
        }
?>
