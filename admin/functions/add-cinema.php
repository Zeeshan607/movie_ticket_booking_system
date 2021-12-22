<?php
include "../variables.php";
include "../db.php";


$name=isset($_POST['name'])?$_POST['name']:null;
$city=isset($_POST['city'])?$_POST['city']:null;
$address=isset($_POST['address'])?$_POST['address']:null;
$seats=isset($_POST['seats'])?$_POST['seats']:null;

if(empty($name)){
    $errors["name"]="Name field is required1";
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
    header("Location:../add-new-cinema.php");
    exit;
}

if(!empty($_POST)){

$sql= "INSERT INTO `cinemas`(`name`, `city`, `address`, `seats`) VALUES ('$name', '$city','$address', $seats)";

$result=$conn->query($sql);

if(!$result){
    $errors["query_error"]=$conn->error;
    $_SESSION["errors"]=serialize($errors);
    header("Location:../add-new-cinema.php");
    exit;
}else{
$messages["success"]="Cinema details added successfully";
$_SESSION['messages']=serialize($messages);
$conn->close();
header("Location:../cinema.php");
exit;
}


}


