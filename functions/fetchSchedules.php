<?php

include "./../db.php";
include "./../variables.php";


$movie_id=isset($_GET['movie_id'])?$_GET['movie_id']:null;
$cinema_id=isset($_GET['cinema_id'])?$_GET['cinema_id']:null;


if(empty($movie_id)){
    $errors['movie_id']="Movie id not available";
}

if(empty($cinema_id)){
    $errors['cinema_id']="Cinema id not available";
}

if(count($errors)){
    echo json_encode($errors);
    exit;
}



if(isset($_GET)){


    $sql="SELECT * FROM `reservations`";
//    $sql="SELECT cinema_id as id, cinemas.name as cinema_name FROM `schedules`  INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movie_id ";
    $result=$conn->query($sql);

    if(!$result){
        echo "Query Err:".$conn->error;
        exit;
    }
//    $schedules=[];
    while($schedule=$result->fetch_object()){
        $schedules[]=$schedule;

    };


    if(count($schedules)){

        foreach($schedules as $schedule){
            echo $schedule->seat_id;
        }


        $conn->close();
        exit;
    }else{
        echo json_encode(['success'=>'No record found']);
        $conn->close();
        exit;
    }




}


