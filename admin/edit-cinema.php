<?php include "./auth.php"; ?>

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

                        <div class="row mx-0">
                            <div class="col-12">
                                <form action="./functions/update-cinema.php" method="post">
                                    <div class="form-group my-5">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">City</label>
                                        <input type="text" name="city" id="city" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">Address</label>
                                        <input type="text" name="address" id="adddress" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-5">
                                        <label for="">Number of Seats</label>
                                        <input type="text" name="seats" id="seats" class="form-control" autocomplete="off">
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



<?php include "./layout/html_footer.php";?>