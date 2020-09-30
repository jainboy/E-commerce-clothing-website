<?php
require('./dashboard_header.php');
require('./dashboard_sidebar.php');
require('../dbconnection/db.php');
require('./function.php');

		$categories_id='';
		$sub_categories_id='';
		$name='';
		$mrp='';
		$price='';
		$qty='';
		$productimage='';
		$productimage1='';
		$productimage2='';
		$productimage3='';
		$short_desc='';
		$description='';
		$availability='';
		$shipping_charges='';
		$meta_title='';
		$meta_desc='';
		$meta_keyword='';
		
$msg='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);

		$categories_id=$row['categories_id'];
        $sub_categories_id=$row['sub_categories_id'];
        $name=$row['pro_name'];
        $mrp=$row['pro_mrp'];
        $price=$row['price'];
        $qty=$row['pro_qty'];
        $productimage=$_FILES["pro_image"]["name"];
        $productimage1=$_FILES["pro_image1"]["name"];
        $productimage2=$_FILES["pro_image2"]["name"];
        $productimage3=$_FILES["pro_image3"]["name"];
        $short_desc=$row['pro_short_desc'];
        $description=$row['pro_description'];
        $availability=$row['pro_avail'];
        $shipping_charges=$row['pro_shipping'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];

	}else{
		header('location:all_product.php');
		die();
	}
}

if(isset($_POST['submit'])){

	$categories_id=get_safe_value($conn,$_POST['categories_id']);
	$sub_categories_id=get_safe_value($conn,$_POST['sub_categories_id']);
	$name=get_safe_value($conn,$_POST['pro_name']);
	$mrp=get_safe_value($conn,$_POST['pro_mrp']);
	$price=get_safe_value($conn,$_POST['price']);
	$qty=get_safe_value($conn,$_POST['pro_qty']);
	$short_desc=get_safe_value($conn,$_POST['pro_short_desc']);
	$description=get_safe_value($conn,$_POST['pro_description']);
	$availability=get_safe_value($conn,$_POST['pro_avail']);
	$shipping_charges=get_safe_value($conn,$_POST['pro_shipping']);
	$meta_title=get_safe_value($conn,$_POST['meta_title']);
	$meta_desc=get_safe_value($conn,$_POST['meta_desc']);
	$meta_keyword=get_safe_value($conn,$_POST['meta_keyword']);

	$res=mysqli_query($conn,"select * from product where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
		$msg="Please select only png,jpg and jpeg image formate";
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			mysqli_query($con,"insert into product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");
		}
		header('location:product.php');
		die();
	}
}

?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<!--new code copy-->
<button type="button"  class="new_button"> <a href="./add_product.php">Add New</a></button>
   
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($con,"select id,categories from categories order by categories asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Title</label>
									<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Description</label>
									<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Keyword</label>
									<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword?></textarea>
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
   
<?php
require('./dashboard_footer.php');
?>