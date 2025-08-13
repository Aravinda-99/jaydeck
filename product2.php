<?php include_once('connection.php'); ?>
<?php 
$p=$_GET["p"];

$available=mysqli_query($link,"SELECT id FROM products WHERE slug='$p' LIMIT 1")->num_rows;

$col=mysqli_query($link,"
    SELECT p.name as pname,p.slug as pslug,p.image as pimage,p.description as pdescription,p.id as pid,c.name as cname,c.id as cid
    FROM products AS p
    LEFT OUTER JOIN product_categories AS c ON c.id=p.main_cat_id
    LEFT OUTER JOIN product_categories AS s ON s.id=p.sub_cat_1_id
    LEFT OUTER JOIN product_categories AS ss ON ss.id=p.sub_cat_2_id
    WHERE p.slug='$p'
    LIMIT 1");

while($row=mysqli_fetch_array($col))

{
    $productid=$row["pid"];
    $productname=$row["pname"];
    $productslug=$row["pslug"];
    $productdescription=$row["pdescription"];
    $productimage=$row["pimage"];
    $categoryname=$row["cname"];
    $categoryid=$row["cid"];

}
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />    

    <meta name="author" content="INSPIRO" />    

	<meta name="description" content="Jaydeck Interiors"> -->

    <link rel="icon" type="image/png" href="assets/img/favicon.png">  

    <?php include('meta.php') ?> 

   <!--  <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->

    <!-- Document title -->

    <title><?php echo $productname ?> | Jaydeck Interiors</title>

    <!-- Stylesheets & Fonts -->

    <link href="//fonts.googleapis.com/css?family=Cedarville+Cursive" rel="stylesheet" type="text/css">



    <link href="css/plugins.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="css/custom.css" rel="stylesheet">

</head>

<body>
    <!-- Body Inner -->

    <div class="body-inner">



     <?php include('header.php'); ?>  



        <!-- SHOP PRODUCT PAGE -->
        <section id="product-page" class="product-page p-b-0">
            <div class="container">
                <div class="product">
                    <div class="row m-b-40">
                        <div class="col-lg-5">
                            <div class="product-image">
                                <!-- Carousel slider -->
                                <div class="carousel dots-inside dots-dark arrows-visible" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="2500" data-lightbox="gallery">
                                    <a href="<?php echo $productimage ?>" data-lightbox="image" title="Shop product image!">
                                        <img alt="Shop product image!" src="<?php echo $productimage ?>">
                                    </a>
                                </div>
                                <!-- Carousel slider -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-description">
                                <div class="product-category"><?php echo $categoryname ?></div>
                                <div class="product-title">
                                    <h3><a href="#"><?php echo $productname ?></a></h3>
                                </div>
                                <!-- <div class="product-rate">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                                <div class="product-reviews"><a href="#">3 customer reviews</a>
                                </div> -->
                                <div class="seperator m-b-10"></div>
                                <p><?php echo $productdescription ?></p>
                                <div class="product-meta">
                                    <p>Tags: <a href="#" rel="tag">Wood</a>, <a rel="tag" href="#">Table</a>
                                    </p>
                                </div>
                                <div class="seperator m-t-20 m-b-10"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Product additional tabs -->
                    <div class="tabs tabs-folder">
                        <ul class="nav nav-tabs" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-align-justify"></i>Description</a></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-info"></i>Additional
                                    Info</a></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-star"></i>Inquiry</a></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent3">
                            <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab">
                                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis
                                    dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum
                                    necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non
                                    recusandae. </p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                    voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                    occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt
                                    mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                    expedita distinctio.</p>
                            </div>
                            <div class="tab-pane fade " id="profile3" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <!-- <tr>
                                            <td>Size</td>
                                            <td>Small, Medium &amp; Large</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>Pink &amp; White</td>
                                        </tr>
                                        <tr>
                                            <td>Waist</td>
                                            <td>26 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Length</td>
                                            <td>40 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Chest</td>
                                            <td>33 inches</td>
                                        </tr>
                                        <tr>
                                            <td>Fabric</td>
                                            <td>Cotton, Silk &amp; Synthetic</td>
                                        </tr>
                                        <tr>
                                            <td>Warranty</td>
                                            <td>3 Months</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab">
                                <form class="widget-contact-form" novalidate action="include/contact-form.php" role="form" method="post">

                            <div class="row">

                                <div class="form-group col-md-6">

                                    <label for="name">Name</label>

                                    <input type="text" aria-required="true" name="widget-contact-form-name" required class="form-control required name" placeholder="Enter your Name">

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="email">Email</label>

                                    <input type="email" aria-required="true" name="widget-contact-form-email" required class="form-control required email" placeholder="Enter your Email">

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-md-12">

                                    <label for="subject">Your Subject</label>

                                    <input type="text" name="widget-contact-form-subject" required class="form-control required" placeholder="Subject...">

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="message">Message</label>

                                <textarea type="text" name="widget-contact-form-message" required rows="5" class="form-control required" placeholder="Enter your Message"></textarea>

                            </div>

                            <!--    <div class="form-group">

                                    <script src="https://www.google.com/recaptcha/api.js"></script>

                                    <div class="g-recaptcha" data-sitekey="6LddCxAUAAAAAKOg0-U6IprqOZ7vTfiMNSyQT2-M"></div>

                                </div> -->

                            <button class="btn" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>

                        </form>
                            </div>
                        </div>
                    </div>
                    <!-- end: Product additional tabs -->
                </div>
            </div>
        </section>
        <!-- end: SHOP PRODUCT PAGE -->

        <!-- SHOP WIDGET PRODUTCS -->
        <section class="p-t-0">
            <div class="container">
                <div class="heading-text heading-line text-center">
                        <?php

                        $related_col=mysqli_query($link,"
                            SELECT p.name as pname,p.slug as pslug,p.image as pimage,p.description as pdescription,p.id as pid,c.name as cname,p.sub_cat_id
                            FROM products AS p
                            LEFT OUTER JOIN product_categories AS c ON c.id=p.main_cat_id
                            WHERE NOT(p.id=$productid) AND p.main_cat_id = $categoryid 
                            LIMIT 8");


                            ?>
                    <h4>Related Products you may be interested!</h4>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget-shop">
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product2.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Product</a></h3>
                                    </div>
                                    <div class="product-price"><del>$30.00</del><ins>$15.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product3.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Product</a></h3>
                                    </div>
                                    <div class="product-price"><ins>$39.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget-shop">
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product5.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Product</a></h3>
                                    </div>
                                    <div class="product-price"><ins>$39.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product6.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Product</a></h3>
                                    </div>
                                    <div class="product-price"><ins>$39.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget-shop">
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product8.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Bolt Sweatshirt</a></h3>
                                    </div>
                                    <div class="product-price"><del>$30.00</del><ins>$15.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product-image">
                                    <a href="#"><img src="assets/img/products/product9.jpg" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Product</a></h3>
                                    </div>
                                    <div class="product-price"><ins>$39.00</ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: SHOP WIDGET PRODUTCS -->



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