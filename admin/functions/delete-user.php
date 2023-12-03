<?php

include __DIR__."/../../db.php";
include __DIR__."/../../variables.php";

$user_id=isset($_POST["id"])?$_POST['id']:null;


if(empty($user_id)){
    $errors['id']="Sorry! id of user not found";
}

if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header('Location:../user-registration.php');
    exit;
}

if($user_id){

    $sql="DELETE FROM `users` WHERE `id`=$user_id ";

    $result=$conn->query($sql);
    if(!$result){
        $errors["query error"]="Query error: ".$conn->error;
        $_SESSION['errors']=serialize($errors);
        header('Location:../user-registration.php');
        exit;
    }else{
        $messages["success"]="User deleted successfully";
        $_SESSION["messages"]=serialize($messages);
        $conn->close();
        header("Location:../user-registration.php");
        exit;
    }




}