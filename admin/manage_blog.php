<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
   $title='';
   $content='';
   $author='';
   $date='';
   $image='';
   $msg='';
   $image_required='required';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $image_required='';
      $id=get_safe_value($conn,$_GET['id']);
      $res=mysqli_query($conn,"select * from blog where blog_id='$id'");
      $check=mysqli_num_rows($res);
      if($check>0){
         $row=mysqli_fetch_assoc($res);
         $title=$row['title'];
         $content=$row['article']; 
         $author=$row['author'];
         $date=$row['article_date']; 
         $image=$row['image'];
      }
      else{
        header('location:./all_blog.php');
         die();
      }
   }

   if(isset($_POST['submit'])){
      $title=get_safe_value($conn,$_POST['title']);
      $content=get_safe_value($conn,$_POST['content']);
      $author=get_safe_value($conn,$_POST['author']);
      $date=get_safe_value($conn,$_POST['date']);
   	$res=mysqli_query($conn,"select * from blog where title='$title'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['blog_id']){
            
   			}else{
   				$msg="blog already exist";
   			}
   		}else{
   			$msg="blog already exist";
   		}
      } 
      // if(@$_FILES['image']['type']!='image/png' && @$_FILES['image']['type']!='image/jpg' && @$_FILES['image']['type']!='image/jpeg'){
      //    $msg="Please select only png,jpg and jpeg image format";
      // }     
   	if($msg==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/blog_images/'.$image);
   			mysqli_query($conn,"UPDATE `blog` SET `title`='$title',`article`='$content',`author`='$author',`article_date`='$date',`image`='$image' WHERE `blog_id`='$id'");
         }
         else{
   			mysqli_query($conn,"UPDATE `blog` SET `title`='$title',`article`='$content',`author`='$author',`article_date`='$date' WHERE `blog_id`='$id'");
         }
      }else{
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/blog_images/'.$image);
   			mysqli_query($conn,"INSERT INTO `blog`(`title`, `article`, `author`, `article_date`, `image`,`status`) VALUES ('$title','$content','$author','$date','$image','1')");
         }
         header('location:all_blog.php');
   		die();
   	}
   }
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_blog.php">Back</a></button>
   <div class="content pb-0">
      <div class="animated fadeIn">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header"><strong>Article</strong><small> Insert</small></div>
                     <div class="card-body card-block">
                        <form method="post" enctype="multipart/form-data">
                           <div class="form-group"><label class=" form-control-label">Title 
                              <span style="color:red; font-size:28px;">*</span>
                              </label><input type="text" name="title" placeholder="Enter your Title" class="form-control" value="<?php echo $title?>">
                           </div>
                           <div class="form-group"><label class=" form-control-label">Content
                              <span style="color:red; font-size:28px;">*</span>
                              </label>  <textarea class="form-control" id="textarea" name="content" rows="20"><?php echo $content?></textarea>
                           </div>      
                           <div class="form-group">
                              <label>Author</label>
                              <span style="color:red; font-size:28px;">*</span>
                                 <select class="form-control" name="author">
                                    <option>Select Author</option>
                                       <?php
                                          $res=mysqli_query($conn,"select CONCAT(first_name , ' ' , last_name ) as full_name from admin order by full_name asc");
                                          while($row=mysqli_fetch_assoc($res)){
                                             if($row['full_name']==$author){
                                                echo "<option selected value=".$row['full_name'].">".$row['full_name']."</option>";
                                             }else{
                                                echo "<option value=".$row['full_name'].">".$row['full_name']."</option>";
                                             }
                                             
                                          }
										         ?>                            
                                </select>
                            </div>

                           <div class="form-group">
                              <label for="street" class=" form-control-label">Article Date
                              <span style="color:grey; font-size:14px;">(optional)</span></label> 
                              <input type="date" class="form-control" name="date" >
                           </div>  
                           <div class="form-group"><label  class=" form-control-label">Image
                              <span style="color:red; font-size:28px;">*</span></label>  
                              <input type="file" class="form-control-file" id="image" name="image"  <?php echo  $image_required?> onchange="loadfile(event)" >
                           </div>
                              <span style="color:#3b5998; font-size:14px;">Note:image size will be 1680*700</span><br>
                              <img src="./slider_images/blog_images/<?php echo $image?>" class="img-thumbnail" id="preimage">

                              <!-- //* image preview js / -->
                                 <script type="text/javascript">
                                       function loadfile(event){
                                       var output=document.getElementById('preimage');
                                       output.src=URL.createObjectURL(event.target.files[0]);
                                       };
                                 </script>
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
</div>
       
<?php 
    include('./dashboard_footer.php');
?>