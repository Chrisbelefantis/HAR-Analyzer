<?php

    require '../db_connection.php';
    $sql = "SELECT COUNT(request_method) as total FROM entries GROUP BY request_method";
    $stmt = mysqli_stmt_init($conn);
    $array_numberof_request_method = array();
    

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
        exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $array_numberof_request_method[] = $row['total'];
        }

        echo json_encode($array_numberof_request_method);
    }

?>