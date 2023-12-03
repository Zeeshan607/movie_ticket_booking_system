<?php
include  __DIR__."/auth.php";
include __DIR__."/../db.php";
?>

<!doctype html>
<html lang="en">
<head>
    <title>User Registrations</title>
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
                <div class="row mx-0">
                    <div class="col-12 text-white">
                        <h2>users</h2>
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


<!--                <div class="row mx-0">-->
<!--                    <div class="col-12 text-right">-->
<!--                        <a href="add-new-user.php" class="btn btn-primary">Add New user</a>-->
<!--                    </div>-->
<!--                </div>-->
                <?php
                $sql="SELECT * FROM `users`";
                $result=$conn->query($sql);
                if(!$result){
                    ?>
                    <p class="alert alert-danger alert-dismissible fade show"><?php echo $conn->error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></p>
                    <?php
                }
                ?>
                <div class="row m-0 mt-5">
                    <div class="col-12">
                        <table class="table table-responsive-sm table-bordered">
                            <thead >
                            <tr class="border-top  border-dark">
                                <th>id</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Approval Status</th>
                                <th>Action</th>


                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            while($user=$result->fetch_object()){
                                ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->name ?></td>
                                    <td><?php echo $user->age?$user->age:"N/A" ?></td>
                                    <td><?php echo $user->gender?$user->gender:"N/A" ?></td>
                                    <td><?php echo $user->address?$user->address:"N/A" ?></td>
                                    <td><?php echo $user->phone_number?$user->phone_number:"N/A" ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo $user->is_approved?"<span class='text-success'>Approved</span>":"pending..." ?></td>
                                    <td>
                                        <?php
                                        if(!$user->is_approved){
                                          ?>
                                        <a href="./functions/approve-user.php?id=<?=$user->id ?>" class="mx-3 btn btn-success btn-sm">Approve</a>
                                        <a href="#"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal-<?php echo $user->id ?>">Delete user</a>
                                        <div class="modal fade " id="deleteUserModal-<?php echo $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-body text-white">
                                                        <h4>Are your sure you want to delete this user?</h4>
                                                    </div>
                                                    <div class="modal-footer border-dark">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" onclick="$('#delete-user-<?php echo $user->id ?>').submit()" class="btn btn-primary">yes</button>
                                                        <form action="./functions/delete-user.php" method="post" id="delete-user-<?php echo $user->id ?>">
                                                            <input type="hidden" name="id" value="<?php echo $user->id ?>">
                                                        </form>
                                                        <form action="" id="testings"></form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        }else{
                                            ?>
                                            <span title="No action available"><i class="fa fa-info-circle"></i></span>

                                        <?php
                                        }
                                        ?>


                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>

                        </table>

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
