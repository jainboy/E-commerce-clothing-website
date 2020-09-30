<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
   $main_cat='';
   $sub_name='';
   $sub_desc='';
   $sub_meta='';  
   $msg='';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $id=get_safe_value($conn,$_GET['id']);
      $res=mysqli_query($conn,"select * from `sub-category` where id='$id'");
      $check=mysqli_num_rows($res);
      if($check>0){
         $row=mysqli_fetch_assoc($res);
         $main_cat=$row['main_category'];
         $sub_name=$row['sub_cat_name'];
         $sub_desc=$row['sub_description'];
         $sub_meta=$row['sub_meta_desc'];   
      }
      else{
        header('location:./all_sub_categories.php');
         die();
      }
   }
   if(isset($_POST['submit'])){
      $main_cat=get_safe_value($conn,$_POST['main_cat']);
      $sub_name=get_safe_value($conn,$_POST['sub_name']);
      $sub_desc=get_safe_value($conn,$_POST['sub_desc']);
      $sub_meta=get_safe_value($conn,$_POST['sub_meta']);
   	$res=mysqli_query($conn,"select * from `sub-category` where sub_cat_name='$main_cat'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['id']){
            
   			}else{
   				$msg="sub-Categories already exist";
   			}
   		}else{
   			$msg="sub-Categories already exist";
   		}
   	} 
   	if($msg==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			mysqli_query($conn,"UPDATE `sub-category` SET `main_category`='$main_cat',`sub_cat_name`='$sub_name',`sub_description`='$sub_desc',`sub_meta_desc`='$sub_meta' WHERE `id`='$id'");
   		}else{
   			mysqli_query($conn,"INSERT INTO `sub-category`(`main_category`, `sub_cat_name`, `sub_description`,`sub_meta_desc`,`status`) VALUES ('$main_cat','$sub_name','$sub_desc','$sub_meta','1')");
         }
         header('location:all_sub_categories.php');
   		die();
   	}
   }
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_sub_categories.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Sub-categories</strong><small> Insert</small></div>
                       
                        <div class="card-body card-block">
                        <form method="post">
                           <div class="form-group">
                                <label for="exampleFormControlSelect1">Main Category</label>
                                <select class="form-control" name="main_cat">
                                     <option>Select Category</option>
                                       <?php
                                          $res=mysqli_query($conn,"select cat_id,cat_name from `product_categories` order by cat_name asc");
                                          while($row=mysqli_fetch_assoc($res)){
                                             if($row['cat_name']==$main_cat){
                                                echo "<option selected value=".$row['cat_name'].">".$row['cat_name']."</option>";
                                             }else{
                                                echo "<option value=".$row['cat_name'].">".$row['cat_name']."</option>";
                                             }
                                             
                                          }
										         ?>                            
                                </select>
                            </div>
                           <div class="form-group"><label class=" form-control-label">Sub-category name 
                           <span style="color:red; font-size:28px;">*</span>
                           </label><input type="text" name="sub_name" placeholder="Enter your Categories name" value="<?php echo $sub_name?>" class="form-control"></div>

                           <div class="form-group"><label class=" form-control-label">Sub-category Description
                           <span style="color:red; font-size:28px;">*</span>
                           </label>  <textarea class="form-control"  name="sub_desc" rows="4"><?php echo $sub_desc?></textarea>          

                           <div class="form-group"><label for="street" class=" form-control-label">Meta description
                           <span style="color:grey; font-size:14px;">(optional)</span>
                           </label>  <textarea class="form-control"  name="sub_meta" rows="4"><?php echo $sub_meta?></textarea>  

                           <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                        </div>
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