<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$id=isset($_REQUEST['id'])?$_REQUEST['id']:null;
$movie_id=isset($_POST['movie_id'])?$_POST['movie_id']:null;
$cinema_id=isset($_POST['cinema_id'])?$_POST['cinema_id']:null;
$price_per_seat=isset($_POST['price_per_seat'])?$_POST['price_per_seat']:null;
$playSlot1=isset($_POST['play_slot1'])?date('H:i:s',strtotime($_POST['play_slot1'])):null;
$playSlot2=isset($_POST['play_slot2'])?date('H:i:s',strtotime($_POST['play_slot2'])):null;
$playSlot3=isset($_POST['play_slot3'])?date('H:i:s',strtotime($_POST['play_slot3'])):null;
$playDate=isset($_POST['play_date'])?date('Y-m-d',strtotime($_POST['play_date'])):null;


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
    $errors["playSlot2"]="Play_slot2 field is required  ";
}
if(empty($playSlot3) ){
    $errors["playSlot3"]="Play_slot3 field is required  ";
}
if(empty($playDate) ){
    $errors["playdate"]="Play date field is required  ";
}
if(empty($price_per_seat) ){
    $errors["pricePerSeat"]="Price per seat field is required  ";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-schedule.php?id=$id");
    exit;
}




if(!empty($_POST)){

    $sql= "UPDATE `schedules` SET `movie_id`=$movie_id , `cinema_id`=$cinema_id ,`price_per_seat`=$price_per_seat , `play_slot1`='$playSlot1', `play_slot2`='$playSlot2', `play_slot3`='$playSlot3', `play_date`='$playDate' WHERE `id`='$id'";



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
