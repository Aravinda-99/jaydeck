<?php include_once('connection.php'); ?>

<?php 
    $s=$_GET["c"];

    $category_available=mysqli_query($link,"SELECT id FROM product_categories WHERE id='$s' LIMIT 1")->num_rows;

    // if ($category_available==0) {
    //   header("location:error");
    // }
    // var_dump($category_available);

    $col=mysqli_query($link,"SELECT id,name,category_level,parent_id,image FROM `product_categories` WHERE id='$s' LIMIT 1");
    while($row=mysqli_fetch_array($col))

    {
        $categoryid=$row["id"];
        $categoryname=$row["name"];
        $parentid=$row["parent_id"];
        $productimage=$row["image"];
        $categorylevel=$row["category_level"];

    }

    $parent_col = mysqli_query($link,"SELECT name FROM `product_categories` WHERE id='$parentid' LIMIT 1");
    while($parent_row=mysqli_fetch_array($parent_col)){
        $parent = $parent_row['name'];
    }

    $num_of_product=mysqli_query($link,"SELECT id FROM products WHERE sub_cat_1_id='$categoryid'")->num_rows;

    $FullUrl = $_SERVER['REQUEST_URI']; 
        $UrlExploded = explode("/", $FullUrl);
        $EndUrl = end($UrlExploded);
?>




<!DOCTYPE html>

<html lang="en">





<head>

 <!--    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />    <meta name="author" content="INSPIRO" />    

    <meta name="description" content="Jaydeck Interiors"> -->

    <link rel="icon" type="image/png" href="assets/img/favicon.png">   

    <?php include('meta.php') ?>
<!-- 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->

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

                       <!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, sit, exercitationem, consequuntur, assumenda iusto eos commodi alias.</p>
 -->
               
                     
                    </div>

                </div>

                <!--Product list-->

                <div class="shop">
                    <?php
                                    if (mysqli_num_rows(mysqli_query($link,"SELECT id FROM product_categories WHERE parent_id='$categoryid' LIMIT 1"))>0){
                                    ?>

                    <div class="grid-layout grid-3-columns" data-item="grid-item">

                                    <?php
                                        $col=mysqli_query($link,"SELECT name as mname,id as mid,image as mimage FROM product_categories WHERE parent_id='$categoryid' ORDER BY id");
                                        
                                        while($row=mysqli_fetch_array($col)){
                                            $subcatid = $row['mid'];

                                    ?>

                        <div class="grid-item">

                            <div class="product">

                                <div class="product-image">

                                    <?php 
                                    $pro_col=mysqli_query($link,"SELECT id as pid,image as pimage FROM products WHERE sub_cat_1_id='$subcatid' ORDER BY id LIMIT 1");
                                    while($pro_row=mysqli_fetch_array($pro_col)){
                                    // var_dump($col2);
                                    ?>

                                    <a href="sub-sub-cat?s=<?php echo $row['mid'] ?>"><img alt="Shop product image!" src="<?php echo $pro_row["pimage"]; ?>">

                                    </a>
                                <?php } ?>

                                   <!--  <a href="pro-door-window"><img alt="Shop product image!" src="assets/img/shop/2.Aluminium partition and doors-windows/pro1-1.jpg">

                                    </a> -->

                                    <span class="product-new">NEW</span>

                                    <span class="product-wishlist">

                                        <a href="#"><i class="fa fa-heart"></i></a>

                                    </span>

                                    <div class="product-overlay">

                                        <a href="pro-door-window">View</a>

                                    </div>

                                </div>

                                <div class="product-description">

                                    <div class="product-title">

                                        <h3><a href="#"><?php echo $row["mname"]; ?></a></h3>

                                    </div>

                                </div>

                            </div>

                        </div>
                             <?php } ?>


                    </div>
                    <?php }else{
                        ?>
                        <div class="grid-layout grid-3-columns" data-item="grid-item">

                                    <?php

                                            $col2 = mysqli_query($link,"SELECT name as pname,id as pid,image as pimage,slug as pslug FROM products WHERE main_cat_id = '$categoryid' ORDER BY id");

                                            while($row2 = mysqli_fetch_array($col2)){

                                    ?>

                        <div class="grid-item">

                            <div class="product">

                                <div class="product-image">

                                    <a href="product?p=<?php echo $row2['pslug']; ?>"><img alt="Shop product image!" src="<?php echo $row2["pimage"]; ?>">

                                    </a>

                                   <!--  <a href="pro-door-window"><img alt="Shop product image!" src="assets/img/shop/2.Aluminium partition and doors-windows/pro1-1.jpg">

                                    </a> -->

                                    <span class="product-new">NEW</span>

                                    <span class="product-wishlist">

                                        <a href="#"><i class="fa fa-heart"></i></a>

                                    </span>

                                    <div class="product-overlay">

                                        <a href="product?p=<?php echo $row2['pslug']; ?>">View</a>

                                    </div>

                                </div>

                                <div class="product-description">

                                    <div class="product-title">

                                        <h3><a href="product?p=<?php echo $row2['pslug']; ?>"><?php echo $row2["pname"]; ?></a></h3>

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