<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$schedule_id=isset($_POST['id'])?$_POST['id']:null;

if(empty($schedule_id)){
    $errors["schedule_id"]="No schedule Id found! ID required";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../schedule.php");
    exit;
}

if(!empty($_POST)){
    $sql="DELETE FROM `schedules` WHERE `id` = $schedule_id";


$result=$conn->query($sql);

if(!$result){
    $errors["query_error"]=$conn->error;
    $_SESSION["errors"]=serialize($errors);
    header("Location:../schedule.php");
    exit;
}else{
    $messages["success"]="Schedule deleted successfully";
    $_SESSION['messages']=serialize($messages);
    $conn->close();
    header("Location:../schedule.php");
    exit;

}
}