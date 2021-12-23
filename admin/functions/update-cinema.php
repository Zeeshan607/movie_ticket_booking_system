<?php
include "../variables.php";
include "../db.php";

$id= isset($_REQUEST['id'])?$_REQUEST['id']:null;
$name=isset($_POST['name'])?$_POST['name']:null;
$city=isset($_POST['city'])?$_POST['city']:null;
$address=isset($_POST['address'])?$_POST['address']:null;
$seats=isset($_POST['seats'])?$_POST['seats']:null;

if(empty($id)){
    $errors["id"]="Incorrect Request Url:id not found";
}

if(empty($name)){
    $errors["name"]="Name field is required";
}
if(empty($city)){
    $errors["city"]="City field is requried";
}
if(empty($address)){
    $errors["address"]="Address field is requried";
}
if(empty($seats)){
    $errors["seats"]="Seats field is requried";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-cinema.php");
    exit;
}

if(!empty($_POST)){

    $sql= "UPDATE `cinemas` SET `name`='$name',`city`='$city',`address`='$address',`seats`=$seats WHERE `id` = $id";

    $result=$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../edit-cinema.php?id=$id");
        exit;
    }else{
        $messages["success"]="Cinema details updated successfully";
        $_SESSION['messages']=serialize($messages);
        $conn->close();
        header("Location:../cinema.php");
        exit;
    }


}


