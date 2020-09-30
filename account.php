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
$user_id=$_SESSION['USER_ID'];
  if($_FILES['image']['name']!=''){
    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],'./img/userimage/'.$image);
    mysqli_query($conn,"UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`mobile`='$phone',`street`='$street',`city`='$city',`dist`='$dist',`state`='$state',`zipcode`='$zip',`image`='$image',`remark`='$notes' WHERE `id`='$user_id'");
}
else{
  mysqli_query($conn,"UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`mobile`='$phone',`street`='$street',`city`='$city',`dist`='$dist',`state`='$state',`zipcode`='$zip',`remark`='$notes' WHERE `id`='$user_id'");
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
                    <?php if($image=='image'){?>
                      <img src="./img/userimage/<?php echo $image ?>" class="img-thumbnail"> 
                    <?php } else{ ?>
                    <img src="./img/admin.png" class="img-thumbnail">
                    <?php } ?>
                    <a href="customer_orders.php" class="nav-link"><i class="fa fa-list"></i> My orders</a>
                    <a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
                    <a href="account.php" class="nav-link active"><i class="fa fa-user"></i> My account</a>
                    <a href="change_password.php" class="nav-link "><i class="fa fa-eye"></i> Change Password</a>
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
                <h3 class="mt-5">Personal details</h3>
                <form method="post" enctype="multipart/form-data">
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
                        <input  name="city" type="text" value="<?php echo $city ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="company"class="required">Disst</label>
                        <input  name="dist" type="text" value="<?php echo $dist ?>" class="form-control" required>
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
                        <label class="required">Image</label><br/>
                        <input type="file" name="image" class="custom-file-input1">
                      </div>
                    </div>   
                  </div>       
                  <div class="col-md-12 text-center">
                    <button type="submit" name="submit1" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
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