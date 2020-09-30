<?php
// error_reporting (E_ALL ^ E_NOTICE); 
    session_start();
    if ( $_SESSION['USER_NAME']==true)
    {
      $user_id=$_SESSION['USER_ID'];
      $username=$_SESSION['USER_NAME'];
      $userimage=$_SESSION['USER_IMAGE'];
    }
    else
    {
      header('location:admin_login.php');
    }
?>
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="./slider_images/admin_images/<?php echo $userimage?>" class="w3-circle" >
    </div>
    <div class="w3-col s8 w3-bar">
      <a href="./contact_form.php" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="./user.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="./manage_admin.php" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
      <span>&nbsp;&nbsp;&nbsp;Welcome, <strong><?php echo $username?></strong></span><br>
    </div>
  </div>
  <hr>
  
  <div class="w3-bar-block sidenav">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="admin_dashboard.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-tachometer"></i>  Dashboard Overview</a>
    <a href="#" class="w3-bar-item w3-button w3-padding drop-down"><i class="fa fa-shopping-basket"></i>  Order  
    <i class="fa fa-caret-down"></i>
    </a>
      <div class="drop-down-container">
        <a href="all_order.php">All Order</a>
        <a href="pending_order.php">Panding Order</a>
        <a href="complete_order.php">Complete Order</a>
      </div>
      <a href="#" class="w3-bar-item w3-button w3-padding drop-down"><i class="fa fa-bank fa-fw"></i>  Product
     <i class="fa fa-caret-down"></i>
    </a>
      <div class="drop-down-container">
        <a href="./all_product.php">Add Product</a>
      </div>
    <a href="./all_categories.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-folder"></i>  Categories</a>
    <a href="./all_sub_categories.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-folder-open"></i> Sub-categories</a>
    <a href="all_coupan.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-star"></i>  Coupan</a>
    <a href="all_blog.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pencil"></i>  Blogs</a>
    <a href="./all_slider.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sliders"></i>  Slider</a>
    <a href="./user.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Users</a>
    <a href="./contact_form.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-comments"></i>  Comment</a>
    <a href="./all_admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a>
    <a href="./admin_logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out"></i>  Log out</a><br><br>
  </div>
</nav>