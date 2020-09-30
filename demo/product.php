<?php
  include './dbconnection/db.php';
?>
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
                      <div class="front"><a href="product.php?id=<?php echo $list['id']?>"><img src="./admin/product_images/<?php echo $list['pro_image'];  ?>" alt="<?php echo $list['Meta_keyword'];  ?>" class="img-fluid"></a></div>
                      <div class="back"><a href="product.php?id=<?php echo $list['id']?>"><img src="./admin/product_images/<?php echo $list['pro_img1'];  ?>" alt="<?php echo $list['meta_keyword'];  ?>" class="img-fluid"></a></div>
                    </div>
                  </div><a href="product.php?id=<?php echo $list['id']?>" class="invisible"><img src="./admin/product_images/<?php echo $list['pro_image'];  ?>" alt="<?php echo $list['meta_keyword'];  ?>" class="img-fluid"></a>
                  <div class="text">
                    <h3><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['pro_name'];  ?></a></h3>
                    <p class="price"> 
                      <del></del><?php echo $list['pro_sell_price'];  ?>
                    </p>
                  </div>
                  <!-- /.text-->
                  <div class="ribbon sale">
                    <div class="theribbon">SALE</div>
                    <div class="ribbon-background"></div>
                  </div>
                  <!-- /.ribbon-->
                  <div class="ribbon new">
                    <div class="theribbon">NEW</div>
                    <div class="ribbon-background"></div>
                  </div>
                  <!-- /.ribbon-->
                  <div class="ribbon gift">
                    <div class="theribbon">GIFT</div>
                    <div class="ribbon-background"></div>
                  </div>
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


      