<?php
 include './dashboard_header.php';
include './dashboard_sidebar.php';
?>
                       
    <?php
        include '../dbconnection/db.php';
                  $id=@$_GET['edit'];
                  $query=mysqli_query($conn,"SELECT * FROM `sub-category` WHERE `id`='$id'");
        while($row=mysqli_fetch_array($query)){
            $main_cat= $row['main_category'];
            $sub_name= $row['sub_cat_name'];
            $sub_description= $row['sub_description'];
            $sub_meta_desc= $row['sub_meta_desc'];
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button" class="btn btn-info"> <a href="all_sub_category.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Sub-categories</strong><small> Update</small></div>
                        <div class="card-body card-block">
                        <form method="post" action="edit_sub_cat.php">

                        <div class="form-group"><label class=" form-control-label">Main category name 
                           </label><input type="text"  value="<?php echo $main_cat; ?>" class="form-control"></div>

                           <div class="form-group">
                                <label for="exampleFormControlSelect1">Main Category</label>                           
                                <span style="color:red; font-size:28px;">*</span>
                                <select class="form-control" name="main_cat">
                                  
                                    <?php
                                        include('../dbconnection/db.php');
                                        $query=mysqli_query($conn,"SELECT * FROM `product_categories`");
                                        while($row=mysqli_fetch_array($query)){
                                    ?>                               
                                        <option value="<?php echo $row['cat_name']; ?>">
                                            <?php
                                            echo $row['cat_name'];
                                            ?>
                                        </option> 
                                    <?php    } ?>

                                </select>
                            </div>
                           <div class="form-group"><label class=" form-control-label">Sub-category name 
                           <span style="color:red; font-size:28px;">*</span>
                           </label><input type="text" name="sub_name" placeholder="Enter your Categories name" value="<?php echo $sub_name; ?>" class="form-control"></div>

                           <div class="form-group"><label class=" form-control-label">Sub-category Description
                           <span style="color:red; font-size:28px;">*</span> </label>  <textarea class="form-control"  name="sub_desc" rows="4">
<?php echo $sub_description; ?>
                           </textarea>          

                           <div class="form-group"><label for="street" class=" form-control-label">Meta description
                           <span style="color:grey; font-size:14px;">(optional)</span>     </label>  <textarea class="form-control"  name="sub_meta" value="<?php echo $sub_meta_desc; ?>" rows="4">
                                <?php echo $sub_meta_desc; ?>
                           </textarea>  
                           <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
                           <button name="supdate" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Update</span>
                           </button>
                        </div>
                        </form>
                     </div>
                  </div>
                  <?php } ?>  
               </div>
            </div>
         </div>
  </div>
  
  <?php

if(isset($_POST['supdate']))
{
    include('../dbconnection/db.php');
    $id=$_POST['id'];
    $main_cat= $_POST['main_cat'];
    $sub_name= $_POST['sub_name'];
    $sub_description= $_POST['sub_desc'];
    $sub_meta_desc= $_POST['sub_meta'];
    
    $query="UPDATE `sub-category` SET `main_category`='$main_cat',`sub_cat_name`='$sub_name',`sub_description`='$sub_description',`sub_meta_desc`='$sub_meta_desc' WHERE `id`='$id'";
    $run=mysqli_query($conn,$query);
    
    if($run==true)
    {
      ?>
        <script>
          alert('sub-category update successfully');
        </script>
        <?php
    }
    else
    {
      ?>
        <script>
          alert('sub-category not update !try again');
          window.open('location:./all_sub_category.php');
        </script>
        <?php
    }
    }
?>
         
<?php 
    include('./dashboard_footer.php');
?>