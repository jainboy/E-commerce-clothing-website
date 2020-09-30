<?php
 include './dashboard_header.php';
 include './dashboard_sidebar.php';
 include './function.php';
 include '../dbconnection/db.php';

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from contact_us where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
}

$sql="select * from contact_us order by id desc";
$res=mysqli_query($conn,$sql);
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Contact Us </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>First Name</th>
							   <th>Last Name</th>
							   <th>Email</th>
							   <th>Mobile</th>
							   <th>Query</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>	
							<tr>
							   <td class="serial"><?php echo $i++;?></td>
							   <td><?php echo $row['firstname']?></td>
							   <td><?php echo $row['lastname']?></td>
							   <td><?php echo $row['email']?></td>
							   <td><?php echo $row['mobile']?></td>
							   <td><?php echo $row['comment']?></td>
							   <td><?php echo $row['added_on']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'><i class='fa fa-trash-o'></i></a></span>";
								?>
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
 include"./dashboard_footer.php";
 ?>