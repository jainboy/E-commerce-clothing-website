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
      $uid=$_SESSION['USER_ID'];
      if(isset($_GET['wishlist_id'])){
        $wid=$_GET['wishlist_id'];
        mysqli_query($conn,"DELETE FROM `wishlist` WHERE `id`='$wid' AND `user_id`='$uid'");
      }
      $res=mysqli_query($conn,"SELECT `product`.`pro_name`,`product`.`pro_image`,`product`.`pro_sell_price`,`product`.`pro_mrp`,`wishlist`.`id` FROM `product`,`wishlist` WHERE `wishlist`.`product_id`=`product`.`id` AND `wishlist`.`user_id`='$uid'");
      
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
                  <li aria-current="page" class="breadcrumb-item active">My Wishlist</li>
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
                <?php if($image=='image'){?>
                    <img src="./img/userimage/<?php echo $image ?>" class="img-thumbnail"> 
                  <?php } else{ ?>
                  <img src="./img/admin.png" class="img-thumbnail">
                  <?php } ?>
                <a href="customer_orders.php" class="nav-link active"><i class="fa fa-list"></i> My orders</a>
                <a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
                <a href="account.php" class="nav-link"><i class="fa fa-user"></i> My account</a>
                <a href="change_password.php" class="nav-link"><i class="fa fa-eye"></i> Change Password</a>
                <a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></ul>  
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div id="customer-orders" class="col-lg-9">
              <div class="box">
                <h1>My Wishlist</h1>
                <p class="lead">You can orders These wishlist products.</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact_us.php">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Details</th>
                        <th>Unit Price</th>
                        <th>Selling Price</th>
                        <th>Remove</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
										while($row=mysqli_fetch_assoc($res)){
										?>
                    <tr>
                          <td width="150px"><a href="#"><img src="./admin/product_images/<?php echo $row['pro_image']?>" alt="<?php echo $row['pro_meta_keyword']?>" style="width:50%;"></a></td>
                          <td><a href="#"><?php echo $row['pro_name']?></a></td>
                          <td><?php echo $row['pro_mrp']?></td>
                          <td><?php echo $row['pro_sell_price']?></td>
                          <td><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer d-flex justify-content-between flex-column flex-lg-row __web-inspector-hide-shortcut__">
                    <div class="left"><a href="category.html" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                    <div class="right">
                      <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>
<?php  include "./footer.php"; ?>        