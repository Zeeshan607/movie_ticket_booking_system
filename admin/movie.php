<?php
include  __DIR__."/auth.php";
include __DIR__."/../db.php";
?>

    <!doctype html>
    <html lang="en">
    <head>
        <title>Movies</title>
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
                        <h2>Movies</h2>
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


                <div class="row mx-0">
                    <div class="col-12 text-right">
                        <a href="add-new-movie.php" class="btn btn-primary">Add New Movie</a>
<!--                        <a href="#" id="fetch_movies_btn" class="btn btn-primary">Fetch Movies via API</a>-->
                    </div>
                </div>
                <?php
                $limit=10;
                $sql="SELECT * FROM `movies` ";
                $result=$conn->query($sql);
                $total_rows = $result->num_rows;
//                var_dump( $total_rows);
////                die();
                $total_pages = ceil ($total_rows / $limit);
                if (!isset ($_GET['page']) ) {
                    $page_number = 1;
                } else {
                    $page_number = $_GET['page'];
                }
                // get the initial page number

                $initial_page = ($page_number-1) * $limit;

                // get data of selected rows per page

                    $sql = "SELECT * FROM `movies` LIMIT " . $initial_page . ',' . $limit;
                    $result = $conn->query($sql);


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
                                <th>Genre</th>
                                <th>Imdb_ratings</th>
                                <th>Image</th>
                                <th>status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            while($movie=$result->fetch_object()){
                                ?>
                                <tr>
                                    <td><?php echo $movie->id ?></td>
                                    <td><?php echo $movie->name ?></td>
                                    <td><?php echo $movie->genre ?></td>
                                    <td><?php echo $movie->imdb_ratings ?> <i class="fa fa-star text-warning"></i></td>
                                    <td><img src="../assets/uploads/<?php echo $movie->image ?>" alt="poster here" class="img-fluid movie-image"></td>
                                    <td><?php echo $movie->is_upcoming?"Up coming":"Released" ?></td>
                                    <td>
                                        <a href="./single-movie.php?id=<?php echo $movie->id ?>" class="mx-3 text-primary"><i class="fa fa-eye"></i></a>
                                        <a href="./edit-movie.php?id=<?php echo $movie->id ?>" class="mx-3 text-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#"  class="mx-3 text-danger" data-toggle="modal" data-target="#deleteMovieModal-<?php echo $movie->id ?>"><i class="fa fa-trash"></i></a>
                                        <div class="modal fade " id="deleteMovieModal-<?php echo $movie->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMovieModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-body text-white">
                                                        <h4>Are your sure you want to delete this movie?</h4>
                                                    </div>
                                                    <div class="modal-footer border-dark">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" onclick="$('#delete-movie-<?php echo $movie->id ?>').submit()" class="btn btn-primary">yes</button>
                                                        <form action="./functions/delete-movie.php" method="post" id="delete-movie-<?php echo $movie->id ?>">
                                                            <input type="hidden" name="id" value="<?php echo $movie->id ?>">
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>

                        </table>

                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <nav aria-label="...">
                        <ul class="pagination">
<!--                            <li class="page-item ">-->

<!--                                <a href="movie.php?page=--><?php //= $page_number  ?><!--" class="page-link">Previous  </a>-->
<!--                            </li>-->
                            <?php
                            for($page_number = 1; $page_number<= $total_pages; $page_number++) {
                                if(isset($_GET['page']) && $_GET['page'] ==$page_number ){
                                ?>

                                <li class="page-item active" aria-current="page">

                                    <a href="movie.php?page=<?= $page_number ?>" class="page-link"><?= $page_number ?>  </a>
                                </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="page-item" >

                                        <a href="movie.php?page=<?= $page_number ?>" class="page-link"><?= $page_number ?>  </a>
                                    </li>

                            <?php
                            }}
                            ?>

<!--                            <li class="page-item">-->
<!--                                <a href="movie.php?page=--><?php //= $page_number++ ?><!--" class="page-link">Next</a>-->
<!--                            </li>-->
                        </ul>
                        </nav>

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

//     API call to add new movies in database

        // (function(){
        //
        //     $('#fetch_movies_btn').on('click',function(){
        //
        //
        //
        //     })
        //
        //
        // })()




</script>

</body>

</html>
