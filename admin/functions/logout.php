<?php
include "../variables.php";
session_start();

session_unset();
session_destroy();

session_start();
$messages['logout-success']="You are successfully logged out";
$_SESSION['messages']=serialize($messages);
header("Location: ../login.php");
exit;