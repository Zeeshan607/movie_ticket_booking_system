<?php
session_start();
include_once ('../db.php');

$email=isset($_POST['email'])?$_POST['email']:null;
$password=isset($_POST["password"])?$_POST["password"]:null;
$errors  = [];

if(@empty($email)){
    $errors["email"]="email is required";
}
if(@empty($password)){
    $errors["password"]="Password is required";
}

if(count($errors)){
    setcookie("errors",serialize($errors),time()+60);
    header('Location: ../login.php');
    exit;
}
if(!empty($_POST)){
    $query= "SELECT * FROM `admins` WHERE email = '{$email}' AND password = '$password' ;";

    $result=$conn->query($query);
    if($conn->error){
        die("Query Error: " . $conn->error);
    }
    $row=$result->fetch_array();

    if($row['email']==$email && $row['password']==$password ){

        $_SESSION["admin"] = $row['id'];
//        die('session set' . $_SESSION["admin"]);
        $_SESSION["msg"] = "Admin successfully logged in";
        header('Location: ./../index.php');
        exit;
        }else{
        $errors["login_failed"]="Incorrect credentials";

    }
    $conn->close();
}

if(count($errors)){
    setcookie("errors",serialize($errors),time()+60);
    header('Location: ../login.php');
    exit;
}