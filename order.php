<?php 
 include "./topbar.php";
 include './dbconnection/db.php';
  //  error_reporting (E_ALL ^ E_NOTICE); 
      if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
          window.location.href='ragistration.php';
        </script>
      <?php
      }
      $image='';
if(isset($_SESSION['USER_LOGIN'])){
$image_required='';
$user_id=$_SESSION['USER_ID'];
$res=mysqli_query($conn,"SELECT * FROM `users` where id='$user_id'");
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$image=$row['image'];
}
}
      $order_id=get_safe_value($conn,$_GET['id']);
      $order_date='';
      $order_status='';
      $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
      $check=mysqli_num_rows($res);
      if($check>0){
        $row=mysqli_fetch_assoc($res);
        $order_date=$row['added_on'];
        $order_status=$row['order_status'];
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
                  <li aria-current="page" class="breadcrumb-item"><a href="customer_orders.php">My orders</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Order # <?php echo $order_id ?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu">
                <div class="card-header">
                  <h3 class="h4 card-title">Customer section</h3>
                </div>
                <div class="card-body">
                <a href="#" class="nav-link"><img src="./img/userimage/<?php echo $image ?>" class="img-thumbnail"></a>  
                <a href="customer_orders.php" class="nav-link  active"><i class="fa fa-list"></i> My orders</a>
                <a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
                <a href="account.php" class="nav-link"><i class="fa fa-user"></i> My account</a>
                <a href="change_password.php" class="nav-link"><i class="fa fa-eye"></i> Change Password</a>
                <a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></ul>   
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div id="customer-order" class="col-lg-9">
              <div class="box">
                <h1>Order #<?php echo $order_id ?></h1>
                <p class="lead">Order #<?php echo $order_id ?> was placed on <strong><?php echo date_format(new DateTime($order_date),'d-m-Y'); ?></strong> and is currently <strong><?php echo $order_status?></strong>.</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                <div class="table-responsive mb-4">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="2">Product</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Shipping</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
											$uid=$_SESSION['USER_ID'];
											$res1=mysqli_query($conn,"SELECT DISTINCT(`order_details`.`id`) ,`order_details`.*,`product`.`pro_name`,`product`.`pro_image`,`product`.`pro_sell_price`,`product`.`pro_shipping`,`product`.`id` FROM `order_details`,`product`,`customer_order` WHERE `order_details`.`order_id`='$order_id' AND `customer_order`.`user_id`='$uid' AND `order_details`.`product_id`=`product`.`id`");
                      $total_price=0;
                      $shipping_charges=0;
                      $cart_total=0;
											while($row1=mysqli_fetch_assoc($res1)){
                      $total_price=$total_price+($row1['quantity']*$row1['price']);
                      $shipping_value=$row1['quantity']*$row1['pro_shipping'];
                      $sub_total=($row1['quantity']*$row1['price'])+$shipping_value;                                       
                      $shipping_charges=$shipping_charges+($row1['quantity']*$row1['pro_shipping']);
                      $cart_total=$cart_total+$sub_total;
                      $total_price=$cart_total-$shipping_charges;
											?>
                      <tr>
                        <td><a href="product.php?id=<?php echo $row1['id']?>"><img src="./admin/product_images/<?php echo $row1['pro_image']?>" alt="White Blouse Armani"></a></td>
                        <td><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['pro_name']?></a></td>
                        <td><?php echo $row1['quantity']?></td>
                        <td><?php echo $row1['pro_sell_price']?></td>
                        <td><?php echo $row1['quantity'].'*'.$row1['pro_shipping'].'='.$shipping_value?></td>
                        <td><?php echo $sub_total?></td>
                      </tr>
                     <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5" class="text-right">Order subtotal</th>
                        <th><?php echo $total_price ?></th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Shipping and handling</th>
                        <th><?php echo $shipping_charges ?></th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Tax</th>
                        <th>$0.00</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th><?php echo $cart_total?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.table-responsive-->
                <div class="row addresses">
                  <div class="col-lg-6">
                    <h2>Invoice address</h2>
                    <p>John Brown<br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br>Great Britain</p>
                  </div>
                  <div class="col-lg-6">
                    <h2>Shipping address</h2>
                      <?php $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
                            $check=mysqli_num_rows($res);
                            if($check>0){
                              $row=mysqli_fetch_assoc($res);
                              $firstname=$row['firstname'];
                              $lastname=$row['lastname'];
                              $street=$row['street'];
                              $city=$row['city'];
                              $dist=$row['dist'];
                              $zip=$row['zip'];
                              $state=$row['state'];
                      }?>
                    <p><?php echo $firstname.' '.$lastname?><br><?php echo $street?><br><?php echo $city?><br><?php echo $dist?><br><?php echo $zip?><br><?php $state?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php  include "./footer.php"; ?>        