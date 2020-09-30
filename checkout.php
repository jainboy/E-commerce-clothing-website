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
        $first_name='';
        $last_name='';
        $email='';
        $phone='';
        $street='';
        $city='';
        $dist='';
        $state='';
        $zipcode='';
        $state='';
        $notes='';
    if(isset($_SESSION['USER_LOGIN'])){
     $user_id=$_SESSION['USER_ID'];
     $res=mysqli_query($conn,"SELECT * FROM `users` where id='$user_id'");
     $check=mysqli_num_rows($res);
     if($check>0){
        $row=mysqli_fetch_assoc($res);
        $firstname=$row['firstname'];
        $lastname=$row['lastname'];
        $email=$row['email'];
        $phone=$row['mobile'];
        $street=$row['street'];
        $city=$row['city'];
        $dist=$row['dist'];
        $state=$row['state'];
        $zip=$row['zipcode'];
     }
  }

if(isset($_POST['submit'])){
	$firstname=get_safe_value($conn,$_POST['firstname']);
	$lastname=get_safe_value($conn,$_POST['lastname']);
	$phone=get_safe_value($conn,$_POST['phone']);
  $email=get_safe_value($conn,$_POST['email']);
  $street=get_safe_value($conn,$_POST['street']);
	$city=get_safe_value($conn,$_POST['city']);
	$dist=get_safe_value($conn,$_POST['dist']);
  $zip=get_safe_value($conn,$_POST['zip']);
  $state=get_safe_value($conn,$_POST['state']);
	$notes=get_safe_value($conn,$_POST['notes']);
	$user_id=$_SESSION['USER_ID'];

	mysqli_query($conn,"UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`mobile`='$phone',`street`='$street',`city`='$city',`dist`='$dist',`state`='$state',`zipcode`='$zip',`remark`='$notes' WHERE `id`='$user_id'");
  ?>
  <script>
    window.location.href='checkout1.php';
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
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Address</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post">
                  <h1>Checkout - Address</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker">                  </i>Address</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-truck">                       </i>Delivery Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="firstname"class="required">Firstname</label>
                          <input id="firstname" name="firstname" type="text" value="<?php echo $firstname ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group"class="required">
                          <label for="lastname"class="required">Lastname</label>
                          <input id="lastname" name="lastname" type="text" value="<?php echo $lastname ?>" class="form-control"required>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone"class="required">Phone</label>
                          <input id="phone" name="phone" type="text" value="<?php echo $phone ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input id="email" name="email" type="text" value="<?php echo $email ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="street"class="required">Street</label>
                          <input id="street" name="street" type="text" value="<?php echo $street ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="company"class="required">City</label>
                          <input id="company" name="city" type="text" value="<?php echo $city ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="company"class="required">Disst</label>
                          <input id="company" name="dist" type="text" value="<?php echo $dist ?>" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">         
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="zip"class="required">ZIP</label>
                          <input id="zip" name="zip" type="text" value="<?php echo $zip ?>" class="form-control" required>
                        </div>
                      </div> 
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="state"class="required">State</label>
                          <select id="state" name="state"  class="form-control" required>
                            <option value="<?php $state?>">Select</option>
                            <option>Andhra Pradesh</option>
                            <option>Andaman and Nicobar Islands</option>
                            <option>Arunachal Pradesh</option>
                            <option>Assam</option>
                            <option>Bihar</option>
                            <option>Chandigarh</option>
                            <option>Chhattisgarh</option>
                            <option>Dadar and Nagar Haveli</option>
                            <option>Daman and Diu</option>
                            <option>Delhi</option>
                            <option>Lakshadweep</option>
                            <option>Puducherry</option>
                            <option>Goa</option>
                            <option>Gujarat</option>
                            <option>Haryana</option>
                            <option>Himachal Pradesh</option>
                            <option>Jammu and Kashmir</option>
                            <option>Jharkhand</option>
                            <option>Karnataka</option>
                            <option>Kerala</option>
                            <option>Madhya Pradesh</option>
                            <option>Maharashtra</option>
                            <option>Manipur</option>
                            <option>Meghalaya</option>
                            <option>Mizoram</option>
                            <option>Nagaland</option>
                            <option>Odisha</option>
                            <option>Punjab</option>
                            <option>Rajasthan</option>
                            <option>Sikkim</option>
                            <option>Tamil Nadu</option>
                            <option>Telangana</option>
                            <option>Tripura</option>
                            <option>Uttar Pradesh</option>
                            <option>Uttarakhand</option>
                            <option>West Bengal</option>
                          </select>
                        </div>
                      </div> 
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="city">Additional Notes</label>
                          <textarea name="notes" class="form-control"></textarea>
                        </div>
                      </div>   
                  </div>       
                    <!-- /.row-->
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="cart.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to Cart</a>
                    <button type="submit" name="submit" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i></button>
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