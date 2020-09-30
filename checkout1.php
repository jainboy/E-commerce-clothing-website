<?php 
 include "./topbar.php";
 include './dbconnection/db.php';
   error_reporting (E_ALL ^ E_NOTICE); 
      if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
        ?>
        <script>
          window.location.href='index.php';
        </script>
        <?php
      }						
      if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
          window.location.href='ragistration.php';
        </script>
      <?php
      }
      if(isset($_POST['submit'])){
        $shipping_method=get_safe_value($conn,$_POST['delivery']);
        $user_id=$_SESSION['USER_ID'];
        if($shipping_method>0 || $shipping_method!=''){
          mysqli_query($conn,"UPDATE `users` SET `shipping_method`='$shipping_method' WHERE `id`='$user_id'");
          ?>
          <script>
            window.location.href='checkout2.php';
          </script>
        <?php      
        }
       else{
          ?>
            <script>
              alert ('please select a option');
            </script>
          <?php    
       } 
    }
      ?>
      
 <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Delivery method</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post">
                  <h1>Checkout - Delivery method</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout2.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-truck">                       </i>Delivery Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>BY AEROPLAN</h4>
                          <p>Get it right on 1-2 <b>DAYS</b> - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="1-2 days">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>BY SHIP</h4>
                          <p>Get it right on 3-4 <b>DAYS</b> - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="3-4 days">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>BY CURRIER</h4>
                          <p>Get it right on 4-7 <b>DAYS</b> - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="4-7 days">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="checkout.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to address</a>
                    <button type="submit" name="submit" class="btn btn-primary">Continue to Payment Method<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
             <!-- /.col-lg-9-->
             <div class="col-lg-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                  <h3 class="mt-4 mb-4">Order summary</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <?php
                        if(isset($_SESSION['cart'])){
                            $total_price=0;
                            $shipping_charges=0;
                            $cart_total=0;
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
                            $shipping_value=$qty*$shipping;
                            $sub_total=($qty*$price)+$shipping_value;                                       
                            $shipping_charges=$shipping_charges+($qty*$shipping);
                            $cart_total=$cart_total+$sub_total;
                            $total_price=$cart_total-$shipping_charges;
                          }}
                        ?>
                        <tr>
                          <td>Order subtotal</td>
                          <th>₹ <?php echo $total_price?></th>
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
              </div>
            </div>
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>
   
<?php  include "./footer.php"; ?>        