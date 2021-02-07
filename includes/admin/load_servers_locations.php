<?php

    class targetLocation{
        public $lat;
        public $lng;
        public $count;

        function set_target_location($lat,$lng,$count){
            $this->lat = $lat;
            $this->lng = $lng;
            $this->count = $count;
        }
    }

    include "../db_connection.php";
    session_start();

    
    $sql = "SELECT serverLocation, count(*) FROM entries GROUP BY serverLocation ORDER BY count(*) DESC";
   
    $query_result = mysqli_query($conn,$sql);
    
    $results = [];

    while($row = mysqli_fetch_assoc($query_result ))
    {
        $location = explode(',',$row['serverLocation']);
        $count=$row['count(*)'];
        
        $newLocation = new targetLocation();
        $newLocation->set_target_location($location[0],$location[1],$count);

        array_push($results,$newLocation);

    }

    $json_response = json_encode($results);

    echo $json_response;
?>