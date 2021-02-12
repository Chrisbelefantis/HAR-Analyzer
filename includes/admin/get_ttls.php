<?php

    class ContentType{
        public $response_contentType;
        public $response_TTL;
        public $provider;



        function set_ContentType($response_contentType, $response_TTL, $provider){
            $this->response_contentType = $response_contentType;
            $this->response_TTL = $response_TTL;
            $this->provider= $provider;

        }

    }

    require '../db_connection.php';
    $sql = "SELECT response_contentType,response_TTL, provider.name ,`response_hasMinFresh`,
    `response_hasMaxStale`,`response_	cacheability` FROM uploads 
    INNER JOIN entries ON entries.upload=uploads.id 
    INNER JOIN provider ON provider.id=uploads.provider 
    WHERE entries.response_TTL IS NOT NULL ORDER BY response_TTL DESC";

    $stmt = mysqli_stmt_init($conn);
    $array_content_type=array();

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
     exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $ct = $row['response_contentType'];
            $rttl = $row['response_TTL'];
            $prov=$row['name'];

            $newCT= new ContentType();
            $newCT->set_ContentType($ct, $rttl, $prov);
            array_push($array_content_type, $newCT);

        }

        echo json_encode($array_content_type);

    }
    
?>