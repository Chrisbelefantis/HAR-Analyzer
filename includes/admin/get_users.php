<?php

    require '../db_connection.php';
    $IsAdmin = 0;
    $sql = "SELECT COUNT(email) as total FROM users WHERE isAdmin = \"$IsAdmin\" ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
     exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            echo $row['total'];
        }else {
            echo "false";
        }
    }


?>