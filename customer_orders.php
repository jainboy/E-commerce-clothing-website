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
                  <li aria-current="page" class="breadcrumb-item active">My orders</li>
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
                <h1>My orders</h1>
                <p class="lead">Your orders on one place.</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact_us.php">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Pdf</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $user_id=$_SESSION['USER_ID'];
                      $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `user_id`='$user_id'");             
                      while($row=@mysqli_fetch_assoc($res)){
                        $order_id=$row['order_id'];
                        $order_date=$row['added_on'];
                        $order_total=$row['order_total'];
                        $order_status=$row['order_status']; ?>
                      <tr>
                        <th>#<?php echo $order_id ?></th>
                        <td><?php echo date_format(new DateTime($order_date),'d-m-Y');?></td>
                        <td><?php echo $order_total ?></td> 
                        <?php
												if($order_status=='pending'){
													echo " <td><span class='badge badge-info'>In Process</span></td>";
												}else if($order_status=='received' || $order_status=='complete'){
													echo " <td><span class='badge badge-success'>Received</span></td>";
												}else if($order_status=='cancelled'){
													echo " <td><span class='badge badge-danger'>Cancelled</span></td>";
												}else{
													echo "<td><span class='badge badge-warning'>Return</span></td>";
												} ?> 
                        <td><a href="order.php?id=<?php echo $order_id ?>" class="btn btn-primary btn-sm">View</a></td>
                        <td>
                        <?php if($order_status=='received' || $order_status=='complete'){ ?>
                          <a href="order_pdf.php?id=<?php echo $order_id ?>" class="btn btn-success btn-sm" target="_blank">Invoice</a></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php  include "./footer.php"; ?>        