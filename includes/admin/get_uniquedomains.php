<?php

    require '../db_connection.php';
    $sql = "SELECT request_url FROM entries GROUP BY request_url";
    $stmt = mysqli_stmt_init($conn);
    $number_of_domains = 0;

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
        exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $number_of_domains = $number_of_domains + 1;
        }

        echo $number_of_domains;
    }

?>