<?php 
 include "./topbar.php";
 include './dbconnection/db.php';
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
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Order review</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post">
                  <h1>Checkout - Order review</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-truck">                       </i>Delivery Method</a><a href="checkout2.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content">
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
                            <td><?php echo $qty?></td>
                            <td><?php echo $mrp?></td>
                            <td><?php echo $price?></td>
                            <td><?php echo $shipping.'*'.$qty.'='.$shipping_value?></td>
                          <td>₹<?php echo $sub_total?></td>
                          </tr>
                          <?php } }?>
                        </tbody>
                        <tfoot>
                          <tr>
                          <th colspan="6">Total</th>
                          <th colspan="1">₹<?php echo $cart_total ?></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.table-responsive-->
                  </div>
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="checkout2.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to payment method</a>
                    <button type="submit" name="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i></button>
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
<?php       
    $cart_total=0; 
    $shipping_value=0;
    $sub_total=0;    
  if(isset($_POST['submit'])){
      $user_id=$_SESSION['USER_ID']; 
      $res=mysqli_query($conn,"SELECT * FROM `users` WHERE `id`='$user_id'");
      $check=mysqli_num_rows($res);
      if($check>0){ 
        $row=mysqli_fetch_assoc($res);
        $firstname=$row['firstname'];
        $lastname=$row['lastname'];
        $mobile=$row['mobile'];
        $email=$row['email'];
        $street=$row['street'];
        $city=$row['city'];
        $dist=$row['dist'];
        $state=$row['state'];
        $zip=$row['zipcode'];
        $remark=$row['remark'];
        $shipping_method=$row['shipping_method'];
        $payment_method=$row['payment_method'];
      }                                
      foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($conn,'','',$key);
        $id=$productArr[0]['id'];
        $price=$productArr[0]['pro_sell_price'];   
        $shipping=$productArr[0]['pro_shipping'];
        $qty=$val['qty'];                          
        $shipping_value=$qty*$shipping;
        $sub_total=($qty*$price)+$shipping_value;                                      
        $cart_total=$cart_total+$sub_total;
      }       
        $total=$cart_total;
        $added_on=date('Y-m-d h:i:s');
  mysqli_query($conn,"INSERT INTO `customer_order`(`user_id`, `firstname`, `lastname`, `mobile`, `email`, `street`, `city`, `dist`, `zip`, `state`, `notes`, `order_total`, `shipping_method`, `payment_method`, `added_on`) VALUES ('$user_id','$firstname','$lastname','$mobile','$email','$street','$city','$dist','$zip','$state','$remark','$total','$shipping_method','$payment_method','$added_on')");
  
        $order_id=mysqli_insert_id($conn);   
          foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($conn,'','',$key);
            $id=$productArr[0]['id'];
            $price=$productArr[0]['pro_sell_price'];
            $shipping=$productArr[0]['pro_shipping'];
            $qty=$val['qty'];                            
            $shipping_value=$qty*$shipping;
            $sub_total=($qty*$price)+$shipping_value;                                        
                                                                                    
  mysqli_query($conn,"INSERT INTO `order_details`(`order_id`, `product_id`, `quantity`, `price`) VALUES ('$order_id','$id','$qty','$sub_total')");   
          }
        ?>
        <script>
            alert('product has been order successfully');
          </script>   
        <?php  
}
   
// unset($_SESSION['cart'])
    ?>
    <?php include "./footer.php"; ?>        