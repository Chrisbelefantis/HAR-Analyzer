<?php

    require '../db_connection.php';
    $sql = "SELECT request_method FROM entries GROUP BY request_method";
    $stmt = mysqli_stmt_init($conn);
    $array_request_method = array();
    

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
        exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $array_request_method[] = $row['request_method'];
        }

        echo json_encode($array_request_method);
    }

?>