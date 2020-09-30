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
              <li aria-current="page" class="breadcrumb-item active">Change Password</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-3">
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
              <a href="customer_orders.php" class="nav-link"><i class="fa fa-list"></i> My orders</a>
              <a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
              <a href="account.php" class="nav-link"><i class="fa fa-user"></i> My account</a>
              <a href="change_password.php" class="nav-link  active"><i class="fa fa-eye"></i> Change Password</a>
              <a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></ul>
            </div>
          </div>
          <!-- /.col-lg-3-->
          <!-- *** CUSTOMER MENU END ***-->
        </div> 
            <div class="col-lg-9">
              <div class="box">
                <h1>My account</h1>
                <p class="lead">Change your personal details or your password here.</p> 
                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <h3>Change password</h3>
                <form method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_old">Old password</label>
                        <input id="password_old" name="oldpassword" type="password" class="form-control" required>
                        <b>Note:</b> <span style="color:#3b5888;">1.Password have minimum <b>8 charecter</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Password should contain <b>'1-9'</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Password have <b>'a-z' , 'A-Z'</b> <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.and <b>one special symbol</b><span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_1">New password</label>
                        <input id="password_1" name="newpassword" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_2">Retype new password</label>
                        <input id="password_2" name="repassword" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="col-md-12 text-center">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                    <div class="field_error"><?php echo $msg3?></div>  
                  </div>
                </form>
             
              </div>
              </div> 
             </div>
          </div>
        </div>
      </div>
    </div>
 
<?php  include "./footer.php"; ?>        