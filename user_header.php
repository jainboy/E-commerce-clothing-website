<?php
  include "./topbar.php";
  include './dbconnection/db.php';
  error_reporting (E_ALL ^ E_NOTICE); 
      if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
          window.location.href='ragistration.php';
        </script>
        <?php
      }
$user_id=$_SESSION['USER_ID'];  //change password module 
$msg3='';
if(isset($_POST['submit'])){
  $oldpassword=get_safe_value($conn,$_POST['oldpassword']);
  $newpassword=get_safe_value($conn,$_POST['newpassword']);
  $repassword=get_safe_value($conn,$_POST['repassword']);
  $res=mysqli_query($conn,"SELECT * FROM `users` WHERE `id`='$user_id' AND `password`='$oldpassword'");
  $check=mysqli_num_rows($res);
  if($check>0){
      if($newpassword==$repassword){
        mysqli_query($conn,"UPDATE `users` SET `password`='$newpassword' WHERE `id`='$user_id'");
      }
    else{
      $msg3="new password and re-type password not matched !!! ";
      }
  }else{
      $msg3="password Invalid";  
  }
}    //change password module end

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
$image='';
if(isset($_SESSION['USER_LOGIN'])){
$image_required='';
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
$image=$row['image'];
}
}

if(isset($_POST['submit1'])){
$firstname=get_safe_value($conn,$_POST['firstname']);
$lastname=get_safe_value($conn,$_POST['lastname']);
$phone=get_safe_value($conn,$_POST['phone']);
$email=get_safe_value($conn,$_POST['email']);
$street=get_safe_value($conn,$_POST['street']);
$city=get_safe_value($conn,$_POST['city']);
$dist=get_safe_value($conn,$_POST['dist']);
$zip=get_safe_value($conn,$_POST['zip']);
$state=get_safe_value($conn,$_POST['state']);
$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],'./img/userimage/'.$image);
$user_id=$_SESSION['USER_ID'];
mysqli_query($conn,"UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`mobile`='$phone',`street`='$street',`city`='$city',`dist`='$dist',`state`='$state',`zipcode`='$zip',`image`='$image',`remark`='$notes' WHERE `id`='$user_id'");
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
              <li aria-current="page" class="breadcrumb-item active">My account</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="card sidebar-menu">
            <div class="card-header">
              <h3 class="h4 card-title">Customer section</h3>              
            </div>
            <div class="card-body">
              <ul class="nav nav-pills flex-column">
              <a href="wishlist.php" class="nav-link"><img src="./img/userimage/<?php echo $image ?>" class="img-thumbnail"></a>  
              <a href="customer_orders.php" class="nav-link"><i class="fa fa-list"></i> My orders</a>
              <a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
              <a href="account.php" class="nav-link active"><i class="fa fa-user"></i> My account</a>
              <a href="account.php" class="nav-link "><i class="fa fa-user"></i> Change Password</a>
              <a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></ul>
            </div>
          </div>
          <!-- /.col-lg-3-->
          <!-- *** CUSTOMER MENU END ***-->
        </div> 