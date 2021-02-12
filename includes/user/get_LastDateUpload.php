<?php

        require "../db_connection.php";
        session_start();
        $userEmail = $_SESSION['useremail'];

        $sql = "SELECT uploadDatetime FROM `uploads` WHERE userEmail = \"$userEmail\" ORDER BY `uploads`.`uploadDatetime` DESC LIMIT 1";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            echo 'Failed SQL statement';
            exit();

        }else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if ($row = mysqli_fetch_assoc($result)) {
                echo $row['uploadDatetime'];
            }else {
                echo "false";
            }
        }

?>