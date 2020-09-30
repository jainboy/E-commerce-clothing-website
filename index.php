<?php
 include "./topbar.php";
 ?>
<?php
    include './dbconnection/db.php';
    $res=mysqli_query($conn,"SELECT * FROM `slider` WHERE `status`='1'");
?>
    <div id="all">
      <div id="content">
        <div class="container1">
          <div class="row">
            <div class="col-md-12">
              <div id="main-slider" class="owl-carousel owl-theme">
                <?php 
                    while($row=@mysqli_fetch_assoc($res)){?>
                    <div class="item"><img src="./admin/slider_images/<?php echo $row['image'];  ?>" alt="<?php echo $row['Alt_text'];  ?>" class="img-fluid"></div>
                <?php } ?>   
              </div>              
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>    
              <!-- /#main-slider-->
            </div>
          </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
          <div class="container">
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-heart"></i></div>
                  <h3><a href="#">We love our customers</a></h3>
                  <p class="mb-0">We are known to provide best possible service ever</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-tags"></i></div>
                  <h3><a href="#">Best prices</a></h3>
                  <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                  <h3><a href="#">100% satisfaction guaranteed</a></h3>
                  <p class="mb-0">Free returns on everything for 3 months.</p>
                </div>
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->

                          <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">Hot this week</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="product-slider owl-carousel owl-theme">
            <?php
							$get_product=get_product($conn,4);
							foreach($get_product as $list){
							?>
              <div class="item">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><a href="product.php?id=<?php echo $list['id']?>"><img src="./admin/product_images/<?php echo $list['pro_image'];  ?>" alt="<?php echo $list['pro_meta_keyword'];  ?>" class="img-fluid"></a></div>
                      <div class="back"><a href="product.php?id=<?php echo $list['id']?>"><img src="./admin/product_images/<?php echo $list['pro_img1'];  ?>" alt="<?php echo $list['pro_meta_keyword'];  ?>" class="img-fluid"></a></div>
                    </div>
                  </div><a href="product.php?id=<?php echo $list['id']?>" class="invisible"><img src="./admin/product_images/<?php echo $list['pro_image'];  ?>" alt="<?php echo $list['pro_meta_keyword'];  ?>" class="img-fluid"></a>
                  <div class="text">
                    <h3><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['pro_name'];  ?></a></h3>
                    <p class="price"> 
                      <del></del><?php echo $list['pro_sell_price'];  ?>
                    </p>
                  </div>
                  <!-- /.text-->
                  <!-- <div class="ribbon sale">
                    <div class="theribbon">SALE</div>
                    <div class="ribbon-background"></div>
                  </div> -->
                  <!-- /.ribbon-->
                  <div class="ribbon new">
                    <div class="theribbon">NEW</div>
                    <div class="ribbon-background"></div>
                  </div>
                  <!-- /.ribbon-->
                  <!-- <div class="ribbon gift">
                    <div class="theribbon">GIFT</div>
                    <div class="ribbon-background"></div>
                  </div> -->
                  <!-- /.ribbon-->
                </div>
                <!-- /.product-->
              </div>
              <?php } ?>
           
              <!-- /.product-slider-->
            </div>
            <!-- /.container-->
          </div>
          <!-- /#hot-->
          <!-- *** HOT END ***-->
        </div>
        


    <div class="container1">
          <div class="col-md-12">
            <div id="blog-homepage" class="row">
              <div class="col-sm-6">
                <div class="post1">
                  <p class="intro"><img src="img/bottom1.jpg" alt=" " class="img-responsive" /></p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="post1">
                <p class="intro"><img src="img/bottom2.jpg" alt=" " class="img-responsive" /></p>
                </div>
              </div>
            </div>
</div>
</div>

<!-- *** GET INSPIRED ***
        _________________________________________________________
        -->
        <div class="container1">
          <div class="col-md-12">
            <div class="box slideshow">
              <h3>Get Inspired</h3>
              <p class="lead">Get the inspiration from our world class designers</p>
              <div id="get-inspired" class="owl-carousel owl-theme">
                <div class="item"><a href="#"><img src="img/getinspired1.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="img/getinspired2.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="img/getinspired3.jpg" alt="Get inspired" class="img-fluid"></a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- *** GET INSPIRED END ***-->
        <!--
        *** BLOG HOMEPAGE ***
        _________________________________________________________
        -->
        <div class="box text-center">
          <div class="container">
            <div class="col-md-12">
              <h3 class="text-uppercase">From our blog</h3>
              <p class="lead mb-0">What's new in the world of fashion? <a href="blog.html">Check our blog!</a></p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="col-md-12">
            <div id="blog-homepage" class="row">
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="post.html">Fashion now</a></h4>
                  <p class="author-category">By <a href="#">John Slim</a> in <a href="">Fashion and style</a></p>
                  <hr>
                  <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                  <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="post.html">Who is who - example blog post</a></h4>
                  <p class="author-category">By <a href="#">John Slim</a> in <a href="">About Minimal</a></p>
                  <hr>
                  <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                  <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
            </div>
            <!-- /#blog-homepage-->
          </div>
        </div>
        <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
      </div>
    </div>
    <!--

<?php
 include"./footer.php";
 ?>