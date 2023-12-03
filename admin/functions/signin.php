<?php

include __DIR__."/../../db.php";
include __DIR__."/../../variables.php";

$email=isset($_POST['email'])?$_POST['email']:null;
$password=isset($_POST["password"])?$_POST["password"]:null;



if(empty($email)){
    $errors["email"]="email is required";
}
if(empty($password)){
    $errors["password"]="Password is required";
}

if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header('Location: ../login.php');
    exit;
}
if(!empty($_POST)){
    $sql= "SELECT * FROM `admins` WHERE email = '{$email}' AND password = '$password' ;";

    $result=$conn->query($sql);
    if($conn->error){
        die("Query Error: " . $conn->error);
    }
    $row=$result->fetch_array();

    if($row['email']==$email && $row['password']==$password ){

        $admin=['name'=>$row['name'],'email'=>$row['email']];
        $_SESSION["admin"] = serialize($admin);
        $messages['success']="Admin successfully logged in";
        $_SESSION["messages"] =serialize($messages);
        header('Location: ./../index.php');
        exit;
        }else{
        $errors["login_failed"]="Incorrect credentials";

    }
    $conn->close();
}

if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header('Location: ../login.php');
    exit;
}