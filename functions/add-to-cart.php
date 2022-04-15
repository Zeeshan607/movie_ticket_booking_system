<?php
include "./authenticate.php";
include "./variables.php";
include "./db.php";

if($user){

    $cinema_id=isset($_POST["cinema_id"])?$_POST['cinema_id']:null;
    $movie_id=isset($_POST["movie_id"])?$_POST["movie_id"]:null;
    $date=isset($_POST["date"])?$_POST["date"]:null;
    $time=isset($_POST["time"])?$_POST["time"]:null;
    $nmbr_of_seats=isset($_POST["nmbr_of_seats"])?$_POST["nmbr_of_seats"]:null;
    $seats=isset($_POST["seats"])?$_POST["seats"]:null;


    if(empty($cinema_id)){
        $errors['cinema_id']="OOps! something went wrong please try again";
    }

    if(empty($movie_id)){
        $errors['movie_id']="OOps! something went wrong please try again";
    }

    if(empty($date)){
        $errors['date']="OOps! something went wrong please try again";
    }

    if(empty($time)){
        $errors['time']="OOps! something went wrong please try again";
    }
    if(empty($nmbr_of_seats)){
        $errors['nmbr_of_seats']="OOps! something went wrong please try again";
    }
    if(empty($seats)){
        $errors['seats']="OOps! something went wrong please try again";
    }

    if(count($errors)){
        $_SESSION['errors']=serialize($errors);
        header("Location:../view-movie.php");
        exit;
    }



If(!empty($_POST)){










}










}
var_dump($_POST['seats']);
die();



