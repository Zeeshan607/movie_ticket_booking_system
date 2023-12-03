<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$id= isset($_REQUEST['id'])?$_REQUEST['id']:null;
$name=isset($_POST['name'])?$_POST['name']:null;
$image=isset($_FILES['image'])?$_FILES['image']:null;
$genre=isset($_POST['genre'])?$_POST['genre']:null;
$imdb_ratings=isset($_POST['imdb_ratings'])?$_POST['imdb_ratings']:null;
$release_date=isset($_POST['release_date'])?$_POST['release_date']:null;
$is_upcoming=isset($_POST['is_upcoming'])?1:0;
//
//var_dump($image);
//die;
if(empty($id)){
    $errors["id"]="Sorry, can't update data; Record id not found";
}
if(empty($name)){
    $errors["name"]="Name field is required";
}

if(empty($genre)){
    $errors["genre"]="genre field is required";
}
if(empty($imdb_ratings) ){
    $errors["imdb_ratings"]="imdb_ratings are required  ";
}
if(empty($release_date)){
    $errors["release_date"]="Release date of movie is required";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-movie.php?id=$id");
    exit;
}

if($image['size']!==0){



$fileName=pathinfo(basename($image['name']), PATHINFO_FILENAME);
$fileName=str_replace(' ','_',$fileName);
$fileExtension=pathinfo(basename($image['name']),PATHINFO_EXTENSION);
$fileNameToStore=$fileName.time().'.'.$fileExtension;

if(!in_array(strtolower($fileExtension),['jpeg','jpg','png'])){
    $errors["wrong_file_format"]="Wrong file type; only .jpeg, .jpg, .png types are allowed";
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-movie.php?id=$id");
    exit;
}

if($image['size'] > 5000000){
    $errors["fileSize"]="Sorry file is too large. max size 5mb allowed";
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-movie.php?id=$id");
    exit;
}

if(!file_put_contents( "../../assets/uploads/".$fileNameToStore,file_get_contents($image['tmp_name']))){
    $errors["fileUpload"]="Sorry, there was an error uploading your file.";
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-movie.php?id=$id");
    exit;
}
}


if(!empty($_POST)){

    if($image['size']==0 ){
            $release_date=$release_date?date("Y-m-d", strtotime($release_date)):null;
            $sql= "UPDATE `movies` SET `name`='$name',`genre`='$genre',`imdb_ratings`=$imdb_ratings, `is_upcoming`=$is_upcoming, `release_date`='$release_date' WHERE `id` = $id";
    }else{
            $release_date=$release_date?date("Y-m-d", strtotime($release_date)):null;
            $sql= "UPDATE `movies` SET `name`='$name',`genre`='$genre',`imdb_ratings`=$imdb_ratings, `image`='$fileNameToStore',`is_upcoming`=$is_upcoming, `release_date`='$release_date' WHERE `id` = $id";
    }



    $result=$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../edit-movie.php?id=$id");
        exit;
    }else{
        $messages["success"]="Movie added successfully";
        $_SESSION["messages"]=serialize($messages);
        $conn->close();
        header("Location:../movie.php");
        exit;
    }


}
