<?php include_once('connection.php'); ?>

<?php 
$uri = $_SERVER['REQUEST_URI']; 
$uriAr = explode("/", $uri);
$page = end($uriAr);
?>

<!-- Header -->
<header id="header" data-transparent="true" data-fullwidth="true" class="dark submenu-light">
    <div class="header-inner">
        <div class="container header-bg-color">
            <!--  <div id="logo"> 
                <a href="index"><img src="assets/img/main-logo.png" width="10%"></a> 
            </div> -->
            <!--End: Logo-->
            <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" action="search-results-page.html" method="get">
                    <input class="form-control" name="q" type="search" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div> <!-- end: search -->
            <!--Header Extras-->
            <div class="header-extras">
                <ul>
                    <!-- <li> <a id="btn-search" href="#"> <i class="icon-search"></i></a> </li> -->
                    <!-- <li>
                        <div class="p-dropdown"> <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                            <ul class="p-dropdown-content">
                                <li><a href="#">French</a></li>
                                <li><a href="#">Spanish</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                    </li> -->
                </ul>
            </div>
            <!--end: Header Extras-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger"><a class="lines-button x"><span class="lines"></span></a> 
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu">
                <div class="container">
                    <a href="index"><img src="assets/img/main-logo.png" width="11%"></a>
                    <nav>
                        <ul>
                            <li><a href="index">Home</a></li>
                            <li><a href="about">About Us</a></li>
                            <?php
                            if (mysqli_num_rows(mysqli_query($link,"SELECT id FROM product_categories LIMIT 1"))>0){
                                ?>

                                <li class="dropdown"><a href="category">Products</a>

                                    <ul class="dropdown-menu">
                                        <?php
                                        $col=mysqli_query($link,"SELECT name as mname,id as mid FROM product_categories WHERE category_level=0 ORDER BY id");
                                        while($row=mysqli_fetch_array($col)){

                                          $temporycategoryid=$row["mid"];
                                          if (mysqli_num_rows(mysqli_query($link,"SELECT id as sid,name as sname FROM product_categories WHERE parent_id='$temporycategoryid' LIMIT 1"))>0){

                                            $col2=mysqli_query($link,"SELECT name as sname,id as sid FROM product_categories WHERE parent_id='$temporycategoryid' ORDER BY id");

                                        while($row2=mysqli_fetch_array($col2)){

                                            $temporysubcategoryid=$row2["sid"];
                                            if (mysqli_num_rows(mysqli_query($link,"SELECT id as ssid,name as ssname FROM product_categories WHERE parent_id='$temporysubcategoryid' LIMIT 1"))>0){
                                                ?>


                                                <li class="dropdown-submenu"><a class="dropdown-item" href="sub-cat?c=<?php echo $row["mid"]; ?>"><?php echo $row["mname"]; ?></a>

                                                    <ul class="dropdown-menu">
                                                        <?php
                                                        $subcol=mysqli_query($link,"SELECT id as sid,name as sname FROM product_categories WHERE parent_id='$temporycategoryid' ORDER BY id");
                                                        while($subrow=mysqli_fetch_array($subcol)){
                                                            ?>

                                                            <li class="dropdown-submenu"><a class="dropdown-item" href="sub-cat?s=<?php echo $subrow["sid"]; ?>"><?php echo $subrow["sname"]; ?></a>

                                                              <ul class="dropdown-menu">
                                                                 <?php
                                                                 $subcol=mysqli_query($link,"SELECT id as ssid,name as ssname FROM product_categories WHERE parent_id='$temporysubcategoryid' ORDER BY id");
                                                                 while($subrow2=mysqli_fetch_array($subcol)){
                                                                    ?>

                                                                    <li><a class="dropdown-item" href="sub-cat?s=<?php echo $subrow2["ssid"]; ?>"><?php echo $subrow2["ssname"]; ?></a> 
                                                                    </li>
                                                                <?php }?>
                                                            </ul>
                                                        </li>

                                                    <?php } ?>

                                                </ul>
                                            </li>

                                        <?php } else{
                                            ?>

                                            <li class="dropdown-submenu"><a class="dropdown-item" href="sub-cat?c=<?php echo $row["mid"]; ?>"><?php echo $row["mname"]; ?></a>

                                                <ul class="dropdown-menu">
                                                    <?php
                                                    $subcol=mysqli_query($link,"SELECT id as sid,name as sname FROM product_categories WHERE parent_id='$temporycategoryid' ORDER BY id");
                                                    while($subrow=mysqli_fetch_array($subcol)){
                                                        ?>

                                                        <li class="dropdown-submenu"><a class="dropdown-item" href="sub-cat?s=<?php echo $subrow["sid"]; ?>"><?php echo $subrow["sname"]; ?></a>
                                                        </li>
                                                    <?php } ?>

                                                </ul>
                                            </li>   

                                            <?php
                                        } }} 
                                        else{
                                            ?>

                                            <li><a class="dropdown-item" href="sub-cat?c=<?php echo $row["mid"]; ?>"><?php echo $row["mname"]; ?></a></li>
                                        <?php } } ?>

                                    </ul>
                                </li>
                            <?php }  ?>
                            <li><a href="service">Our Services</a></li>
                            <li><a href="gallery">Gallery</a></li>
                            <li><a href="contact">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>
<!-- end: Header -->