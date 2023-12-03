<?php
if(!session_id()){
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="./assets/lib/font-awesome-icons/css/all.min.css" rel="stylesheet" />

    <!-- Material Kit CSS -->
    <link href="./assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <link href="./assets/css/custom.css" type="text/css" rel="stylesheet" />
</head>

<body class="dark-edition">

<div class="container-xl " >
    <div class="row mx-0 px-5 h-100 d-flex flex-row justify-content-center align-items-center" style="height:100vh!important">
        <div class="col-6">

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



            <div class="card ">
                <div class="card-header text-center text-white">
                    <h3><b>Register</b></h3>
                    <hr class="border-white" />
                </div>
                <div class="card-body p-5">
                    <form action="functions/register.php" method="POST">
                        <div class="row mx-0">
                            <div class="col-6 pl-0">
                                <div class="form-group my-4">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-6 pr-0">
                                <div class="form-group my-4">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-6 pl-0">
                                <div class="form-group my-4">
                                    <label for="email">Age</label>
                                    <input type="text" name="age" id="age" class="form-control" >
                                </div>
                            </div>
                            <div class="col-6 pr-0">
                                <div class="form-group my-4">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="custom-control custom-select bg-card-body text-light border-top-0  border-left-0 border-right-0  border-dark" id="" >
                                        <option value="null" disabled selected>--select--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>

<!--                                    <input type="text" name="gender" id="gender" class="form-control" >-->
                                </div>
                            </div>
                        </div>


                        <div class="form-group my-4">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" >
                        </div>
                        <div class="form-group my-4">
                            <label for="phone_number">Phone number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" >
                        </div>

                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" >
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"  >
                        </div>
                        <div class="row mx-0">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>


                    </form>

                </div>

            </div>
        </div>
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
<script src="./assets/lib/input-mask/jquery.inputmask.js"></script>
<script src="./assets/js/custom.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!--<script src="./../assets/demo/demo.js"></script>-->
<script type="text/javascript">
    $(document).ready(function(){
    $("#phone_number").inputmask("+99-999-9999999");

    })
</script>

</body>

</html>




