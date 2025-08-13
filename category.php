<?php include_once('connection.php'); ?>

<?php 
   

$uri = $_SERVER['REQUEST_URI']; 
$uriAr = explode("/", $uri);
$page = end($uriAr);
?>


<!DOCTYPE html>

<html lang="en">





<head>
    <?php include('meta.php') ?>

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />    <meta name="author" content="INSPIRO" />    

	<meta name="description" content="Jaydeck Interiors"> -->

    <link rel="icon" type="image/png" href="assets/img/favicon.png">   

    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->

    <!-- Document title -->

    <title><?php echo $categoryname ?> | Jaydeck Interiors</title>

    <!-- Stylesheets & Fonts -->

    <link href="//fonts.googleapis.com/css?family=Cedarville+Cursive" rel="stylesheet" type="text/css">



    <link href="css/plugins.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="css/custom.css" rel="stylesheet">

</head>





<body>



    <?php include('header.php');?>



    <!-- Body Inner -->

    <div class="body-inner">

         <section>

            <div class="container">

                <div class="row m-b-20">

                    <div class="col-lg-6 p-t-10 m-b-20">
                        
                     
                        <h3 class="m-b-20">Our Product Ranges</h3>

                        <p>We are stockiest of the following product ranges.</p>
                     

                    </div>

                </div>

                <!--Product list-->
                 <?php
                       if (mysqli_num_rows(mysqli_query($link,"SELECT id FROM product_categories LIMIT 1"))>0){
                       ?>


                <div id="portfolio" class="grid-layout portfolio-3-columns" data-margin="0">


                    <!-- portfolio item -->
                      <?php
                          $col=mysqli_query($link,"SELECT name as mname,id as mid ,image as mimage FROM product_categories WHERE category_level=0 AND deleted_at IS NULL ORDER BY display_order");
                              while($row=mysqli_fetch_array($col)){
                                    ?>


                    <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">

                        <div class="portfolio-item-wrap">

                            <div class="portfolio-image">

                                <a href="sub-cat?c=<?php echo $row['mid'] ?>"><img src="<?php echo $row["mimage"]; ?>" alt=""></a>

                            </div>

                            <div class="portfolio-description">

                                <a href="sub-cat?c=<?php echo $row['mid'] ?>">

                                    <h3><?php echo $row["mname"]; ?></h3>

                                </a>

                            </div>

                        </div>

                    </div>
                      <?php 
               } 
            ?> 

                    <!-- end: portfolio item -->



                </div>
            <?php 
               } 
            ?> 

            </div>

        </section>



        <?php include('footer.php'); ?>



    </div>

    <!-- end: Body Inner -->



    <!-- Scroll top -->

    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>

    <!--Plugins-->

    <script src="js/jquery.js"></script>

    <script src="js/plugins.js"></script>



    <!--Template functions-->

    <script src="js/functions.js"></script>



</body>



</html>