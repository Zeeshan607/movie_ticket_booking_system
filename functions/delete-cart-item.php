<?php
include __DIR__."/../authenticate.php";

$cart_item_key=isset($_POST["key"])?$_POST["key"]:null;


if($_POST){
    if(isset($_SESSION["cart"])){
        $cart=unserialize($_SESSION["cart"]);
        $cartTotal=$_SESSION["cart_total"] - $cart[$cart_item_key]["reservation_total"];
        unset($cart[$cart_item_key]);
        array_values($cart);
        $_SESSION["cart_total"]=$cartTotal;
        $_SESSION["cart"]=serialize($cart);
        echo "success";
        exit;
    }
}
