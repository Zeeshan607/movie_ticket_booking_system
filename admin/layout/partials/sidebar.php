<?php
include __DIR__."./../../auth.php";
?>
<div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Cenematic
                    </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="m-3 rounded profile-card text-white bg-primary text-left">
                    <div class="row m-0">
                        <div class="col-4">
                            <figure class="m-0 user-img online">
                            <img src="./../assets/img/faces/card-profile1-square.jpg" class="img-fluid user-img" alt="image here" >
              
                        </figure>
                        </div>
                        <div class="col-8">
                            <b>
                                <?php
                                if(!$admin){
                                    echo "Guest";
                                }else{
                                    echo  $admin['name'];

                                }
                                ?>
                            </b>
                   <span class="seperator"></span>
                            <span>+976543247</span>
                        </div>
                    </div>
                </div>
                <ul class="nav" id="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">
                            <i class="fa fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="user-registration.php">
                            <i class="fa fa-layer-group"></i>
                            <p>User Registration</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="cinema.php">
                            <i class="fa fa-film"></i>
                            <p>Cinema</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="movie.php">
                            <i class="fa fa-video"></i>
                            <p>Movies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="schedule.php">
                            <i class="fa fa-calendar-check"></i>
                            <p>Schedules</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="reservation.php">
                            <i class="fa fa-video"></i>
                            <p>Reservations</p>
                        </a>
                    </li>
                    <!-- your sidebar here -->
                </ul>
            </div>