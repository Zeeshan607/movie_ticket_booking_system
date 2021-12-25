<?php
include "../variables.php";
include "../db.php";


$name=isset($_POST['name'])?$_POST['name']:null;
$city=isset($_POST['city'])?$_POST['city']:null;
$address=isset($_POST['address'])?$_POST['address']:null;
$seats=isset($_POST['seats'])?$_POST['seats']:null;

if(empty($name)){
    $errors["name"]="Name field is required1";
}
if(empty($city)){
    $errors["city"]="City field is requried";
}
if(empty($address)){
    $errors["address"]="Address field is requried";
}
if(empty($seats)){
    $errors["seats"]="Seats field is requried";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../add-new-cinema.php");
    exit;
}

if(!empty($_POST)){

$sql= "INSERT INTO `cinemas`(`name`, `city`, `address`, `seats`) VALUES ('$name', '$city','$address', $seats)";

$result=$conn->query($sql);

if(!$result){
    $errors["query_error"]=$conn->error;
    $_SESSION["errors"]=serialize($errors);
    header("Location:../add-new-cinema.php");
    exit;
}else{
   $cinema_id = $conn->insert_id;
 InsertSeatsOfCinema($conn, $seats, $cinema_id);
$messages["success"]="Cinema details added successfully";
$_SESSION['messages']=serialize($messages);
$conn->close();
header("Location:../cinema.php");
exit;
}


}

function InsertSeatsOfCinema($con,$seats,$cinemaId){
    $columns=10;
    $rowRange=$seats/$columns;
    $rows=array();
    $alphabets=range("A","Z");
    for($i= 0;$i< $rowRange ;$i++){
        $rows[]=$alphabets[$i];
    }
    $columInserted=0;
//    insert rows in alphabetical order
    for($r=0;$r<$rowRange;$r++){
//        insert columns in numbers
        for($c=$columInserted;$c<(10*($r+1));$c++){

            $sql= "INSERT INTO `seats`(`row`, `number`, `cinema_id`) VALUES ('$rows[$r]',$c+1,$cinemaId)";
            $result=$con->query($sql);
            if($con->error){
                $errors["query_error"]=$con->error;
                $_SESSION["errors"]=serialize($errors);
                header("Location:../add-new-cinema.php");
                exit;
            }
        }
        $columInserted=10*($r+1);

    }
    $con->close();
    return $result;

}