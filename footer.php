    <footer id="footer" class="inverted" >

        <div class="footer-content" style="padding-bottom: 10px !important; ">

            <div class="container">

                <div class="row">

                    <div class="col-lg-4">

                        <div class="widget">

                            <div class="widget-title"><a href="index"><img src="assets/img/main-logo.png" width="30%"></a></div>

                            <br>

                            <p class="mb-5">A premier marketer of total interior projects & <br>

                            interior decorating products.</p>

                        </div>

                    </div>

                    <div class="col-lg-8">

                        <div class="row">

                            <div class="col-lg-3">

                                <div class="widget">

                                    <div class="widget-title">Links</div>

                                    <ul class="list">

                                        <li><a href="about">About Us</a></li>

                                        <li><a href="category">Products</a></li>

                                        <li><a href="service">Our Services</a></li>

                                        <li><a href="gallery">Gallery</a></li>

                                        <li><a href="contact">Contact Us</a></li>

                                    </ul>

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="widget">

                                    <div class="widget-title">Products</div>

                                    <?php

                                    if (mysqli_num_rows(mysqli_query($link,"SELECT id FROM product_categories LIMIT 1"))>0){

                                        ?>

                                        <ul class="list">

                                            <?php

                                            $col=mysqli_query($link,"SELECT name as mname,id as mid FROM product_categories  WHERE category_level=0 AND deleted_at IS NULL ORDER BY display_order");   
// LIMIT 5
                                            while($row=mysqli_fetch_array($col)){ ?>

                                                <li><a href="sub-cat?c=<?php echo $row["mid"]; ?>"><?php echo $row["mname"]; ?></a></li>

                                            <?php } ?>

                                        </ul>

                                    <?php } ?>

                                </div>

                            </div>

                            <div class="col-lg-5">

                                <div class="widget">

                                    <div class="widget-title">Contact</div>

                                    <ul class="list">

                                        <li><a href="#">Address : 189, Dr. N. M. Perera Mawatha,

                                        (Cotta Road) Colombo 08, Sri Lanka.</a></li>

                                        <li><a href="#">Phone : 0094(11) 2684641/<br> 0094(11) 5339258/<br>0094(11) 5339259/<br>(+94)773686117/<br>(+94)773412778/<br>(+94)772751990</a></li>

                                        <li><a href="mailto:www.jaydeck@net.lk" title="Email">Email :jaydeck@sltnet.lk </a> <br><a href="mailto:www.jaydeckinterior@

                                            gmail.com" title="Email">jaydeckinterior@gmail.com</a></li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="copyright-content">

            <div class="container">

                <div class="copyright-text text-center">Jaydeck Interiors &copy; 2020. All Rights Reserved. Powered by <a href="https://sltds.lk/" target="_blank"> SLTDS</a> </div>

            </div>

        </div>

    </footer>