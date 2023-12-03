<?php
include __DIR__."/../authenticate.php";
include __DIR__."/../variables.php";
include __DIR__."/../db.php";

if(!empty($user)){
//


    $cinema_id=isset($_POST["cinema_id"])?$_POST['cinema_id']:null;
    $movie_id=isset($_POST["movie_id"])?$_POST["movie_id"]:null;
    $date=isset($_POST["date"])?$_POST["date"]:null;
    $time=isset($_POST["time"])?$_POST["time"]:null;
    $nmbr_of_seats=isset($_POST["number_of_seats"])?$_POST["number_of_seats"]:null;
    $seats=isset($_POST["seats"])?$_POST["seats"]:null;
    $price=isset($_POST["price_per_seat"])?$_POST["price_per_seat"]:null;


    if(empty($cinema_id)){
        $errors['cinema_id']="cinema id not found";
    }

    if(empty($movie_id)){
        $errors['movie_id']="movie id not found";
    }

    if(empty($date)){
        $errors['date']="date not found";
    }

    if(empty($time)){
        $errors['time']="Time not found";
    }
    if(empty($nmbr_of_seats)){
        $errors['nmbr_of_seats']="number of seats selected not found";
    }
    if(empty($seats)){
        $errors['seats']="seats not found";
    }
    if(empty($price)){
        $errors['price']="price not found";
    }

    if(count($errors)){
        $_SESSION['u_errors']=serialize($errors);
        header("Location:../view-movie.php?movie_id=".$movie_id);
        exit;
    }



If(!empty($_POST)){


$cartItem=["movie_id"=>$movie_id,"cinema_id"=>$cinema_id,"reservation_timestamp"=>$date.' '.$time,"seats"=>$seats,"price"=>$price,"user"=>$user['id'], "reservation_total"=>count($seats)*$price];
$cartTotal=0;
if(isset($_SESSION["cart"]) && count(unserialize($_SESSION["cart"])) > 0){
    $cartArray=unserialize($_SESSION["cart"]);
    array_push($cartArray, $cartItem);
   $_SESSION["cart"] =serialize($cartArray);
   foreach ($cartArray as $item){
       $cartTotal=$cartTotal + $item["reservation_total"];
   }
   $_SESSION["cart_total"]=$cartTotal;
}else{
    $cart[]=$cartItem;
    $_SESSION["cart"]=serialize($cart);
    $_SESSION["cart_total"]=$cartItem["reservation_total"];
}


$messages['success']="Reservation added to cart successfully";
$_SESSION['u_messages']=serialize($messages);
header("Location:../view-movie.php?movie_id=".$movie_id);
exit;




}





}




