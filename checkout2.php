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
        $payment_method=get_safe_value($conn,$_POST['payment_type']);
        $user_id=$_SESSION['USER_ID'];
        if($payment_method>0 || $payment_method!=''){
          mysqli_query($conn,"UPDATE `users` SET `payment_method`='$payment_method' WHERE `id`='$user_id'");
          ?>
          <script>
            window.location.href='checkout3.php';
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
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Payment method</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post">
                  <h1>Checkout - Payment method</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-truck">                       </i>Delivery Method</a><a href="checkout2.php" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Paypal</h4>
                          <p>We like it all.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment_type" value="paypal">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Payment gateway</h4>
                          <p>VISA and Mastercard only.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment_type" value="net banking">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Cash on delivery</h4>
                          <p>You pay when you get it.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment_type" value="cod">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                  </div>
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="checkout1.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to Shipping Method</a>
                    <button type="submit" name="submit" class="btn btn-primary">Continue to Order Review<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
                <!-- /.box-->
              </div>
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