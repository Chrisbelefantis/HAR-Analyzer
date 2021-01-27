<?php

    class dataRecord{
        public $hours;
        public $waitingTimes;
        public $count;
        public $query;

        function set_data($hours,$waitingTimes){
            $this->hours = $hours;
            $this->waitingTimes = $waitingTimes;
        
        }
        function set_count($count){
            $this->count = $count;
        }
        function set_query($query){
            $this->query = $query;
        }

    }


    include "../db_connection.php";
    session_start();

    
    $options = json_decode($_GET['options']);

    //Contructing the WHERE clause of our query
    $where_clause = '';
    $where_clause_components = [];
    $days = [];
    $methods = [];
    $content_types = [];
    $providers = [];

    if(is_array($options->days)){
        for($i=0; $i<count($options->days); $i++){
            array_push($days,' day = "'.$options->days[$i].'"');
        }
        $current_component = '('.implode(' OR ', $days).')';
        array_push($where_clause_components,$current_component );
    }


    if(is_array($options->methods)){
        for($i=0; $i<count($options->methods); $i++){
            array_push($methods,' request_method = "'.$options->methods[$i].'"');
        }
        $current_component = '('.implode(' OR ', $methods).')';
        array_push($where_clause_components,$current_component );
    }

    if(is_array($options->contentTypes)){
        for($i=0; $i<count($options->contentTypes); $i++){

            $current_content_type = strtolower($options->contentTypes[$i]);

            array_push($content_types,' response_contentType LIKE "%'.$current_content_type .'%"');
        }
        $current_component = '('.implode(' OR ', $content_types).')';
        array_push($where_clause_components,$current_component );
    }

    if(is_array($options->providers)){
        for($i=0; $i<count($options->providers); $i++){

            $current_provider= $options->providers[$i];

            array_push($providers,' provider.name LIKE "'.$current_provider .'%"');
        }
        $current_component = '('.implode(' OR ', $providers).')';
        array_push($where_clause_components,$current_component );
    }


    if(count($where_clause_components)>0){
        $where_clause = 'WHERE'.implode(' AND ',$where_clause_components);
    }
    



    $sql = "SELECT time,AVG(timingsWait),COUNT(*)
    FROM `uploads` 
    INNER JOIN `entries` 
    ON entries.upload = uploads.id 
    INNER JOIN `provider`
    ON uploads.provider = provider.id
    $where_clause
    GROUP BY time
    ";
   

   $query_result = mysqli_query($conn,$sql);

   $hours = [];
   $waitingTimes = [];
   $count = 0;

    if($query_result){
        while($row = mysqli_fetch_assoc($query_result )){
                array_push($hours,$row['time'].':00');
                array_push($waitingTimes,$row['AVG(timingsWait)']);
                $count = $count + $row['COUNT(*)'];
        }
    }

    $data = new dataRecord();
    $data->set_data($hours ,$waitingTimes );
    $data->set_count($count);
    $data->set_query(preg_replace("/\r|\n|\s+/", " ", $sql));

    $json_response = json_encode($data);

    echo $json_response;
 

?>