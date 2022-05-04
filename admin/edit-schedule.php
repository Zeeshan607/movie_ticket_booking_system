<?php
include "./auth.php";
include __DIR__."./../db.php";
?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit Schedule</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="../assets/lib/font-awesome-icons/css/all.min.css" rel="stylesheet" />

    <!-- Material Kit CSS -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <link href="../assets/css/custom.css" type="text/css" rel="stylesheet" />
</head>

<body class="dark-edition">



<div class="wrapper ">
    <div class="sidebar" data-color="primary" data-background-color="black" data-image="./../assets/img/sidebar-5.jpg">
        <?php include "./layout/partials/sidebar.php";?>
    </div>
    <div class="main-panel">
        <?php include "./layout/partials/header.php";?>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">

                <div class="row mx-0 mb-5">
                    <div class="col-12">
                        <h2 class="text-white">Add Schedule Details</h2>
                    </div>
                </div>

                <?php
                if(isset($_SESSION['messages'])){
                    $msgs = unserialize($_SESSION['messages']);
                    foreach($msgs as $msg){
                        ?>
                        <p class="alert alert-success alert-dismissible fade show"><?php echo $msg ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></p>
                    <?php }}
                unset($_SESSION['messages']);
                ?>
                <?php
                if(isset($_SESSION['errors'])){
                    $errs = unserialize($_SESSION['errors']);
                    foreach($errs as $err){

                        ?>
                        <p class="alert alert-danger alert-dismissible fade show"><?php echo $err ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></p>
                    <?php }}
                unset($_SESSION['errors']);
                ?>

                <?php
                if(isset($_REQUEST) && $_REQUEST['id']){
                $id=isset($_REQUEST['id'])?$_REQUEST['id']:null;
                if(empty($id)){
                    ?>
                    <p><?php echo "No id is set in request. Please retry with the correct URL" ?></p>
                    <?php
                }


                $moviesSql="SELECT * FROM `movies` WHERE `is_upcoming` IS NOT true";
                    $cinemaSql="SELECT * FROM `cinemas`";
                    $scheduleSql="SELECT * FROM `schedules` WHERE `id`='$id'";

                $cinemasResult=$conn->query($cinemaSql);
                    $moviesResult=$conn->query($moviesSql);
                    $scheduleResult=$conn->query($scheduleSql);
                    $schedule=$scheduleResult->fetch_array();

                //                    var_dump($moviesResult->fetch_object());
                //                    die;
                if(!$moviesResult || !$cinemasResult || !$scheduleResult){
                    ?>
                    <p class="alert alert-danger alert-dismissible fade show"><?php echo $conn->error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></p>

                    <?php
                }
                }
                ?>

<?//= var_dump($schedule['play_slot1']);die; ?>

                <div class="row mx-0">
                    <div class="col-12">
                        <form action="./functions/update-schedule.php?id=<?php echo $schedule["id"] ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group my-5">
                                <label for="">Select Movie</label>
                                <Select class="custom-select " name="movie_id" >
                                    <option  value="null" disabled selected>---Select---</option>
                                    <?php
                                    while($movie=$moviesResult->fetch_object()){
                                        if(!$movie){
                                            ?>
                                            <option  value="null" disabled >No movie found</option>
                                            <?php
                                        }else{
                                            ?>
                                            <option  value="<?= $movie->id ?>" <?= $schedule['movie_id']=$movie->id?"selected":'' ?> ><?= $movie->name ?></option>
                                            <?php
                                        }

                                    }
                                    ?>

                                </Select>
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Select Cinema</label>
                                <Select class="custom-select" name="cinema_id" >
                                    <option  value="null" disabled selected>---Select---</option>
                                    <?php
                                    while($cinema=$cinemasResult->fetch_object()){
                                        if(!$cinema){
                                            ?>
                                            <option value="null" disabled >No cinema found</option>
                                            <?php
                                        }else{
                                            ?>
                                            <option  value="<?= $cinema->id ?>"  <?= $schedule['cinema_id']=$cinema->id?"selected":'' ?>><?= $cinema->name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </Select>
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Play Date</label>
                                <input type="date" class="form-control"  value="<?php echo date("Y-m-d", strtotime($schedule['play_date'])) ?>" name="play_date" id="play_date">
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Play Slot 1</label>
                                <input type="time" class="form-control" value="<?php echo date("H:i:s", strtotime($schedule['play_slot1'])) ?>" name="play_slot1" id="play_slot1">
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Play Slot 2</label>
                                <input type="time" class="form-control" value="<?php echo date("H:i:s", strtotime($schedule['play_slot2'])) ?>" name="play_slot2" id="play_slot2">
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Play Slot 3</label>
                                <input type="time" class="form-control" value="<?php echo date("H:i:s", strtotime($schedule['play_slot3']))?>" name="play_slot3" id="play_slot3">
                            </div>
                            <div class="form-group my-5 ">
                                <label for="">Price per seat</label>
                                <input type="text" class="form-control" value="<?php echo $schedule['price_per_seat']?>" name="price_per_seat" id="price_per_seat">
                            </div>

                            <div class="row mx-0">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>


        <!-- footer -->
        <?php include "./layout/partials/footer.php";?>
    </div>
</div>


<!--   Core JS Files   -->
<script src="./../assets/js/core/jquery.min.js"></script>
<script src="./../assets/js/core/popper.min.js"></script>
<script src="./../assets/js/core/bootstrap-material-design.min.js"></script>
<!-- <script src="https://unpkg.com/default-passive-events"></script> -->
<script src="./../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="./../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="./../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="./../assets/js/material-dashboard.js?v=2.1.0"></script>
<script src="../assets/js/custom.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!--<script src="./../assets/demo/demo.js"></script>-->


<script type="text/javascript">
    var current = location.pathname;
    $('#nav li a').each(function(){
        var $this = $(this);
        let href=$this.attr('href');
        // if the current path is like this link, make it active
        if(current.indexOf(href) !== -1){
            $this.parent().addClass('active');
        }
    })
    ///



    //     $("#isUpcoming").on('click',function(){
    //         if(!$(this).is(':checked')){
    //             $('#release_date').addClass('d-none');
    //             $('#release_date input').prop('disabled',true);
    //         }else{
    //             $('#release_date').removeClass('d-none');
    //             $('#release_date input').prop('disabled',false);
    //         }
    // })

</script>


</body>

</html>
