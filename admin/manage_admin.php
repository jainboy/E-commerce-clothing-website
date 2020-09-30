<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
         $first_name='';
         $last_name='';
         $username='';
         $email='';
         $mobile='';
         $city='';
         $state='';
         $zipcode='';
         $bank_name='';
         $bank_address='';
         $holder_name='';
         $account_no='';
         $ifsc='';
         $password='';
         $msg='';
         $msg2='';
         $msg3='';
         $image_required='required';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $image_required='';
      $id=get_safe_value($conn,$_GET['id']);
      $res=mysqli_query($conn,"select * from admin where id='$id'");
      $check=mysqli_num_rows($res);
      if($check>0){
         $row=mysqli_fetch_assoc($res);
         $first_name=$row['first_name'];
         $last_name=$row['last_name'];
         $username=$row['username'];
         $email=$row['email'];
         $mobile=$row['mobile'];
         $image=$row['image'];
         $city=$row['city'];
         $state=$row['state'];
         $zipcode=$row['zipcode'];
         $bank_name=$row['bank_name'];
         $bank_address=$row['bank_address'];
         $holder_name=$row['holder_name'];
         $account_no=$row['account_no'];
         $ifsc=$row['ifsc'];
         $password=$row['password'];
      }
      else{
        header('location:./all_admin.php');
         die();
      }
   }

   if(isset($_POST['submit1'])){
      $first_name=get_safe_value($conn,$_POST['first_name']);
      $last_name=get_safe_value($conn,$_POST['last_name']);
      $username=get_safe_value($conn,$_POST['username']);
      $email=get_safe_value($conn,$_POST['email']);
      $mobile=get_safe_value($conn,$_POST['mobile']);
      $password=get_safe_value($conn,$_POST['password']);
      $city=get_safe_value($conn,$_POST['city']);
      $state=get_safe_value($conn,$_POST['state']);
      $zipcode=get_safe_value($conn,$_POST['zipcode']);

   	$res=mysqli_query($conn,"select * from admin where first_name='$first_name'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['id']){
            
   			}else{
   				$msg="admin already exist";
   			}
   		}else{
   			$msg="admin already exist";
   		}
      } 
      // if(@$_FILES['image']['type']!='image/png' && @$_FILES['image']['type']!='image/jpg' && @$_FILES['image']['type']!='image/jpeg'){
      //    $msg="Please select only png,jpg and jpeg image format";
      // }     
   	if($msg==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/admin_images/'.$image);
   			mysqli_query($conn,"UPDATE `admin` SET `first_name`='$first_name',`last_name`='$last_name',`username`='$username',`email`='$email',`mobile`='$mobile',`password`='$password',`image`='$image',`city`='$city',`state`='$state',`zipcode`='$zipcode' WHERE `id`='$id'");
         }
         else{
   			mysqli_query($conn,"UPDATE `admin` SET `first_name`='$first_name',`last_name`='$last_name',`username`='$username',`email`='$email',`mobile`='$mobile',`password`='$password',`city`='$city',`state`='$state',`zipcode`='$zipcode' WHERE `id`='$id'");
         }
      }else{
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/admin_images/'.$image);
   			mysqli_query($conn,"INSERT INTO `admin`( `first_name`, `last_name`, `username`, `email`, `mobile`,`password`, `image`, `city`, `state`, `zipcode`,  `status`) VALUES ('$first_name','$last_name','$username','$email','$mobile','$password','$image','$city','$state','$zipcode','1')");
         }
         header('location:all_admin.php');
   		die();
   	}
   }

   if(isset($_POST['submit2'])){
      $bank_name=get_safe_value($conn,$_POST['bank_name']);
      $bank_address=get_safe_value($conn,$_POST['bank_address']);
      $holder_name=get_safe_value($conn,$_POST['holder_name']);
      $account_no=get_safe_value($conn,$_POST['account_no']);
      $ifsc=get_safe_value($conn,$_POST['ifsc']);
   	$res=mysqli_query($conn,"select * from admin where first_name='$first_name'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['id']){
            
   			}else{
   				$msg2="account details already exist";
   			}
   		}else{
   			$msg2="account details already exist";
   		}
   	} 
   	if($msg2==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			mysqli_query($conn,"UPDATE `admin` SET `bank_name`='$bank_name',`bank_address`='$bank_address',`holder_name`='$holder_name',`account_no`='$account_no',`ifsc`='$ifsc' WHERE `id`='$id'");
   		}else{
   			mysqli_query($conn,"INSERT INTO `admin`(`bank_name`, `bank_address`, `holder_name`, `account_no`, `ifsc`) VALUES ('$bank_name','$bank_address','$holder_name','$account_no','$ifsc')");
         }
         header('location:all_admin.php');
   		die();
   	}
   }

   if(isset($_POST['submit3'])){
      $oldpassword=get_safe_value($conn,$_POST['oldpassword']);
      $newpassword=get_safe_value($conn,$_POST['newpassword']);
      $repassword=get_safe_value($conn,$_POST['repassword']);
   	$res=mysqli_query($conn,"SELECT * FROM `admin` WHERE `password`='$oldpassword'");
      $check=mysqli_num_rows($res);
   	if($check>0){
         if($newpassword==$repassword){
            mysqli_query($conn,"update admin SET password='$newpassword'");
         }
   		else{
   			$msg3="new password and re-type password not matched !!! ";
         }
      }else{
         $msg3="password Invalid";  
   	}
   }


