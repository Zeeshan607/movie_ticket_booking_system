<?php
include __DIR__."/../../variables.php";
include __DIR__."/../../db.php";

$id= isset($_REQUEST['id'])?$_REQUEST['id']:null;
$name=isset($_POST['name'])?$_POST['name']:null;
$city=isset($_POST['city'])?$_POST['city']:null;
$address=isset($_POST['address'])?$_POST['address']:null;
$seats=isset($_POST['seats'])?$_POST['seats']:null;

if(empty($id)){
    $errors["id"]="Oop! some error occurred please try again ";
}

if(empty($name)){
    $errors["name"]="Name field is required";
}
if(empty($city)){
    $errors["city"]="City field is requried";
}
if(empty($address)){
    $errors["address"]="Address field is requried";
}
if(empty($seats) || !intval($seats/10)){
    $errors["seats"]="Seats field is requried : wrong value ";
}
if(count($errors)){
    $_SESSION['errors']=serialize($errors);
    header("Location:../edit-cinema.php");
    exit;
}

if(!empty($_POST)){

    $sql= "UPDATE `cinemas` SET `name`='$name',`city`='$city',`address`='$address',`seats`=$seats WHERE `id` = $id";

    $result=$conn->query($sql);

    if(!$result){
        $errors["query_error"]=$conn->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../edit-cinema.php?id=$id");
        exit;
    }else{


        $cinema_id = $id;


        $CountSql="SELECT `cinema_id`, Count(cinema_id) as seatsCount FROM `seats` WHERE `cinema_id`= $cinema_id GROUP BY `cinema_id`";
        $execquery=$conn->query($CountSql);

        if($conn->error){
            $errors["query_error"]=$conn->error;
            $_SESSION["errors"]=serialize($errors);
            header("Location:../edit-new-cinema.php?id=$cinema_id");
            exit;
        }

        $count=$execquery->fetch_array();

        if($count['seatsCount'] !== $seats && ( ($count['seatsCount'] < $seats) || ($count['seatsCount'] > $seats) )) {
            InsertSeatsOfCinema($conn, $seats, $cinema_id);
        }






        $messages["success"]="Cinema details updated successfully";
        $_SESSION['messages']=serialize($messages);
        $conn->close();
        header("Location:../cinema.php");
        exit;


    }


}



function InsertSeatsOfCinema($con,$seats,$cinemaId){
    $columns=10;
    $rowRange=(int) $seats/$columns;
    $rows=array();
    $alphabets=range("A","Z");
    for($i= 0;$i< $rowRange ;$i++){
        $rows[]=$alphabets[$i];
    }

      $sql="DELETE FROM `seats` WHERE `cinema_id`= $cinemaId";
       $delResult= $con->query($sql);

    if($con->error){
        $errors["query_error"]=$con->error;
        $_SESSION["errors"]=serialize($errors);
        header("Location:../edit-new-cinema.php?id=$cinemaId");
        exit;
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
                header("Location:../edit-new-cinema.php?id=$cinemaId");
                exit;
            }
        }
        $columInserted=10*($r+1);

    }


    $con->close();
    return $result;

}