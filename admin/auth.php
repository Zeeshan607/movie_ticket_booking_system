<?php
if(!session_id()){
    session_start();
}
if(!(isset($_SESSION['admin']))){
    header('Location: ./login.php');
    exit;
}else{
    if(isset($_SESSION['admin'])){
        $admin=unserialize($_SESSION['admin']);
    }else{
        $admin=false;
    }
}
?>