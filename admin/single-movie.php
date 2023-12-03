<?php
include __DIR__."/auth.php";
include __DIR__."/../db.php";
?>

<!doctype html>
<html lang="en">
<head>
    <title>View Movie</title>
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
    <link href="../assets/css/admin.css" type="text/css" rel="stylesheet" />
</head>

<body class="dark-edition">

<div class="wrapper ">
    <div class="sidebar" data-color="primary" data-background-color="black" data-image="./../assets/img/sidebar-5.jpg">
        <?php include __DIR__."/layout/partials/sidebar.php";?>
    </div>
    <div class="main-panel">
        <?php include __DIR__."/layout/partials/header.php";?>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">

<!--                --><?php
//                if(isset($_SESSION['messages'])){
//                    $msgs = unserialize($_SESSION['messages']);
//                    foreach($msgs as $msg){
//                        ?>
<!--                        <p class="alert alert-success alert-dismissible fade show">--><?php //echo $msg ?>
<!--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button></p>-->
<!--                    --><?php //}}
//                unset($_SESSION['messages']);
//                ?>


                <?php
                $id= $_REQUEST["id"]?$_REQUEST['id']:null;
                $sql="SELECT * FROM `movies` WHERE `id`= $id";
                $result=$conn->query($sql);
                $movie=$result->fetch_object();
                if(!$result){
                    ?>
                    <p class="alert alert-danger alert-dismissible fade show"><?php echo $conn->error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></p>
                    <?php
                }

                ?>

                <div class="row mx-0">
                    <div class="col-4">
                        <img src="../assets/uploads/<?= $movie->image ?>" class="single-movie-image" alt="poster here">
                    </div>
                    <div class="col-8 text-white">
                        <h1><b><?=  $movie->name ?></b></h1>
                        <div class="star-ratings mb-4">
                            <i class="fa fa-star text-warning"></i>
                            9.5 IMDB ratings
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







            </div>
        </div>


        <!-- footer -->
        <?php include __DIR__."/layout/partials/footer.php";?>
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
<script src="./../assets/js/custom.js"></script>
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

</script>

</body>

</html>
