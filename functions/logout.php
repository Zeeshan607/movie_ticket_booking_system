<?php
include __DIR__."./../variables.php";
session_start();


foreach($_SESSION as $key => $val)
{

    if ($key !== "admin" )
    {

        unset($_SESSION[$key]);

    }

}


session_start();
$messages['logout-success']="You are successfully logged out";
$_SESSION['u_messages']=serialize($messages);
header("Location: ../index.php");
exit;