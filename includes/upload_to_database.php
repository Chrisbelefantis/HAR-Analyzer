<?php
    include "db_connection.php";
    session_start();

    $data = json_decode($_POST['data']);

    $user_email = $_SESSION['useremail'];
    $user_location = $data->location;
    $user_provider = $data->provider;
    
    
    $sql_select_prov = "SELECT *
            FROM provider
            WHERE name=\"$user_provider\" ";

    $query_result = mysqli_query($conn,$sql_select_prov );

    
    if($row = mysqli_fetch_assoc($query_result )){
        $provider_id = $row['id'];

    }
    else{
        $sql_insert_prov = "INSERT INTO provider(name) VALUES (\"$user_provider\")";
        $run = mysqli_query($conn, $sql_insert_prov );
        $query_result = mysqli_query($conn,$sql_select_prov );
        $row = mysqli_fetch_assoc($query_result );
        $provider_id = $row['id'];
    }


    $sql_insert_upload = "INSERT INTO uploads(`userEmail`, `uploadDatetime`, `location`, `provider`) 
                        VALUES (\"$user_email\",NOW(),\"$user_location\", $provider_id) ";
    $run = mysqli_query($conn, $sql_insert_upload );
    
    

?>