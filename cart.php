<?php 
 include "./topbar.php";
 include './dbconnection/db.php';
?>

<div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                </ol>
              </nav>
            </div>
            <div id="basket" class="col-lg-9">
              <div class="box">
                <form method="post">
                  <h1>Shopping cart</h1>
                  <p class="text-muted">You currently have <span class="corttext"><?php echo $totalProduct?></span> item(s) in your cart.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th>Discount</th>
                          <th>Shipping</th>
                          <th colspan="2">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $cart_total=0;
                        $total_price=0;                     
                        $shipping_charges=0; 
                        $shipping_value=0;
                        $sub_total=0;                       
                        if(isset($_SESSION['cart'])){                                  
                            foreach($_SESSION['cart'] as $key=>$val){
                            $productArr=get_product($conn,'','',$key);
                            $id=$productArr[0]['id'];
                            $pname=$productArr[0]['pro_name'];
                            $mrp=$productArr[0]['pro_mrp'];
                            $price=$productArr[0]['pro_sell_price'];
                            $alttext=$productArr[0]['pro_meta_desc'];
                            $image=$productArr[0]['pro_image'];
                            $shipping=$productArr[0]['pro_shipping'];
                            $qty=$val['qty'];                            
                            if($qty>0) {
                              $shipping_value=$qty*$shipping;
                              $sub_total=($qty*$price)+$shipping_value;                                       
                              $shipping_charges=$shipping_charges+($qty*$shipping);
                              $cart_total=$cart_total+$sub_total;
                              $total_price=$cart_total-$shipping_charges;
                            }                                                                                
                          else{
                            echo 'Please select any quantity of the product';
                          }
                        ?>
                        <tr>
                          <td><a href="product.php?id=<?php echo $id?>"><img src="./admin/product_images/<?php echo $image ?>" alt="<?php echo $alttext?>"></a></td>
                          <td><a href="product.php?id=<?php echo $id?>"><?php echo $pname?></a></td>
                          <td>
                            <input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" class="form-control">
                          </td>
                          <td><?php echo $mrp?></td>
                          <td><?php echo $price?></td>
                          <td><?php echo $shipping.'*'.$qty.'='.$shipping_value?></td>
                          <td>₹<?php echo $sub_total?></td>
                          <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                                            <?php } }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="6">Total</th>
                          <th colspan="2">₹ <?php echo $cart_total ?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.table-responsive-->
                  <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                    <div class="left"><a href="./index.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                    <div class="right">
                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')"><button class="btn btn-outline-secondary"><i class="fa fa-refresh"></i>Update cart</button></a>
                    <?php 
                      if($cart_total>0){
                          echo ' <button type="submit" class="btn btn-primary">    <a href="checkout.php">Proceed to checkout</a> <i class="fa fa-chevron-right"></i></button> ';
                      }
                      else{
                          echo ' <button type="submit" class="btn btn-primary">   <i class="fa fa-chevron-left"></i>  <a href="index.php">go Back</a></button> ';}
                      ?>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-->
              <div class="row same-height-row">
                <div class="col-lg-3 col-md-6">
                  <div class="box same-height">
                    <h3>You may also like these products</h3>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="product same-height">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="detail.html"><img src="img/product2.jpg" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="detail.html"><img src="img/product2_2.jpg" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.html" class="invisible"><img src="img/product2.jpg" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3>Fur coat</h3>
                      <p class="price">$143</p>
                    </div>
                  </div>
                  <!-- /.product-->
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="product same-height">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="detail.html"><img src="img/product1.jpg" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="detail.html"><img src="img/product1_2.jpg" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.html" class="invisible"><img src="img/product1.jpg" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3>Fur coat</h3>
                      <p class="price">$143</p>
                    </div>
                  </div>
                  <!-- /.product-->
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="product same-height">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="detail.html"><img src="img/product3.jpg" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="detail.html"><img src="img/product3_2.jpg" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.html" class="invisible"><img src="img/product3.jpg" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3>Fur coat</h3>
                      <p class="price">$143</p>
                    </div>
                  </div>
                  <!-- /.product-->
                </div>
              </div>
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Order subtotal</td>
                        <th>₹ <?php echo $total_price ?></th>
                      </tr>
                      <tr>
                        <td>Shipping and handling</td>
                        <th>₹ <?php echo $shipping_charges?></th>
                      </tr>
                      <tr>
                        <td>Tax</td>
                        <th>₹ 0.00</th>
                      </tr>
                      <tr class="total">
                        <td>Total</td>
                        <th>₹<?php echo $cart_total?></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box">
                <div class="box-header">
                  <h4 class="mb-0">Coupon code</h4>
                </div>
                <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control"><span class="input-group-append">
                      <button type="button" class="btn btn-primary"><i class="fa fa-gift"></i></button></span>
                  </div>
                  <!-- /input-group-->
                </form>
              </div>
            </div>
            <!-- /.col-md-3-->
          </div>
        </div>
      </div>
    </div>
        
										
<?php  include "./footer.php"; ?>        