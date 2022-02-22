<?php
include __DIR__."./../../variables.php";
include __DIR__."./../../db.php";

$id=isset($_REQUEST['id'])?$_REQUEST['id']:null;
$movie_id=isset($_POST['movie_id'])?$_POST['movie_id']:null;
$cinema_id=isset($_POST['cinema_id'])?$_POST['cinema_id']:null;
$playSlot1=isset($_POST['play_slot1'])?date('Y-m-d H:i:s',strtotime($_POST['play_slot1'])):null;
$playSlot2=isset($_POST['play_slot2'])?date('Y-m-d H:i:s',strtotime($_POST['play_slot2'])):null;
$playSlot3=isset($_POST['play_slot3'])?date('Y-m-d H:i:s',strtotime($_POST['play_slot3'])):null;
$playSlot4=isset($_POST['play_slot4'])?date('Y-m-d H:i:s',strtotime($_POST['play_slot4'])):null;


//
//var_dump($image);
//die;
if(empty($id)){
    $errors["id"]="Sorry, can't update data; Record id not found";
}
if(empty($movie_id)){
    $errors["movie_id"]="Movie field is required";
}
if(empty($cinema_id)){
    $errors["cinema_id"]="Cinema field is required";
}
if(empty($playSlot1)){
    $errors["playSlot1"]="Play_slot1  field is required";
}
if(empty($playSlot2)){
    $errors["playSlot2"]="Play_slot2 field are required  ";
}
if(empty($playSlot3) ){
    $errors["playSlot3"]="Play_slot3 field are required  ";
}
if(empty($playSlot4) ){
    $errors["playSlot4"]="Play_slot4 field are required  ";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-schedule.php?id=$id");
    exit;
}




if(!empty($_POST)){


//    $release_date=$release_date?date("Y-m-d", strtotime($release_date)):null;
    $sql= "UPDATE `schedules` SET `movie_id`=$movie_id, `cinema_id`=$cinema_id, `play_slot1`='$playSlot1', `play_slot2`='$playSlot2', `play_slot3`='$playSlot3', `play_slot4`='$playSlot4' WHERE `id`='$id'";



    $result=$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../edit-schedule.php?id=$id");
        exit;
    }else{
        $messages["success"]="schedule updated successfully";
        $_SESSION["messages"]=serialize($messages);
        $conn->close();
        header("Location:../schedule.php");
        exit;
    }


}
