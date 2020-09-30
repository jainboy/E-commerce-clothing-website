<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
   $categories='';
   $description='';
   $meta_desc='';
   $msg='';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $id=get_safe_value($conn,$_GET['id']);
      $res=mysqli_query($conn,"select * from product_categories where cat_id='$id'");
      $check=mysqli_num_rows($res);
      if($check>0){
         $row=mysqli_fetch_assoc($res);
         $categories=$row['cat_name'];
         $description=$row['cat_description'];
         $meta_desc=$row['meta_description'];   
      }
      else{
        header('location:./all_categories.php');
         die();
      }
   }
   if(isset($_POST['submit'])){
      $categories=get_safe_value($conn,$_POST['cat_name']);
      $description=get_safe_value($conn,$_POST['cat_desc']);
      $meta_desc=get_safe_value($conn,$_POST['cat_meta']);
   	$res=mysqli_query($conn,"select * from product_categories where cat_name='$categories'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['cat_id']){
            
   			}else{
   				$msg="Categories already exist";
   			}
   		}else{
   			$msg="Categories already exist";
   		}
   	} 
   	if($msg==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			mysqli_query($conn,"UPDATE `product_categories` SET `cat_name`='$categories',`cat_description`='$description',`meta_description`='$meta_desc' WHERE `cat_id`='$id'");
   		}else{
   			mysqli_query($conn,"INSERT INTO `Product_categories`(`cat_name`, `cat_description`, `meta_description`,`status`) VALUES ('$categories','$description','$meta_desc','1')");
         }
         header('location:all_categories.php');
   		die();
   	}
   }
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_categories.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Insert</small></div>
                          <div class="card-body card-block">
                              <form method="post" >
                                 <div class="form-group"><label class=" form-control-label">Category name 
                                 <span style="color:red; font-size:28px;">*</span>
                                 </label><input type="text" name="cat_name" placeholder="Enter your Categories name" class="form-control" value="<?php echo $categories?>"></div>

                                 <div class="form-group"><label class=" form-control-label">Category Description
                                 <span style="color:red; font-size:28px;">*</span>
                                 </label>  <textarea class="form-control"  name="cat_desc" rows="4"><?php echo $description?></textarea>    </div>      

                                 <div class="form-group"><label for="street" class=" form-control-label">Meta description
                                 <span style="color:grey; font-size:14px;">(optional)</span>
                                 </label>  <textarea class="form-control"  name="cat_meta" rows="4"><?php echo $meta_desc?></textarea>  <div>

                                 <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                 <span id="payment-button-amount">Submit</span>
                                 </button>
                                 <div class="field_error"><?php echo $msg?></div>
                           </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>  
  </div>
  
 
         
<?php 
    include('./dashboard_footer.php');
?>