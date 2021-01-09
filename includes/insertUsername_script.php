<?php

    $newUsername = $_POST['newUsername'];
    $currentUsername = $_POST['currentUsername'];

    require 'db_connection.php';

    $sql = "UPDATE users SET username = \"$newUsername\" WHERE username = \"$currentUsername\" ";
    $run = mysqli_query($conn, $sql);

        if($run)
        {
            session_start();
            $_SESSION['username'] = $newUsername ;
            echo "Successful Changes";

        } else {
            echo "No Succesful Changes";
        }

?>