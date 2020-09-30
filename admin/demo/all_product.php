<?php
include('./dashboard_header.php');
include('./dashboard_sidebar.php');
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<!--new code copy-->
<button type="button"  class="new_button"> <a href="./product.php">Add New</a></button>
   
   <div class="content pb-0">
              <div class="orders">
                 <div class="row">
                    <div class="col-xl-12">
                       <div class="card"> 
                          <div class="card-body">
                             <h4 class="box-title">Orders </h4>
                          </div>                  
                          <div class="card-body--">
                             <div class="table-stats order-table ov-h">
                                <table class="table ">
                                   <thead>
                                      <tr>
                                         <th class="serial">#</th>                                   
                                         <th>Name</th>
                                         <th>Description</th>
                                         <th>Quantity</th>
                                         <th>Action</th>
                                         <th>Action</th>
                                         <th>Status</th>
                                      </tr>
                                   </thead>
                                   <?php
                              include '../dbconnection/db.php';
                              $query=mysqli_query($conn,"SELECT * FROM `product_categories`");
                              while($row=mysqli_fetch_array($query)){
                              ?>
                                   <tbody>
                                   <tr>
                                         <td>  <?php   echo $row['cat_id'];    ?>  </td>
                                         <td> <span class="name"> <?php   echo $row['cat_name'];    ?> </span> </td>
                                         <td> <span class="product"> <?php   echo $row['cat_description'];    ?> </span> </td>
                                         <td><span class="count"> <?php   echo $row['cat_description'];    ?> </span></td>
                                         <td>
                                            <span class="badge badge-complete"><a href="edit_categories.php?edit=<?php echo $row['cat_id']; ?>">Update</a></span>
                                         </td>
                                         <td>
                                            <span class="badge badge-pending"><a href="delete_category.php?delete=<?php echo $row['cat_id']; ?>">Delete</a></span>
                                         </td>
                                         <td>
                                         <i class="fa fa-eye fa-fw"></i>
                                         </td>
                                      </tr>
                                      <?php } ?>                                   
                                   </tbody>
                                </table>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </div>
    

<?php
require('dashboard_footer.php');
?>