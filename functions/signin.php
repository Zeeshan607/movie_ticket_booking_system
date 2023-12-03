<?php

include_once  __DIR__.'/../db.php';
include  __DIR__."/../variables.php";

$email=isset($_POST['email'])?$_POST['email']:null;
$password=isset($_POST["password"])?$_POST["password"]:null;



if(empty($email)){
    $errors["email"]="email is required";
}
if(empty($password)){
    $errors["password"]="Password is required";
}

if(count($errors)){
    $_SESSION['u_errors']=serialize($errors);
    header('Location: ../login.php');
    exit;
}
if(!empty($_POST)){
    $sql= "SELECT * FROM `users` WHERE email = '{$email}' AND password = '$password' ;";

    $result=$conn->query($sql);
    if($conn->error){
        $errors['queryErr']="Query error: ".$conn->error;
        $_SESSION['u_errors']=serialize($errors);
        header('Location: ../login.php');
        exit;
    }
    $row=$result->fetch_array();

    if($row['email']==$email && $row['password']==$password ){
        if(!$row['is_approved']){
            $errors['Not approved']="Sorry! your New account registration is not approved yet. Try after some time Or 
            email to administrator at admin@cinematics.com ";
            $_SESSION['u_errors']=serialize($errors);
            header('Location: ../login.php');
            exit;
        }else{
          $user=['id'=>$row['id'],'name'=>$row['name'],'email'=>$row['email'],'phone_number'=>$row['phone_number']];
        $_SESSION["user"] = serialize($user);
        $messages['success']="You are successfully logged in";
        $_SESSION["u_messages"] =serialize($messages);
          $conn->close();
        header('Location: ./../index.php');
        exit;
        }
    }else{
        $errors["login_failed"]="Incorrect credentials";
        $_SESSION['u_errors']=serialize($errors);
        $conn->close();
        header('Location: ../login.php');
        exit;
    }


}

