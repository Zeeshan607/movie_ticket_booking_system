<?php
include "./authenticate.php";
include "./db.php";





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

$upComingSql="SELECT * FROM `movies` WHERE `is_upcoming` IS true ORDER BY id DESC LIMIT 10";
$upComingMoviesResult=$conn->query($upComingSql);

$theaterSql="SELECT * FROM `movies` WHERE `is_upcoming` IS FALSE ORDER BY id DESC LIMIT 10";
$inTheaterMoviesResult=$conn->query($theaterSql);

if(!($upComingMoviesResult || $inTheaterMoviesResult)){
    ?>

    <p class="alert alert-success alert-dismissible fade show"><?= $conn->error ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></p>
                    <?php
}






?>







<div class="container-xl m-0">
    <div class="row mx-0">
        <div class=" col-12 col-sm-12 col-md-12 col-lg-12 pl-lg-0">
            <div id="latestReleaseMoviesSlider" class="carousel slide" data-ride="carousel">
<!--                <ol class="carousel-indicators">-->
<!--                    <li data-target="#latestReleaseMoviesSlider" data-slide-to="0" class="active"></li>-->
<!--                    <li data-target="#latestReleaseMoviesSlider" data-slide-to="1"></li>-->
<!--                    <li data-target="#latestReleaseMoviesSlider" data-slide-to="2"></li>-->
<!--                </ol>-->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="assets/movie-posters/dune.jpg" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Dune</h5>
                            <!--                            <p>...</p>-->
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="assets/movie-posters/insurgent.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Insurgent</h5>
<!--                            <p>...</p>-->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/movie-posters/Chaos-walking.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Chaos Walking</h5>
<!--                            <p>...</p>-->
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#latestReleaseMoviesSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <span class="control-divider">|</span>
                <a class="carousel-control-next" href="#latestReleaseMoviesSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
<!--        <div class=" col-12 col-sm-12 col-md-4 col-lg-4 pr-lg-0">-->
<!--            <h3 class="text-uppercase text-white">Category</h3>-->
<!--            <ul class="list-unstyled categories-list">-->
<!--                <li><a href="">Action & Adventure</a></li>-->
<!--                <li><a href="">Romance</a></li>-->
<!--                <li><a href="">Drama</a></li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</div>
<!--  SLider and category row ends            -->

            <div class="container-xl mt-5">
                <div class="row mx-0">
                    <div class="col-12">
                        <h3 class="text-capitalize text-white font-weight-bold" >Up Coming Movies</h3>
                        <div class="cinema-movies-list">

                            <?php
                            while($comingMovie=$upComingMoviesResult->fetch_object()){
?>
                                <div class="movie card">
                                    <a href="movie.php?id=<?= $comingMovie->id ?>" class="h-100">
                                        <figure class="movie-poster">
                                            <img src="./assets/uploads/<?= $comingMovie->image ?>" class="img-fluid"  alt="movie poster here">
                                        </figure>
                                        <div class="movie-info">
                                            <h5 class="text-bold mb-1"> <b><?= $comingMovie->name ?></b> </h5>
                                            <span class="rattings"><i class="fa fa-star text-warning mx-1"></i><?= $comingMovie->imdb_ratings ?></span>
                                        </div>
                                    </a>
                                </div>

<?php
                            }
                            ?>


<!--                            -->
<!--                            <div class="movie card">-->
<!--                                <a href="#" class="h-100">-->
<!--                                    <figure class="movie-poster">-->
<!--                                        <img src="./assets/movie-posters/Red-notice.jpg" class="img-fluid"  alt="movie poster here">-->
<!--                                    </figure>-->
<!--                                    <div class="movie-info">-->
<!--                                    <h5 class="mx-1">Red Notice</h5>-->
<!--                                    <span class="rattings"><i class="fa fa-star text-warning mx-1"></i>8.1</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!---->
<!---->
<!--                            <div class="movie card">-->
<!--                                <a href="#" class="h-100 pb-3">-->
<!--                                    <figure class="movie-poster">-->
<!--                                        <img src="./assets/movie-posters/The-Matrix-Resurrections.jpg" class="img-fluid"  alt="movie poster here">-->
<!--                                    </figure>-->
<!--                                    <div class="movie-info">-->
<!--                                    <h5 class="mx-1">The Matrix Resurrections</h5>-->
<!--                                    <span class="rattings"><i class="fa fa-star text-warning mx-1"></i>7.5</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--<!--                            -->
<!--                            <div class="movie card">-->
<!--                                <a href="#" class="h-100 ">-->
<!--                                    <figure class="movie-poster">-->
<!--                                        <img src="./assets/movie-posters/venom.jpg" class="img-fluid"  alt="movie poster here">-->
<!--                                    </figure>-->
<!--                                    <div class="movie-info">-->
<!--                                    <h5 class="mx-1">Venom: Let There Be Carnage</h5>-->
<!--                                    <span class="rattings"><i class="fa fa-star text-warning mx-1"></i>8.6</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!---->
<!--                            <div class="movie card">-->
<!--                                <a href="#" class="h-100">-->
<!--                                    <figure class="movie-poster">-->
<!--                                        <img src="./assets/movie-posters/eternals.jpg" class="img-fluid"  alt="movie poster here">-->
<!--                                    </figure>-->
<!--                                    <div class="movie-info">-->
<!--                                    <h5 >Eternals</h5>-->
<!--                                    <span class="rattings"><i class="fa fa-star text-warning mr-1"></i>5.8</span>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->


                        </div>
                    </div>
                </div>


                <div class="row mx-0">
                    <div class="col-12">
                        <h3 class="text-capitalize text-white font-weight-bold" >In Cinemas Now</h3>
                        <div class="cinema-movies-list">

                            <?php
                            while($cinemaMovie=$inTheaterMoviesResult->fetch_object()){
                                ?>
                                <div class="movie card">
                                    <a href="movie.php?id=<?= $cinemaMovie->id ?>" class="h-100">
                                        <figure class="movie-poster">
                                            <img src="./assets/uploads/<?= $cinemaMovie->image ?>" class="img-fluid"  alt="movie poster here">
                                        </figure>
                                        <div class="movie-info">
                                            <h5 class="text-bold mb-1"> <b><?= $cinemaMovie->name ?></b> </h5>
                                            <span class="rattings"><i class="fa fa-star text-warning mx-1"></i><?= $cinemaMovie->imdb_ratings ?></span>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }
                            ?>


                        </div>
                    </div>
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


    </script>
</body>

</html>