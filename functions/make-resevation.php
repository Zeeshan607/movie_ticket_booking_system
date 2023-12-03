<?php
include __DIR__."/../authenticate.php";
include __DIR__."/../variables.php";
include __DIR__."/../db.php";

$cart=isset($_SESSION["cart"])?unserialize($_SESSION["cart"]):null;
$cart_total=isset($_SESSION["cart_total"])?$_SESSION["cart_total"]:null;

try{
    foreach($cart as $item){
        $user_id=$item["user"];
        $movie_id=$item["movie_id"];
        $cinema_id=$item["cinema_id"];
        $reservation_timestamp=$item["reservation_timestamp"];
        $payment_status=1;
        $created_at= date("Y-m-d H:i:s");


        $sql="INSERT INTO `reservations` ( `user_id`, `movie_id`,`cinema_id`,`play_slot`, `payment_status`,`created_at`  ) VALUES ( '$user_id', '$movie_id', '$cinema_id', '$reservation_timestamp', '$payment_status', '$created_at' )";
        $result=$conn->query($sql);
        if(!$result){
            die("Query Error: ". $conn->error);

        }

        $thisReservationId=$conn->insert_id;

        foreach($item["seats"] as $seat_id){

            $seatsSQL="INSERT INTO `seats_reserved` (`reservation_id`, `seat_id`) VALUES ('$thisReservationId', '$seat_id')";
            $seatsResult=$conn->query($seatsSQL);
            if(!$seatsResult){
                die("Query Error: ". $conn->error);
            }
        }

    }
    $messages["success"]="Reservation created successfully";
    $conn->close();
    $_SESSION["u_messages"]=serialize($messages);
    unset($_SESSION["cart"]);
    unset($_SESSION["cart_total"]);
    header("Location: ../index.php");
    exit();
}catch (Exception $ex){

    $errors["failed"]=$ex->getMessage();
    $_SESSION["u_errors"]=serialize($errors);
    header("Location:../payment.php");
    exit();

}




