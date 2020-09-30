<?php
 include('./dashboard_header.php');
 include('./dashboard_sidebar.php');
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_sub_category.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Sub-categories</strong><small> Insert</small></div>
                       
                        <div class="card-body card-block">
                        <form method="post" action="add_sub-category.php">
                           <div class="form-group">
                                <label for="exampleFormControlSelect1">Main Category</label>
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
                           </label><input type="text" name="sub_name" placeholder="Enter your Categories name" class="form-control"></div>

                           <div class="form-group"><label class=" form-control-label">Sub-category Description
                           <span style="color:red; font-size:28px;">*</span>
                           </label>  <textarea class="form-control"  name="sub_desc" rows="4"></textarea>          

                           <div class="form-group"><label for="street" class=" form-control-label">Meta description
                           <span style="color:grey; font-size:14px;">(optional)</span>
                           </label>  <textarea class="form-control"  name="sub_meta" rows="4"></textarea>  

                           <button name="apply" type="submit" class="btn btn-lg btn-info btn-block">
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

if(isset($_POST['apply']))
{
    include('../dbconnection/db.php');

    $main_cat= $_POST['main_cat'];
    $sub_name= $_POST['sub_name'];
    $sub_description= $_POST['sub_desc'];
    $sub_meta_desc= $_POST['sub_meta'];
    
    $query="INSERT INTO `sub-category`(`main_category`, `sub_cat_name`, `sub_description`, `sub_meta_desc`) VALUES ('$main_cat','$sub_name','$sub_description','$sub_meta_desc')";
    $run=mysqli_query($conn,$query);
    
    if($run==true)
    {
      ?>
        <script>
          alert('sub-category insert successfully');
        </script>
        <?php
    }
    else
    {
      ?>
        <script>
          alert('sub-category not inserted !try again');
        </script>
        <?php
    }
    }
?>
         
<?php 
    include('./dashboard_footer.php');
?>