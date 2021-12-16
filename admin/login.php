<?php
if(!session_id()){
    session_start();
}
echo isset($_SESSION["admin"])?$_SESSION["admin"]:null;
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
    <link href="../assets/lib/font-awesome-icons/css/all.min.css" rel="stylesheet" />

    <!-- Material Kit CSS -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <link href="../assets/css/custom.css" type="text/css" rel="stylesheet" />
</head>

<body class="dark-edition">

<div class="container-xl " >
    <div class="row mx-0 px-5 h-100 d-flex flex-row justify-content-center align-items-center" style="height:100vh!important">
        <div class="col-6">

            <?php
            if(isset($_COOKIE['errors'])){
                $errors = unserialize($_COOKIE['errors']);
                foreach($errors as $error){
                    ?>
                    <p ><?php echo $error ?></p>

                <?php }}
            unset($_COOKIE['errors']);
            ?>
            <div class="card ">
                <div class="card-header text-center text-white">
                    <h3><b>LOGIN</b></h3>
                    <hr class="border-white" />
                </div>
                <div class="card-body p-5">
                    <form action="functions/signin.php" method="POST">
                        <div class="form-group my-4">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" >
                        </div>
                        <div class="form-group my-4">
                            <label for="">Password</label>
                            <input type="text" name="password" id="password" class="form-control"  >
                        </div>
                        <div class="row mx-0">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a href="#" class="btn-link ml-3" >Register</a>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<?php
include "./layout/html_footer.php";
?>





