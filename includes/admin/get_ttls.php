<?php

    class ContentType{
        public $response_contentType;
        public $avg_ttl;
        public $count;
        public $provider;



        function set_ContentType($response_contentType,$avg_ttl, $count, $provider){
            $this->response_contentType = $response_contentType;
            $this->avg_ttl = $avg_ttl;
            $this->count = $count;
            $this->provider=$provider;

        }

    }

    require '../db_connection.php';
    $sql = "SELECT response_contentType,AVG(response_TTL), COUNT(*), provider.name FROM uploads INNER JOIN entries ON entries.upload=uploads.id INNER JOIN provider ON provider.id=uploads.provider WHERE entries.response_TTL IS NOT NULL GROUP BY response_contentType ORDER BY AVG(response_TTL) DESC";
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
            $attl = $row['AVG(response_TTL)'];
            $count= $row['COUNT(*)'];
            $prov=$row['name'];

            $newCT= new ContentType();
            $newCT->set_ContentType($ct, $attl, $count, $prov);
            array_push($array_content_type, $newCT);

        }

        echo json_encode($array_content_type);

    }
    
?>