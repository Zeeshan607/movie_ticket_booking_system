<?php
include_once __DIR__.'/../db.php';
include  __DIR__."/../variables.php";


$firstName=isset($_POST['first_name'])?$_POST['first_name']:null;
$lastName=isset($_POST['last_name'])?$_POST['last_name']:null;
$age=isset($_POST['age'])?$_POST['age']:null;
$gender=isset($_POST['gender'])?$_POST['gender']:null;
$address=isset($_POST['address'])?$_POST['address']:null;
$phone_number=isset($_POST['phone_number'])?$_POST['phone_number']:null;
$email=isset($_POST['email'])?$_POST['email']:null;
$password=isset($_POST["password"])?$_POST["password"]:null;



if(empty($firstName)){
    $errors["firstName"]="First name is required";
}
if(empty($lastName)){
    $errors["lastName"]="Last name is required";
}
if(empty($age)){
    $errors["age"]="age is required";
}
if(empty($gender)){
    $errors["gender"]="gender is required";
}
if(empty($address)){
    $errors["address"]="address is required";
}
if(empty($phone_number)){
    $errors["phone_number"]="phone_number is required";
}
if(empty($email)){
    $errors["email"]="email is required";
}
if(empty($password)){
    $errors["password"]="Password is required";
}

if(count($errors)){
   $_SESSION['u_errors']=serialize($errors);
    header('Location: ../register.php');
    exit;
}
if(!empty($_POST)){
    $name=$firstName." ".$lastName;
    $sql= "INSERT INTO `users` (`name`,`email`,`age`,`gender`,`address`,`phone_number`,`password`) VALUE ('$name','$email','$age','$gender','$address','$phone_number','$password');";

    $result=$conn->query($sql);
    if($conn->error){
        $errors["queryErr"]="Query Error: " . $conn->error;

    }
    if(count($errors)){
        $_SESSION['u_errors']=serialize($errors);
        header('Location: ../register.php');
        exit;
    }
    if($result){
        $messages['success']="Registration Complete. Please login after 24 hours while we approve your registration.";
        $_SESSION['u_messages']=serialize($messages);
        $conn->close();
        header('Location:../index.php');
        exit;
    }


}

