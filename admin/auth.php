<?php
if(!session_id()){
    session_start();
}
if(!($_SESSION['admin']== 1)){
    header('Location: ./login.php');
    exit;
}
?>