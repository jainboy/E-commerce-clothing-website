<?php
 include('../dashboard_header.php');
 include('../dashboard_sidebar.php');
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
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data" action="product.php">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select</option>
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
								<div class="form-group">
									<label for="categories" class=" form-control-label">Sub-categories</label>
									<select class="form-control" name="sub_categories_id">
										<option>Select</option>
										<?php
                                        include('../dbconnection/db.php');
                                        $query=mysqli_query($conn,"SELECT * FROM `sub-category`");
                                        while($row=mysqli_fetch_array($query)){
                                    ?>                               
                                        <option value="<?php echo $row['sub_cat_name']; ?>">
                                            <?php
                                            echo $row['sub_cat_name'];
                                            ?>
                                        </option> 
                                    <?php    } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="pro_name" placeholder="Enter product name" class="form-control" required>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="text" name="pro_mrp" placeholder="Enter product mrp" class="form-control" required>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="text" name="price" placeholder="Enter product price" class="form-control" required>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="text" name="pro_qty" placeholder="Enter qty" class="form-control" required>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Main-image</label>
									<input type="file" name="pro_image" class="form-control" >
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image 1</label>
									<input type="file" name="pro_image1" class="form-control" >
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image 2</label>
									<input type="file" name="pro_image2" class="form-control" >
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image 3</label>
									<input type="file" name="pro_image3" class="form-control" >
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="pro_short_desc" placeholder="Enter product short description" class="form-control" required></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="pro_description" id="textarea" placeholder="Enter product description" class="form-control"  rows="5" required></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Availability</label>
									<select class="form-control" name="pro_avail">
										<option>Select</option>
										<option value="In Stock">In Stock</option>
										<option value="Out Of Stock">Out Of Stock</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Shipping Charges</label>
									<select class="form-control" name="pro_shipping">
										<option>Select</option>
										<option value=Free">Free</option>
										<option value="29">29/-</option>
										<option value="45">45/-</option>
										<option value="59">59/-</option>
									</select>
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Title</label>
									<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Description</label>
									<textarea name="meta_desc" placeholder="Enter product meta description"  rows="5" class="form-control"></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Keyword</label>
									<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"></textarea>
								</div>
								
								
							   <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span >Submit</span>
							   </button>
							   <div class="field_error"></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

  <?php

// 	if(isset($_POST['submit']))
// 	{
// 		include('../dbconnection/db.php');
// 		$categories_id=$_POST['categories_id'];
// 		$sub_categories_id=$_POST['sub_categories_id'];
// 		$name=$_POST['pro_name'];
// 		$mrp=$_POST['pro_mrp'];
// 		$price=$_POST['price'];
// 		$qty=$_POST['pro_qty'];
// 		$productimage=$_FILES["pro_image"]["name"];
// 		$productimage1=$_FILES["pro_image1"]["name"];
// 		$productimage2=$_FILES["pro_image2"]["name"];
// 		$productimage3=$_FILES["pro_image3"]["name"];
// 		$short_desc=$_POST['pro_short_desc'];
// 		$description=$_POST['pro_description'];
// 		$availability=$_POST['pro_avail'];
// 		$shipping_charges=$_POST['pro_shipping'];
// 		$meta_title=$_POST['meta_title'];
// 		$meta_desc=$_POST['meta_desc'];
// 		$meta_keyword=$_POST['meta_keyword'];
			
// 		$query=mysqli_query($conn,"select max(id) as product_id from product");
// 			$result=mysqli_fetch_array($query);
// 			$productid=$result['product_id']+1;
// 			$dir="./product_images/$productid";
// 		if(!is_dir($dir)){
// 				mkdir("./product_images/".$productid);
// 			}

// 			move_uploaded_file($_FILES["pro_image"]["tmp_name"],"./product_images/$productid/".$_FILES["pro_image"]["name"]);
// 			move_uploaded_file($_FILES["pro_image1"]["tmp_name"],"./product_images/$productid/".$_FILES["pro_image1"]["name"]);
// 			move_uploaded_file($_FILES["pro_image2"]["tmp_name"],"./product_images/$productid/".$_FILES["pro_image2"]["name"]);
// 			move_uploaded_file($_FILES["pro_image3"]["tmp_name"],"./product_images/$productid/".$_FILES["pro_image3"]["name"]);
// 		$sql=mysqli_query($conn,"INSERT INTO `Product`(`pro_cat`, `pro_sub_cat`, `pro_name`, `pro_mrp`, `pro_sell_price`, `pro_qty`, `pro_image`, `pro_img1`, `pro_img2`, `pro_img3`, `pro_short`, `pro_des`, `pro_status`, `pro_shipping`, `pro_meta_title`, `pro_meta_desc`, `pro_meta_keyword`) VALUES ('$categories_id','$sub_categories_id','$name','$mrp','$price','$qty','$productimage','$productimage1','$productimage2','$productimage3','$short_desc','$description','$availability''$shipping_charges','$meta_title','$meta_desc','$meta_keyword')");
// 		// $_SESSION['msg']="Product Inserted Successfully !!";
// 		if($sql==true)
//   {
//     ?>
//       <script>
//         alert('post insert successfully');
//       </script>
//       <?php
//   }
//   else
//   {
//     ?>
//       <script>
//         alert('POST UNSUCCESSFUL');
//       </script>
//       <?php
//   }

	// }
?>

         
<?php 
    include('../dashboard_footer.php');
?>