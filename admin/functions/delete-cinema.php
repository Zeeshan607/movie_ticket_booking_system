<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$cinema_id=isset($_POST['id'])?$_POST['id']:null;

if(empty($cinema_id)){
    $errors["cinema_id"]="No Cinema Id found! ID required";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../cinema.php");
    exit;
}

if(!empty($_POST)){
    $sql="DELETE FROM `cinemas` WHERE `id` = $cinema_id";


    $result=$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../cinema.php");
        exit;
    }else{
        $messages["success"]="Cinema Deleted successfully";
        $_SESSION['messages']=serialize($messages);
        $conn->close();
        header("Location:../cinema.php");
        exit;

    }
}