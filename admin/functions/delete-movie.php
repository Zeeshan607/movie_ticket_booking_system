<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$movie_id=isset($_POST['id'])?$_POST['id']:null;

if(empty($movie_id)){
    $errors["movie_id"]="No movie Id found! ID required";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../movie.php");
    exit;
}

if(!empty($_POST)){
    $sql="DELETE FROM `movies` WHERE `id` = $movie_id";


$result=$conn->query($sql);

if(!$result){
    $errors["query_error"]=$conn->error;
    $_SESSION["errors"]=serialize($errors);
    header("Location:../movie.php");
    exit;
}else{
    $messages["success"]="Movie deleted successfully";
    $_SESSION['messages']=serialize($messages);
    $conn->close();
    header("Location:../movie.php");
    exit;

}
}