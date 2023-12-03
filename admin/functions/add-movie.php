<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$name=isset($_POST['name'])?$_POST['name']:null;
$image=isset($_FILES['image'])?$_FILES['image']:null;
$genre=isset($_POST['genre'])?$_POST['genre']:null;
$imdb_ratings=isset($_POST['imdb_ratings'])?$_POST['imdb_ratings']:null;
$release_date=isset($_POST['release_date'])?$_POST['release_date']:null;
$is_upcoming=isset($_POST['is_upcoming'])?1:0;


//
//var_dump($image);
//die;
if(empty($name)){
    $errors["name"]="Name field is required";
}
if(empty($image)){
    $errors["image"]="image for movie is required";
}
if(empty($genre)){
    $errors["genre"]="genre field is required";
}
if(empty($imdb_ratings)){
    $errors["imdb_ratings"]="imdb_ratings are required  ";
}
if(empty($release_date) ){
    $errors["release_date"]="Release date of movie are required  ";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../add-new-movie.php");
    exit;
}

$fileName=pathinfo(basename($image['name']), PATHINFO_FILENAME);
$fileName=str_replace(' ','_',$fileName);
$fileExtension=pathinfo(basename($image['name']),PATHINFO_EXTENSION);
$fileNameToStore=$fileName.time().'.'.$fileExtension;

if(!in_array(strtolower($fileExtension),['jpeg','jpg','png'])){
    $errors["wrong_file_format"]="Wrong file type; only .jpeg, .jpg, .png types are allowed";
    $_SESSION['errors']=serialize($errors);
    header("Location:../add-new-movie.php");
    exit;
}

if($image['size'] > 5000000){
    $errors["fileSize"]="Sorry file is too large. max size 5mb allowed";
    $_SESSION['errors']=serialize($errors);
    header("Location:../add-new-movie.php");
    exit;
}

if(!file_put_contents( "../../assets/uploads/".$fileNameToStore,file_get_contents($image['tmp_name']))){
    $errors["fileUpload"]="Sorry, there was an error uploading your file.";
    $_SESSION['errors']=serialize($errors);
    header("Location:../add-new-movie.php");
    exit;
}



if(!empty($_POST)){



    $release_date=$release_date?date("Y-m-d", strtotime($release_date)):null;
    $stmt = $conn->prepare("INSERT INTO `movies` (`name`, `image`, `genre`, `imdb_ratings`, `is_upcoming`, `release_date`) VALUES (?, ?, ?, $imdb_ratings, $is_upcoming, '$release_date' )");

// Bind parameters
    $stmt->bind_param("sss", $name, $fileNameToStore, $genre);

// Execute the query
    $result= $stmt->execute();

// Close the statement
    $stmt->close();
//    $sql= "INSERT INTO `movies` (`name`, `image`, `genre`, `imdb_ratings`, `is_upcoming`, `release_date`) VALUES ('$name', '$fileNameToStore', '$genre', $imdb_ratings, $is_upcoming, '$release_date' )";
//
//
//
//  =$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../add-new-movie.php");
        exit;
    }else{
        $messages["success"]="Movie added successfully";
        $_SESSION["messages"]=serialize($messages);
        $conn->close();
        header("Location:../movie.php");
        exit;
    }


}
