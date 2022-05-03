<?php
include "./authenticate.php";
include "./db.php";

if(!$user){
    $message["access error"]="Access denied";
    $_SESSION["u_messages"]=serialize($message);
    header("Location:./index.php");
    exit;
}
 if(!isset($_SESSION["cart"]) || count(unserialize($_SESSION["cart"]))==0){
     header("Location:./index.php");
     exit;
 }




?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="assets/lib/font-awesome-icons/css/all.min.css" rel="stylesheet" />

    <!-- Material Kit CSS -->
   <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <link href="assets/css/custom.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/web.css" type="text/css" rel="stylesheet" />
</head>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="primary" data-background-color="black" data-image="./assets/img/sidebar-5.jpg">

      <?php require "./layout/partials/sidebar.php"; ?>

        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                      </button>
                        <!-- <a class="navbar-brand" href="javascript:void(0)">Dashboard</a> -->


                        <div class="input-group c-input-rounded-wrapper">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class='fa fa-search'></i></span>
                              </div>
                            <input type="text" name="search" id="search" placeholder="Search..." class="c-input-rounded">
                        </div>
                    </div>


                <div class="d-inline justify-content-end">
                    <ul class="navbar-nav navbar-expand-md">
                        <div class=" d-none d-md-none d-sm-none d-lg-flex">
                            <?php $cartCount=isset($_SESSION["cart"])?count(unserialize($_SESSION['cart'])):0; ?>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo $cartCount > 0?  './cart.php' :'javascript:void();'?>">
                                    <span class="rounded-circle-fa-icon ticket-cart">
                                        <i class="fa fa-ticket-alt"></i>
                                            <sup class="badge badge-pill badge-success ticket-count">
                                           <?= $cartCount ?>
                                            </sup>
                                    </span>

                                </a>
                            </li>
                            <li class="nav-item">
                                <?php

                                if(!$user){
                                    ?>
                                    <a class="nav-link" href="login.php" title="login">
                                    <span class="rounded-circle-fa-icon">
                                        <i class="fas fa-sign-in-alt"></i></span>

                                    </a>
                                <?php
                                }else{
                                    ?>
                                    <a class="nav-link" href="functions/logout.php" title="logout">
                                    <span class="rounded-circle-fa-icon">
                                        <i class="fas fa-sign-out-alt"></i></span>

                                    </a>
                                <?php }
                                ?>

                            </li>
                     </div>

                        <li class="nav-item dropdown d-md-block d-lg-none">
                            <a class="nav-link" href="javascript:void(0)" id="settingDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                                <span class="rounded-circle-fa-icon">
                                    <i class="fa fa-cogs"></i></span>

                            </a>
                            <div class="dropdown-menu custom-dropdown" aria-labelledby="settingDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:void(0)">
                                        <p >  Notifications </p>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <p> Logout</p>
                                </a>
                            </div>
                        </li>
                    </div>

                        <!-- your navbar here -->
                    </ul>
                </div>

            </nav>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid p-0">
                    <?php
                    if(isset($_SESSION['u_messages'])){
                        $msgs = unserialize($_SESSION['u_messages']);
                        foreach($msgs as $msg){
                            ?>
                            <p class="alert alert-success alert-dismissible fade show"><?php echo $msg ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></p>
                        <?php }}
                    unset($_SESSION['u_messages']);
                    ?>
                    <?php
                    if(isset($_SESSION['u_errors'])){
                        $errors = unserialize($_SESSION['u_errors']);
                        foreach($errors as $error){
                            ?>
                            <p class="alert alert-success alert-dismissible fade show"><?php echo $error ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></p>
                        <?php }}
                    unset($_SESSION['u_errors']);
                    ?>




                    <div class="row mx-0">
                        <div class="col-12">
                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Movie Name</th>
                                        <th>Cinema Name</th>
                                        <th>Selected Seats</th>
                                        <th>Price Per Seat</th>
                                        <th>Reservation Total</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php
                                if(isset($_SESSION["cart"])){
                                    $cart=unserialize($_SESSION["cart"]);
                                    foreach($cart   as $key=>$cartItem){
                                ?>
                                <tr>
                                    <td><?= $cartItem['user']==$user["id"]?$user["name"]:$cartItem['user'] ?></td>

                                    <td><?php $movie=getMovieName($conn,$cartItem['movie_id']); echo $movie->name;  ?></td>
                                    <td><?php $cinema=getCinemaName($conn,$cartItem['cinema_id']); echo $cinema->name; ?></td>

                                    <td><?php
                                        foreach($cartItem['seats'] as $seat_id){
                                            echo getSeatsName($conn,$seat_id,$cartItem['cinema_id']).",&nbsp;";

                                        }
                                        ?></td>
                                    <td><?= $cartItem['price'] ?></td>
                                    <td class="reservation-count"><?= $cartItem['price'] * count($cartItem["seats"]) ?></td>
                                    <td><a href="javascript:void(0)" type="button" onclick="deleteCartItem(`<?= $key ?>`)"><i class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="5">Total</td>
                                        <td id="cart-total"><?= $_SESSION["cart_total"] ?></td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>

                    <div class="row mx-0">
                        <div class="col-12 text-right">
                            <a href="./payment.php" class="btn btn-primary ">Proceed to payment</a>
                        </div>
                    </div>

































                </div>
            </div>


 <!-- footer -->
 <?php require "./layout/partials/footer.php"; ?>

        </div>
    </div>







 <!--   Core JS Files   -->
 <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
    <!-- <script src="https://unpkg.com/default-passive-events"></script> -->
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="./assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="./assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.js?v=2.1.0"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!--    <script src="./assets/demo/demo.js"></script>-->
    <script src="./assets/js/custom.js"></script>



    <script type="text/javascript">
            let total=0;
            // console.log($(".reservation-count").text())
        // $(".reservation-count").each(function(){
        //     total = total + parseInt($(this).text());
        //     $('#cart-total').text(total);
        // })



        function deleteCartItem(key){
            $.ajax({
                url:"./functions/delete-cart-item.php",
                method:"post",
                data:{"key":key},
                success:function(resp){
                    location.reload();
                },
                error:function(xhr,errMsg,errCode){
                    let err=JSON.parse(xhr.responseText);
                    console.log(err.message);
                }
            })
        }

    </script>
</body>

</html>



<?php
function getCinemaName($conn,$id){

    $sql="SELECT `name` FROM `cinemas` WHERE `id`=$id";
    $result=$conn->query($sql);
    if(!$result){
        return $conn->error;
    }
    return $result->fetch_object();


}
function getMovieName($conn,$id){

    $sql="SELECT `name` FROM `movies` WHERE `id`=$id";
    $result=$conn->query($sql);
    if(!$result){
        return $conn->error;
    }
    return $result->fetch_object();
}
function getSeatsName($conn,$seat_id, $cinema_id){

    $sql="SELECT `row`,`number` FROM `seats` WHERE `cinema_id`= $cinema_id AND `id`= $seat_id";
    $result=$conn->query($sql);
    if(!$result){
        return $conn->error;
    }
    $data=$result->fetch_object();
    return $data->row.$data->number;
}

?>