<?php
    include "includes/db_connection.php";


    $sql_methods = "SELECT `request_method` 
    FROM `entries` 
    GROUP BY `request_method`
    ";

    $sql_content_types = "SELECT `response_contentType`,COUNT(*) 
    FROM `entries` 
    WHERE response_contentType!='unknown' 
    GROUP BY `response_contentType` 
    ORDER BY COUNT(*) 
    DESC LIMIT 7
    ";

    $sql_providers = "SELECT *
    FROM  `provider`";

    $request_methods = [];
    $request_content_types = [];
    $request_providers = [];

    $query_result = mysqli_query($conn,$sql_methods);

    
    while($row = mysqli_fetch_assoc($query_result ))
    {
        array_push($request_methods,$row['request_method']);
        
    }

    $query_result = mysqli_query($conn,$sql_content_types);

    while($row = mysqli_fetch_assoc($query_result ))
    {
        // $request_content_type= strtoupper(explode('/', $row['response_contentType'])[1]);
        $request_content_type= strtoupper($row['response_contentType']);
        array_push($request_content_types, $request_content_type);
        
    }

    $query_result = mysqli_query($conn,$sql_providers);

    while($row = mysqli_fetch_assoc($query_result ))
    {
        $request_provider= strtoupper(explode(' ', $row['name'])[0]);

        array_push($request_providers, $request_provider);
        
    }



?>