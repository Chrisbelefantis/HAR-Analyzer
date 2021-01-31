<?php

    class ContentType{
        public $response_contentType;
        public $avg_age;
        public $count;


        function set_ContentType($response_contentType,$avg_age,$count){
            $this->response_contentType = $response_contentType;
            $this->avg_age = $avg_age;
            $this->count = $count;
        }

    }

    require '../db_connection.php';
    $sql = "SELECT response_contentType,AVG(response_age),COUNT(*) FROM entries WHERE response_age IS not NULL GROUP BY response_contentType ORDER BY AVG(response_age) DESC";
    $stmt = mysqli_stmt_init($conn);
   
    
    $array_content_type=array();
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'Failed SQL statement';
        exit();
     
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $ct=$row['response_contentType'];
            $are=$row['AVG(response_age)'];
            $cnt=$row['COUNT(*)'];

            $newCT= new ContentType();
            $newCT->set_ContentType($ct, $are, $cnt);

            array_push($array_content_type, $newCT);
        }

        echo json_encode($array_content_type);
    }

?>