?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_admin.php">Back</a></button>
         <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">

                     <div class="card">
                        <div class="card-header"><strong>General</strong><small> Details</small></div>
                           <div class="card-body card-block">
                              <form method="post" enctype="multipart/form-data">   
                                 <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                       <label>First name</label>
                                       <input type="text" name="first_name" class="form-control" value="<?php echo $first_name?>" placeholder="First name"  required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label>Last name</label>
                                       <input type="text" name="last_name" class="form-control"  value="<?php echo $last_name?>" placeholder="Last name"  required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label>Username</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                             <span class="input-group-text">@</span>
                                             </div>
                                             <input type="text" name="username" class="form-control"  value="<?php echo $username?>" placeholder="Username" required>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-6">
                                       <label>Email</label>
                                       <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email?>" placeholder="e-mail@xyz.com">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Mobile</label>
                                       <input type="text" name="mobile" class="form-control" pattern=".{10,12}" value="<?php echo $mobile?>"placeholder="Mobile">
                                    </div>
                                 </div>   
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label>Password</label>
                                       <input type="password" class="form-control" name="password" value="<?php echo $password?>" placeholder="Enter The Password">
                                    </div>
                                 </div>              
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label>Image</label>
                                       <span style="color:red; font-size:28px;">*</span>
                                       <input type="file" class="form-control-file" id="image" name="image"  <?php echo  $image_required?> onchange="loadfile(event)" ><div>
                                       <span style="color:#3b5998; font-size:14px;">Note:image size will be minimum 300*300</span><br>
                                       <img src="./slider_images/admin_images/<?php echo $image?>"  class="img-thumbnail" id="preimage" >           
                                    <div class="col-md-3 mb-3">
                                         <!-- //* image preview js / -->
                                       <script type="text/javascript">
                                          function loadfile(event){
                                          var output=document.getElementById('preimage');
                                          output.src=URL.createObjectURL(event.target.files[0]);
                                          };
                                       </script>
                                    </div>
                                 </div>                            
                                 <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                       <label>City</label>
                                       <input type="text" name="city" class="form-control" value="<?php echo $city?>" placeholder="City" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label>State</label>
                                       <input type="text" name="state" class="form-control" value="<?php echo $state?>" placeholder="State" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label>Zip</label>
                                       <input type="text" name="zipcode" class="form-control" value="<?php echo $zipcode?>" placeholder="Zip" required>
                                    </div>
                                 </div>                               
                                 <button class="btn btn-primary" name="submit1" type="submit">Submit</button> 
                                 <div class="field_error"><?php echo $msg?></div>                           
                              </form> 
                           </div>
                        </div>
                     </div>
                    
                     <div class="card">
                        <div class="card-header"><strong>Acoount</strong><small> Details</small></div>
                            <div class="card-body card-block">
                                <form method="post">   
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name" value="<?php echo $bank_name?>" placeholder="Bank Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Bank Address</label>
                                                <input type="text" class="form-control" name="bank_address" value="<?php echo $bank_address?>" placeholder="Address">
                                            </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Account Holder</label>
                                            <input type="text" class="form-control" name="holder_name" value="<?php echo $holder_name?>" placeholder="Name ">
                                          </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="form-group col-md-6">
                                          <label>Account No</label>
                                          <input type="password" class="form-control" pattern=".{12,}" value="<?php echo $account_no?>" placeholder="Account No">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Confirm</label>
                                          <input type="text" class="form-control" name="account_no" pattern=".{12,}" value="<?php echo $account_no?>" placeholder="Account No">
                                       </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>IFSC Code</label>
                                            <input type="password" class="form-control" pattern=".{12,}" value="<?php echo $ifsc?>" placeholder="IFSC">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Confirm</label>
                                            <input type="text" class="form-control" name="ifsc" pattern=".{12,}" value="<?php echo $ifsc?>" placeholder="IFSC">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" name="submit2" type="submit">Submit</button> 
                                    <div class="field_error"><?php echo $msg2?></div>                             
                                </form>
                            </div>
                        </div>
                     </div>
                     
                     <div class="card">
                        <div class="card-header"><strong>Password</strong><small> Change</small></div>
                           <div class="card-body card-block">
                              <form method="post">   
                                 <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                       <label>Old Password</label>
                                       <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label>New Password</label>
                                       <input type="password" class="form-control" name="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="New Password" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label>Re-Type</label>
                                       <input type="text" class="form-control"name="repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="form-check">
                                       <label style="color:#3b5998; size:10px; font-family:arial;">
                                       <b>Note:</b> Password have 1-9,a-z,A-Z,and one special symbol
                                       </label>
                                    </div>
                                 </div>
                                 <button class="btn btn-primary" name="submit3" type="submit">Submit</button>     
                                 <div class="field_error"><?php echo $msg3?></div>                         
                              </form>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>  
         </div>
        
<?php 
    include('./dashboard_footer.php');
?>