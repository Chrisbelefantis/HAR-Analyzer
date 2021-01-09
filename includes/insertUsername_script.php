<?php

    $newUsername = $_POST['newusername'];
    $currentUsername = $_POST['currentusername'];

    require 'db_connection.php';

    $sql = "UPDATE users SET username = \"$newUsername\" WHERE username = \"$currentUsername\" ";
    $run = mysqli_query($conn, $sql);

        if($run)
        {
            echo "Successful Changes";

        } else {
            echo "No Succesful Changes";
        }

?>