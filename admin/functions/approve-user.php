<?php

include __DIR__."/../../db.php";
include __DIR__."/../../variables.php";

$user_id=isset($_REQUEST["id"])?$_REQUEST['id']:null;


if(empty($user_id)){
    $errors['id']="Sorry! id of user not found";
}

if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header('Location:../user-registration.php');
    exit;
}

if($user_id){

    $sql="UPDATE `users` SET `is_approved`=1 WHERE `id`=$user_id ";

    $result=$conn->query($sql);
    if(!$result){
        $errors["query error"]="Query error: ".$conn->error;
        $_SESSION['errors']=serialize($errors);
        header('Location:../user-registration.php');
        exit;
    }else{
        $messages["success"]="User approved successfully";
        $_SESSION["messages"]=serialize($messages);
        $conn->close();
        header("Location:../user-registration.php");
        exit;
    }




}