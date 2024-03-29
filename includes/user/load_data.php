<?php

    class locationRecord{
        public $lat;
        public $lng;
        public $count;

        function set_location($lat,$lng,$count){
            $this->lat = $lat;
            $this->lng = $lng;
            $this->count = $count;
        }

    }


    include "../db_connection.php";
    session_start();
    $userEmail = $_SESSION['useremail'];

    $sql = "SELECT serverLocation,uploads.userEmail, COUNT(*) as counter 
        FROM entries inner JOIN uploads 
        on entries.upload = uploads.id
        WHERE uploads.userEmail = \"$userEmail\"
        GROUP BY serverLocation";
   
    $query_result = mysqli_query($conn,$sql);
    
    $results = [];

    while($row = mysqli_fetch_assoc($query_result ))
    {
        $location = explode(',',$row['serverLocation']);
        $count = $row['counter'];
        
        $newLocation = new locationRecord();
        $newLocation->set_location($location[0],$location[1],$count);

        array_push($results,$newLocation);

    }

    $json_response = json_encode($results);

    echo $json_response;

?>