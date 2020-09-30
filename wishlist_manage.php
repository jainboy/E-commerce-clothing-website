<?php
include "./add_to_cart.php";
include './dbconnection/db.php';
include "./functions.php";

$pid=get_safe_value($conn,$_POST['pid']);
$type=get_safe_value($conn,$_POST['type']);

if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `wishlist` WHERE `user_id`='$uid' and `product_id`='$pid'"))>0){
		echo "Already added";
	}else{
		// $added_on=date('Y-m-d h:i:s');
		// mysqli_query($conn,"INSERT INTO `wishlist`(`id`, `user_id`, `product_id`, `added_on`) VALUES('$uid','$pid','$added_on')");
		wishlist_add($conn,$uid,$pid);
	}
	echo $total_record=mysqli_num_rows(mysqli_query($conn,"SELECT * from `wishlist` WHERE `user_id`='$uid'"));
}else{
	$_SESSION['WISHLIST_ID']=$pid;
	echo "not_login";
}
?>