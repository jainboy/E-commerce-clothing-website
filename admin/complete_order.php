<?php
include './dashboard_header.php';
include './dashboard_sidebar.php';
include './function.php';
include '../dbconnection/db.php';

 
$sql="SELECT * FROM `customer_order` WHERE `order_status`='complete' ORDER BY `added_on` DESC";
$res=mysqli_query($conn,$sql);
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./manage_product.php">Add New</a></button>
   
 <div class="content pb-0">
            <div class="orders">
            
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card"> 
                        <div class="card-body">
                           <h4 class="box-title">Complete order </h4>
                        </div>                  
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>#</th>                                   
                                       <th>Name</th>
                                       <th>Mobile</th>
                                       <th>Shipping Address</th>
                                       <th>Amount</th>
                                       <th>Order Date</th>
                                       <th>status</th>
                                    </tr>
                                 </thead>          
								<tbody>
									 <?php 							
										while($row=@mysqli_fetch_assoc($res)){
                                 $order_date=$row['added_on'];
                                 ?>       
                                 <tr>
                                       <td>  <?php  echo $row['order_id'];  ?>  </td>
                                       <td><?php   echo $row['firstname'].' '.$row['lastname'];      ?> </td>
                                       <td>  <?php   echo $row['mobile'];    ?>  </td>
                                       <td><?php   echo $row['street']."<br/>". $row['city']."<br/>".$row['zip'];   ?> </td>                                      
                                       <td>  <?php   echo $row['order_total'];    ?>  </td>
                                       <td><?php echo date_format(new DateTime($order_date),'d-m-Y');?> </td>         				   		                                          
                                       <td><span class='badge badge-complete'><a href='invoice.php?order_id=<?php echo$row['order_id'];?>'><i class='fa fa-print'></i></a></span>&nbsp;</td>
                                    </tr>
                                    <?php } ?>                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
            </div>
		  </div>
<?php 
    include('./dashboard_footer.php');
?>