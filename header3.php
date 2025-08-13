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
                            <li class="dropdown"><a href="category">Products</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu"><a href="cat-wall-to-wall">Wall-to-Wall Carpets & Carpet Tiles</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="sub-cat-carpet-roll">Carpet Roll</a>
                                            </li>
                                            <li class="dropdown-submenu"><a href="sub-cat-carpet-tile">Carpet Tiles</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="sub-cat-carpet-tile">Nylon PVC Backing</a></li>
                                                    <li><a href="sub-cat-carpet-tile">Polyester PVC Backing</a></li>
                                                    <li><a href="sub-cat-carpet-tile">PP Bitumen Backing</a></li>
                                                    <li><a href="sub-cat-carpet-tile">PP PVC Backing</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="cat-aluminium-partition">Aluminium Partition and Doors-Windows</a></li>
                                    <li><a href="cat-ceiling-system">Ceiling Systems</a></li>
                                    <li><a href="cat-door-matting">Door Matting Heavy Duty</a></li>
                                    <li><a href="cat-vinyl-plank">Vinyl Plank Floorings</a></li>
                                    <li><a href="cat-window-blind">Window Blinds</a></li>
                                    <li><a href="cat-office-chair">Office Chair Fabric-Mesh Type</a></li>
                                    <li><a href="cat-floor-sealant">Floor Sealants<span class="badge badge-danger">NEW</span></a></li>
                                    <li><a href="cat-turn-key">Turn-Key Project Interiors</a></li>
                                    
                                </ul>
                            </li>
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