<?php

    class request{
        public $c_lat;
        public $c_lng;
        public $s_lat;
        public $s_lng;
        public $count;

        function set_request($c_lat,$c_lng,$s_lat,$s_lng,$count){
            $this->c_lat = $c_lat;
            $this->c_lng = $c_lng;
            $this->s_lat = $s_lat;
            $this->s_lng = $s_lng;
            $this->count = $count;
        }
    }

    include "../db_connection.php";
    session_start();

    
    $sql = "SELECT  location, serverLocation, count(*)  FROM uploads INNER JOIN entries ON uploads.id=entries.upload GROUP BY  location, serverLocation ORDER BY count(*) DESC";
   
    $query_result = mysqli_query($conn,$sql);
    
    $results = [];

    while($row = mysqli_fetch_assoc($query_result))
    {
        $c_location = explode(',',$row['location']);
        $s_location = explode(',',$row['serverLocation']);
        $count=$row['count(*)'];
        
        $newRequest = new request();
        $newRequest->set_request($c_location[0],$c_location[1],$s_location[0],$s_location[1],$count);

        array_push($results,$newRequest);

    }

    $json_response = json_encode($results);

    echo $json_response;
?>