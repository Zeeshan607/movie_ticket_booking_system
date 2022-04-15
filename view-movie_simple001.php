<?php
include "./authenticate.php";
include "./db.php";
$data=file_get_contents('./seats.json');
$seats=json_decode($data,true);
$rows=["A","B","C","D","F","G","H"]


?>
<!doctype html>
<html lang="en">

<head>
    <title>Hello, world!</title>
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
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <span class="rounded-circle-fa-icon">
                                        <i class="fa fa-bell"></i></span>
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
    $urlPlaySlot=isset($_REQUEST['play_slot'])?$_REQUEST['play_slot']:"";
    if(!empty($urlCinemaId)){
        $scheduleSql="SELECT play_slot1 as ps1, play_slot2 as ps2, play_slot3 as ps3, play_slot4 as ps4  FROM `schedules`  INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movieId AND `cinema_id`=$urlCinemaId ";
        $scheduleResult=$conn->query($scheduleSql);
        while($obj=$scheduleResult->fetch_object()){
            $schedules[]=$obj;
        }
    }


    $movieSql="SELECT * FROM `movies` WHERE `id` =$movieId";
    $cinemaSql="SELECT cinema_id as id, cinemas.name as cinema_name FROM `schedules`  INNER JOIN `cinemas` ON schedules.cinema_id=cinemas.id  WHERE `movie_id`=$movieId ";
    $reservationSql="SELECT * FROM `reservations`";
                $cinemasResult=$conn->query($cinemaSql);
                $movieResult=$conn->query($movieSql);
                $reservationResult=$conn->query($reservationSql);
                if($reservationResult){
                    while($obj=$reservationResult->fetch_object()){
                        $reservations[]=$obj;
                    }
                    }
                while($obj=$cinemasResult->fetch_object()){
                    $cinemas[]=$obj;
                }


                $movie=$movieResult->fetch_object();
                if(!($movieResult || $cinemasResult)){
                    ?>
                    <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></p>
                    <?php
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

                        if(count($cinemas)){

                    ?>

                    <div class="row mx-0  mt-5">
                        <div class="col-12">
                            <h2 class="text-light font-weight-bold">
                                Book your ticket now
                            </h2>
                        </div>
                    </div>

                    <div class="row mx-0 mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Cinema</label>
                                <select name="cinema_id" id="" onchange="addUrl($(this).val())" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                    <option value="null" selected disabled>--select---</option>
                                    <?php

                                        foreach ($cinemas as $cinema){

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
                                    ?>
                                </select>
                            </div>
                            </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Date and time</label>
                                <select name="play_slot" id="" onchange="setPlaySlotInUrl($(this).val())" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark">
                                    <option value="null" selected disabled >--select---</option>
                                    <?php
                                    if($schedules && count($schedules)){
                                        foreach($schedules as $schedule){
                                    ?>
                                        <option value="<?= $schedule->ps1 ?>"
                                            <?php

                                            if( !empty($urlPlaySlot)){
                                                if($urlPlaySlot==$schedule->ps1){
                                                    echo "selected";
                                                }else{
                                                    echo "";
                                                }
                                            }

                                            ?>
                                        > <?= date("d-M-Y\ h:i A",strtotime($schedule->ps1) )  ?></option>
                                        <option value="<?= $schedule->ps2 ?>"
                                            <?php

                                            if( !empty($urlPlaySlot)){
                                                if($urlPlaySlot==$schedule->ps2){
                                                    echo "selected";
                                                }else{
                                                    echo "";
                                                }
                                            }

                                            ?>
                                        > <?= date("d-M-Y\ h:i A",strtotime($schedule->ps2) )  ?></option>
                                        <option value="<?= $schedule->ps3 ?>"

                                            <?php

                                            if( !empty($urlPlaySlot)){
                                                if($urlPlaySlot==$schedule->ps3){
                                                    echo "selected";
                                                }else{
                                                    echo "";
                                                }
                                            }

                                            ?>
                                        > <?= date("d-M-Y\ h:i A",strtotime($schedule->ps3) )  ?></option>
                                        <option value="<?= $schedule->ps4 ?>"

                                            <?php

                                            if( !empty($urlPlaySlot)){
                                                if($urlPlaySlot==$schedule->ps4){
                                                    echo "selected";
                                                }else{
                                                    echo "";
                                                }
                                            }

                                            ?>
                                        > <?= date("d-M-Y\ h:i A",strtotime($schedule->ps4) )  ?></option>




                                                <?php
                                            }
                                    }
                                                  ?>


                                </select>
                            </div>
                        </div>
                        </div>

                        <div class="row mx-0 mt-4">
                            <div class="col-12">

                           <?php
                           if(!(empty($urlCinemaId) || empty($urlPlaySlot)) && $scheduleResult  ){

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
                                        <td><?= $row ?></td>
                                            <?php

//                                                foreach($reservations as $reservation){

                                                foreach($seats as $seat){


                                                if($seat['row']=== $row){

//                                                        if($reservation->seat_id == $seat['id']){
                                                        ?>
                                                   <td>
                                                       <div class="form-check form-check-inline " title="">
                                                           <label class="form-check-label">
                                                               <input type="checkbox" class="form-check-input"  name="" id="" />
                                                               <span class="form-check-sign">
                                                                 <span class="check"></span>
                                                                    </span>
                                                           </label>
                                                       </div>
                                                   </td>

<!--                                               --><?php
//                                                    }else{
//                                                           ?>
<!--                                                            <td>-->
<!--                                                                <div class="form-check form-check-inline " title="">-->
<!--                                                                    <label class="form-check-label">-->
<!--                                                                        <input type="checkbox" class="form-check-input"   name="" id="" />-->
<!--                                                                        <span class="form-check-sign">-->
<!--                                                                 <span class="check"></span>-->
<!--                                                                    </span>-->
<!--                                                                    </label>-->
<!--                                                                </div>-->
<!--                                                            </td>-->



                                                            <?php
//                                                        }




                                                    }

                                                }
//                                            }


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


                    
                    
                    
                    
                    
<!--main if condition for checking if user is logged in or not-->
                        <?php
                        }else{
                            ?>
                            <div class="row mx-0 mt-5">
                                <div class="col-12">
                                 <p class="text-info">Sorry? This movie is currently not available in any cinema!</p>
                                </div>
                            </div>

                                <?php
                        }
                         }else{
                        ?>


                        <div class="row mx-0">
                            <div class="col-12 text-right">
                                <a href="login.php" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>

                        
                        
                    
                        <?php
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
<script src="./assets/js/custom.js"></script>

<script type="text/javascript">

   function addUrl(cinemaId){

       const urlParams = new URLSearchParams(window.location.search);
       urlParams.set('cinema_id', cinemaId);
       window.location.search = urlParams;

            }


    function  setPlaySlotInUrl(Playslot){

        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set('play_slot', Playslot);

        window.location.search = urlParams;
    }

</script>

</body>

</html>