<?php
include __DIR__."/auth.php";
include __DIR__."/../db.php";

?>

 <!doctype html>
    <html lang="en">
    <head>
        <title>Edit Cinema</title>
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
<?php include __DIR__."/layout/partials/sidebar.php";?>
        </div>
        <div class="main-panel">
            <?php include __DIR__."/layout/partials/header.php";?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row mx-0 mb-5">
                        <div class="col-12">
                            <h2 class="text-white">Edit Cinema Details</h2>
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
                            <p><?php echo "No id is set in request. Please re-hit the correct URL" ?></p>
                                <?php
                        }

                        $sql= "SELECT * FROM `cinemas` WHERE `id` = $id";
                        $result=$conn->query($sql);
                        if($conn->error){
                        ?>

                        <p><?php echo "Query Error: ".$conn->error   ?></p>

                        <?php
                        }
                        $row=$result->fetch_array();
                    }
                    ?>
                        <div class="row mx-0">
                            <div class="col-12">
                                <form action="./functions/update-cinema.php?id=<?php echo $id  ?>" method="post">
                                    <div class="form-group my-5">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="name" value="<?php echo $row["name"]   ?>" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">City</label>
                                        <input type="text" name="city" id="city" value="<?php echo $row["city"]   ?>" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">Address</label>
                                        <input type="text" name="address" id="adddress" value="<?php echo $row["address"]   ?>" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">Number of Seats</label>
                                        <input type="number" name="seats" id="seats" step="10" value="<?php echo $row["seats"]   ?>" class="form-control" autocomplete="off">
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
            <?php $conn->close() ?>

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
