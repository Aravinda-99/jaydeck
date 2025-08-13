<?php include_once('connection.php'); ?>

<?php 
    $c=$_GET["h"];

    $category_available=mysqli_query($link,"SELECT id FROM product_categories WHERE id='$c' LIMIT 1")->num_rows;

    // if ($category_available==0) {
    //   header("location:error");
    // }

    $col=mysqli_query($link,"SELECT id,name,category_level FROM `product_categories` WHERE id='$c' LIMIT 1");
    while($row=mysqli_fetch_array($col))

    {
        $categoryid=$row["id"];
        $categoryname=$row["name"];
        $categorylevel=$row["category_level"];

    }

    $num_of_product=mysqli_query($link,"SELECT id FROM products WHERE main_cat_id='$categoryid'")->num_rows;

    $FullUrl = $_SERVER['REQUEST_URI']; 
        $UrlExploded = explode("/", $FullUrl);
        $EndUrl = end($UrlExploded);
?>




<!DOCTYPE html>

<html lang="en">





<head>

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />    <meta name="author" content="INSPIRO" />    

	<meta name="description" content="Jaydeck Interiors"> -->

    <link rel="icon" type="image/png" href="assets/img/favicon.png"> 

    <?php include('meta.php') ?>  

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
                        

                                    <h5 class="font-weight-bold pt-3">Product Categories</h5>


                        <h3 class="m-b-20"><?php echo $categoryname; ?></h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, sit, exercitationem, consequuntur, assumenda iusto eos commodi alias.</p>

               
                     
                    </div>

                </div>

                <!--Product list-->

                <div class="shop">
                    <?php
                                  if (mysqli_query($link,"SELECT id FROM products WHERE main_cat_id='$categoryid' LIMIT 1")->num_rows > 0) {
                            ?>

                             

                    <div class="grid-layout grid-3-columns" data-item="grid-item">

                                    <?php
                                    $product_col=mysqli_query($link,"
                                        SELECT p.id as pid,p.name as pname,p.slug as pslug,p.main_cat_id,c.name as cname,p.image as pimage 
                                        FROM products as p 
                                        LEFT OUTER JOIN product_categories AS c ON c.id=p.main_cat_id 
                                        WHERE main_cat_id='$categoryid'");
                                    while($product_row=mysqli_fetch_array($product_col)){
                                ?>
                        <div class="grid-item">

                            <div class="product">

                                <div class="product-image">

                                    <a href="product?p=<?php echo $product_row['pslug']; ?>"><img alt="Shop product image!" src="<?php echo $product_row["pimage"]; ?>">

                                    </a>

                                   <!--  <a href="product?p=<?php echo $product_row['pslug']; ?>"><img alt="Shop product image!" src="assets/img/shop/2.Aluminium partition and doors-windows/pro1-1.jpg">

                                    </a> -->

                                    <span class="product-new">NEW</span>

                                    <span class="product-wishlist">

                                        <a href="#"><i class="fa fa-heart"></i></a>

                                    </span>

                                    <div class="product-overlay">

                                        <a href="product?p=<?php echo $product_row['pslug']; ?>">View</a>

                                    </div>

                                </div>

                                <div class="product-description">

                                    <div class="product-title">

                                        <h3><a href="#"><?php echo $product_row["pname"]; ?></a></h3>

                                    </div>

                                </div>

                            </div>

                        </div>
                             <?php } ?>


                    </div>

                    <?php } ?>
                    <?php
                                  if (mysqli_query($link,"SELECT id FROM products WHERE sub_cat_2_id='$categoryid' LIMIT 1")->num_rows > 0) {
                            ?>
<div class="grid-layout grid-3-columns" data-item="grid-item">

                                    <?php
                                    $product_col=mysqli_query($link,"
                                        SELECT p.id as pid,p.name as pname,p.slug as pslug,p.sub_cat_2_id,c.name as cname,p.image as pimage 
                                        FROM products as p 
                                        LEFT OUTER JOIN product_categories AS c ON c.id=p.sub_cat_2_id 
                                        WHERE sub_cat_2_id='$categoryid'");
                                    while($product_row=mysqli_fetch_array($product_col)){
                                ?>
                        <div class="grid-item">

                            <div class="product">

                                <div class="product-image">

                                    <a href="product?p=<?php echo $product_row['pslug']; ?>"><img alt="Shop product image!" src="<?php echo $product_row["pimage"]; ?>">

                                    </a>

                                   <!--  <a href="product?p=<?php echo $product_row['pslug']; ?>"><img alt="Shop product image!" src="assets/img/shop/2.Aluminium partition and doors-windows/pro1-1.jpg">

                                    </a> -->

                                    <span class="product-new">NEW</span>

                                    <span class="product-wishlist">

                                        <a href="#"><i class="fa fa-heart"></i></a>

                                    </span>

                                    <div class="product-overlay">

                                        <a href="product?p=<?php echo $product_row['pslug']; ?>">View</a>

                                    </div>

                                </div>

                                <div class="product-description">

                                    <div class="product-title">

                                        <h3><a href="#"><?php echo $product_row["pname"]; ?></a></h3>

                                    </div>

                                </div>

                            </div>

                        </div>
                             <?php } ?>


                    </div>
                        <?php } ?>
                </div>

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