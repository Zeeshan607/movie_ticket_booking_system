<?php
include "./authenticate.php";
include "./db.php";




?>
<!doctype html>
<html lang="en">

<head>
    <title>Single View</title>
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
    <script>
        let selected=[];
    </script>
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


                <?php
if(isset($_REQUEST['movie_id'])){
    $movieId=$_REQUEST['movie_id'];
    if(empty($movieId)){
        ?>
        <p class="alert alert-success alert-dismissible fade show">Movie Id not available please retry.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></p>
            <?php
    }
    $urlCinemaId=isset($_REQUEST['cinema_id'])?$_REQUEST['cinema_id']:"";
    $urlDate=isset($_REQUEST['date'])?$_REQUEST['date']:"";
    $urlTime=isset($_REQUEST['time'])?$_REQUEST['time']:"";
    if(!empty($urlCinemaId)){

        $scheduleDateSql="SELECT play_date FROM `schedules`  INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movieId AND `cinema_id`=$urlCinemaId";
        $scheduleDateResult=$conn->query($scheduleDateSql);
        if(!$scheduleDateResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }


        $seatsSql="SELECT * FROM `seats` WHERE `cinema_id`=$urlCinemaId";
        $seatsResult=$conn->query($seatsSql);
        if(!$seatsResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
        //        make array of all seats data
        while($obj=$seatsResult->fetch_object()){
            $seats[]=$obj;
        }


        $rowsSql="SELECT DISTINCT `row` as rname FROM `seats` WHERE `cinema_id`=$urlCinemaId";
        $rowsResult=$conn->query($rowsSql);
        if(!$rowsResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
//        make array of all alphabetical rows data
        while($obj=$rowsResult->fetch_object()){
            $rows[]=$obj;
        }


    $cinemasSeatsCountSql="SELECT COUNT(*) as seats_count FROM `seats` WHERE `cinema_id`=$urlCinemaId";
        $seatsCountResult=$conn->query($cinemasSeatsCountSql);
        if(!$seatsCountResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
        $seatsCount=$seatsCountResult->fetch_object();

        $cinemaSeatsPriceSql="SELECT `price_per_seat` FROM `schedules` WHERE  `cinema_id`=$urlCinemaId AND `movie_id`=$movieId";
        $seatsPriceResult=$conn->query($cinemaSeatsPriceSql);
        if(!$seatsPriceResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
        $seatsPrice=$seatsPriceResult->fetch_object();


    }
if(!empty($urlDate)){
    $scheduleSlotsSql="SELECT play_slot1 as ps1, play_slot2 as ps2, play_slot3 as ps3 FROM `schedules`  INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movieId AND `cinema_id`=$urlCinemaId AND `play_date`='$urlDate'";
    $scheduleSlotsResult=$conn->query($scheduleSlotsSql);
    if(!$scheduleSlotsResult){
        ?>
        <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></p>
        <?php
    }
}


    $movieSql="SELECT * FROM `movies` WHERE `id` =$movieId";
    $movieResult=$conn->query($movieSql);
    if(!$movieResult){
        ?>
        <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></p>
        <?php
    }
    $movie=$movieResult->fetch_object();


    $cinemaSql="SELECT DISTINCT cinema_id as id, cinemas.name as cinema_name FROM `schedules` INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movieId ";
    $cinemasResult=$conn->query($cinemaSql);
    if(!$cinemasResult){
        ?>
        <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></p>
        <?php
    }
$reservationSql="SELECT  id, user_id, movie_id, cinema_id, play_slot FROM `reservations` WHERE `movie_id`=$movieId AND `cinema_id`=$urlCinemaId AND  DATE(play_slot)='$urlDate' AND TIME(play_slot)='$urlTime'";

    if(!($urlCinemaId && $urlDate && $urlTime)){
        $reservations=array();
        $reservations_stamps=array();
    }else{
         $reservationResult=$conn->query($reservationSql);
        if(!$reservationResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
//
    if($reservationResult->num_rows==0){
        $reservations=array();
        $reservations_stamps=array();
    }else{
        while($obj=$reservationResult->fetch_object()){
            $reservations[]=$obj;
            $reservations_stamps[]=$obj->play_slot;
        }

    }


    foreach($reservations as $reservation){

        $seatsReservedSql="SELECT seat_id From `seats_reserved` WHERE `reservation_id`=$reservation->id";
        $seatsReservedResult=$conn->query($seatsReservedSql);
        if(!$seatsReservedResult){
            ?>
            <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></p>
            <?php
        }
        while($obj=$seatsReservedResult->fetch_object()){
            $seats_reserved[]=$obj->seat_id;
        };

    }



}

}


                ?>


                <div class="container-xl m-0">

                            <div class="row mx-0">
                                <div class="col-4">
                                    <img src="assets/uploads/<?= $movie->image ?>" class="single-movie-image" alt="poster here">
                                </div>
                                <div class="col-8 text-white">
                                    <h1><b><?=  $movie->name ?></b></h1>
                                    <div class="star-ratings mb-4">
                                        <i class="fa fa-star text-warning"></i>
                                        <?= $movie->imdb_ratings ?>IMDB ratings
                                    </div>
                                    <p class="mb-1"><b>Genre: </b><?= $movie->genre ?></p>

                                    <p class="mb-1"><b><?= $movie->is_upcoming?"Release Date: ":"Released On: " ?> </b><?= date("d-M-Y", strtotime($movie->release_date) )?></p>

                                    <p class="mb-1"><b>Status: </b> <span class="text-success"><?= $movie->is_upcoming?"Coming Soon":"In Cinemas Now" ?></span></p>
                                    <div class="mt-3">
                                        <h4><b>Description:</b></h4>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                            It has survived not only five centuries,  when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                            It has survived not only five centuries,
                                        </p>
                                    </div>

                                </div>
                            </div>

                    <?php
                    if($user && !$movie->is_upcoming){
                            if($cinemasResult->num_rows == 0){
                                ?>
                                    <div class="row mx-0 mt-5">
                                        <div class="col-12 text-info">
                                            <p>Sorry! This movie is not available in any cinema yet, Please try again leter</p>
                                        </div>
                                    </div>

                                    <?php
                            }else{

                    ?>

                    <div class="row mx-0  mt-5">
                        <div class="col-12">
                            <h2 class="text-light font-weight-bold">
                                Book your ticket now
                            </h2>
                        </div>
                    </div>
                        <form action="functions/add-to-cart.php" method="post" id="ticket-form">
                            <input type="hidden" value="<?= $movieId ?>" name="movie_id">
                    <div class="row mx-0 mt-2">
                        <div class="col-6">

                            <div class="row mx-0">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Cinema</label>
                                        <select name="cinema_id" id="" onchange="addUrl($(this).val())" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                            <option value="null" selected disabled>--select---</option>
                                            <?php
                                            if($cinemasResult->num_rows == 0){
                                                ?>
                                                <option value="null" disabled selected>Sorry. This movie is not available in any cinema yet.</option>

                                                <?php
                                            }else{
                                                while($cinema=$cinemasResult->fetch_object()){
                                                    ?>

                                                    <option value="<?= $cinema->id?>"
                                                        <?php

                                                        if( !empty($urlCinemaId)){
                                                            if($urlCinemaId==$cinema->id){
                                                                echo "selected";
                                                            }else{
                                                                echo "";
                                                            }
                                                        }

                                                        ?>
                                                    ><?= $cinema->cinema_name ?></option>

                                                    <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Date </label>
                                        <select name="date" id="" onchange="setPlayDateInUrl($(this).val())" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                            <option value="null" selected disabled >--select---</option>
                                            <?php
                                            if(!$scheduleDateResult && $scheduleDateResult->num_rows==0) {
                                                ?>
                                                <option value="null" disabled>Date not selected yet.</option>

                                                <?php
                                            }else{
                                                while($scheduleDate=$scheduleDateResult->fetch_object()){
                                                    ?>
                                                    <option value="<?= $scheduleDate->play_date ?>"
                                                        <?php

                                                        if( !empty($urlDate)){
                                                            if($urlDate==$scheduleDate->play_date){
                                                                echo "selected";
                                                            }else{
                                                                echo "";
                                                            }
                                                        }

                                                        ?>

                                                    ><?= date("d-M-Y",strtotime($scheduleDate->play_date) )  ?></option>

                                                    <?php
                                                }}
                                            ?>


                                        </select>
                                    </div>
                                </div>
                            </div>



                            </div>
                        <div class="col-6">
                            <div class="row mx-0">
                          
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Time</label>
                                        <select name="time" id="" onchange="AddTimeSlotInUrl($(this).val())" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                            <option value="null" selected disabled >--select---</option>
                                            <?php
                                            if(!$scheduleSlotsResult && $scheduleSlotsResult->num_rows == 0) {
                                                ?>
                                                <option value="null" disabled>Date not selected yet.</option>

                                                <?php
                                            }else{
                                                while($schedule=$scheduleSlotsResult->fetch_object()){
                                                    ?>
                                                    <option value="<?= $schedule->ps1 ?>"
                                                        <?php

                                                        if( !empty($urlTime)){
                                                            if($urlTime==$schedule->ps1){
                                                                echo "selected";
                                                            }else{
                                                                echo "";
                                                            }
                                                        }

                                                        ?>
                                                    > <?= date("h:i A",strtotime($schedule->ps1) )  ?></option>
                                                    <option value="<?= $schedule->ps2 ?>"
                                                        <?php

                                                        if( !empty($urlTime)){
                                                            if($urlTime==$schedule->ps2){
                                                                echo "selected";
                                                            }else{
                                                                echo "";
                                                            }
                                                        }

                                                        ?>
                                                    > <?= date("h:i A",strtotime($schedule->ps2) )  ?></option>
                                                    <option value="<?= $schedule->ps3 ?>"

                                                        <?php

                                                        if( !empty($urlTime)){
                                                            if($urlTime==$schedule->ps3){
                                                                echo "selected";
                                                            }else{
                                                                echo "";
                                                            }
                                                        }

                                                        ?>
                                                    > <?= date("h:i A",strtotime($schedule->ps3) )  ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Select number of seats you want to book?</label>
                                                <select name="number_of_seats" id="nmbr_of_seats" onchange="valueChangeEffect(event, this)" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                                    <option value="null" selected disabled>--select--</option>

                                                    <?php
                                                           if($seatsCount){
                                                               for($i=1;$i<=$seatsCount->seats_count;$i++){
                                                        ?>
                                                                   <option value="<?= $i ?>"><?= $i ?></option>
                                                         <?php
                                                               }
                                                           }else{
                                                         ?>

                                                               <option value="null" disabled>Cinema Not selected! please select Cinema of your choice</option>
                                                         <?php
                                                           }

                                                         ?>


                                                </select>
                                            </div>

                                    
                                    
                                </div>
                            </div>


                        </div>
                        </div>
                            <div class="row mx-0">
                                <div class="col-3">
                                    <div class="form-group my-3 pl-4">
                                        <label for="">
                                            Price per seat
                                        </label><br>

                                        <span class="price text-white font-weight-bold">Rs <?= isset($seatsPrice)?$seatsPrice->price_per_seat:0?>/-</span>
                                        <input type="hidden" name="price_per_seat" value="<?= isset($seatsPrice)?$seatsPrice->price_per_seat:0 ?>"  id="price_per_seat">
                                    </div>

                                </div>
                            </div>

                            <div class="row mx-0">
                                <div class="col-12">
                                    <span class="text-white"><i class="fa fa-square text-success mx-2"></i> Available seats</span>
                                   <span class="text-white"><i class="fa fa-square text-primary mx-2"></i> Selected seats</span>
                                    <span class="text-white"><i class="fa fa-square text-dark mx-2"></i> Already reserved by others</span>
                                </div>
                            </div>



                        <div class="row mx-0 mt-4">
                            <div class="col-12">

                           <?php
                           if(!(empty($urlCinemaId) || empty($urlDate) || empty($urlTime))){
                           ?>
                                <table class="table">
                                    <tr>
                                        <td></td>
                                <?php
                                for($i=1;$i<=10;$i++){
                                  ?>
                                  <td><?=  $i ?></td>

                                      <?php

                                        }
                                    ?>

                                    </tr>
                                     <?php


                                    foreach($rows as $row){

                                    ?>
                                    <tr>
                                        <td><?= $row->rname ?></td>
                                            <?php

                                                foreach($seats as $seat){

                                                if($seat->row === $row->rname){

                                                    if(count($reservations)){
//                                                        foreach($reservations as $reservation){

                                                      if(in_array($seat->id,$seats_reserved) && in_array( $urlDate.' '.$urlTime , $reservations_stamps) ){

                                                    ?>
                                                          <td class="reserved-seats">
                                                              <div class="form-check form-check-inline " title="<?= $seat->row.$seat->number ?> | <?= "reserved" ?>">
                                                                  <label class="form-check-label">
                                                                      <input type="checkbox" class="form-check-input"  checked disabled data-booking-status="true" name="seats[]<?= $seat->id ?>" value="<?= $seat->id ?>" id="<?= $seat->id ?>" />
                                                                      <span class="form-check-sign">
                                                                 <span class="check"></span>
                                                                    </span>
                                                                  </label>
                                                              </div>
                                                          </td>

                                                            <?php
                                                }else{

                                                                ?>
                                                          <td class="empty-seats">
                                                              <div class="form-check form-check-inline " title="<?= $seat->row.$seat->number ?> "  >
                                                                  <label class="form-check-label">
                                                                      <input type="checkbox" class="form-check-input" data-booking-status="false"  onclick="addRestriction(event,this,$('#nmbr_of_seats').val())" name="seats[]<?= $seat->id ?>" value="<?= $seat->id ?>"  id="<?= $seat->id ?>" />
                                                                      <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                  </label>
                                                              </div>
                                                          </td>


                                                                <?php


                                                            }

//                                                        }

                                                    }else{
                                                        ?>

                                                        <td class="empty-seats">
                                                            <div class="form-check form-check-inline " title="<?= $seat->row.$seat->number ?> "  >
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" data-booking-status="false"  onclick="addRestriction(event,this,$('#nmbr_of_seats').val())" name="seats[]<?= $seat->id ?>" value="<?= $seat->id ?>"  id="<?= $seat->id ?>" />
                                                                    <span class="form-check-sign">
                                                                                    <span class="check"></span>
                                                                                </span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                     <?php
                                                    }



                                                }

                                            }


                                            ?>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>

                                <?php
                           }
                                ?>


                            </div>
                        </div>
                            <div class="row mx-0">
                                <div class="col-12 text-right">
                                    <button class="btn btn-danger" onclick="Reset()" type="button">Reset</button>
                                    <button  type="submit" class="btn btn-primary">Add ticket to cart</button>
                                </div>
                            </div>
                        </form>
                    
                    
                    
                    
                    

                        <?php
                        }
                         }else{
                        if(!$movie->is_upcoming){

                        ?>


                        <div class="row mx-0">
                            <div class="col-12 text-right">
                                <a href="login.php" role="button" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>

                        
                        
                    
                        <?php
                        }
                        }
                        ?>



                </div>




























            </div>
        </div>


        <!-- footer -->
        <?php require "./layout/partials/footer.php"; ?>



    </div>
</div>







<!--   Core JS Files   -->
<!--<script src="./assets/js/core/jquery.min.js"></script>-->
<script src="./assets/js/Jquery-3.4.1.min.js"></script>
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
<script src="./assets/js/custom.js"></script>




<script type="text/javascript">

//    An array named "selected"  is defined in above header;
function addRestriction(e,obj,seatsAllowed){

   if($(obj).is(':checked')){
       console.log('checked')
       console.log($(obj).attr('name'))
        if(seatsAllowed=='' || seatsAllowed==null){
            alert('Please select number of seats you want to book first!');
            $(obj).prop('checked',false);
            return;
        }else{
            if((selected.length==0 || selected.indexOf($(obj).attr('name'))==-1) && selected.length < seatsAllowed ){
                selected.push($(obj).attr('name'));
                if(selected.length==seatsAllowed){
                    $("input[type='checkbox']:not(:checked)").attr('disabled',true);
                }
            }else{
                if($("input:checkbox:not(:checked)")){
                    $("input[type='checkbox']:not(:checked)").attr('disabled',true);
                    $(obj).prop('checked',false);
                    return;
                }
            }
        }

   }else{
       console.log('unchecked')
       if(selected.indexOf($(obj).attr('name'))!==-1){
          let arr= selected.filter(el=> el!== $(obj).attr('name'));
          selected=arr;
       }
       $('#nmbr_of_seats').val(selected.length);
       $(obj).attr('disabled',true);

   }
console.log(selected)
}

function valueChangeEffect(e, obj){

    $("input[type='checkbox']").each(function(){
        if(!$(this).data("bookingStatus")){
            $(this).attr('disabled',false);
        }
    })
    if($(obj).val() < selected.length){
        let removeEl=selected.pop();
        $("input[name='"+removeEl+"']:checked").prop("checked",false);
    }

}



    function Reset(){

        document.getElementById("ticket-form").reset();
        selected=[];
        $("#ticket-form input:checkbox:not(:checked)").each(function(){
            if(!$(this).data("bookingStatus")){
                $(this).attr('disabled',false);
            }
        })

    }




   function addUrl(cinemaId){

       const urlParams = new URLSearchParams(window.location.search);
       urlParams.set('cinema_id', cinemaId);
       window.location.search = urlParams;

            }


    function  setPlayDateInUrl(date){

        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set('date', date);

        window.location.search = urlParams;
    }

function AddTimeSlotInUrl(time){
    const urlParams = new URLSearchParams(window.location.search);

    urlParams.set('time', time);

    window.location.search = urlParams;
}











</script>

</body>

</html>