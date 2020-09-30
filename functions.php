<?php
session_start();
?>
<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($conn,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($conn,$str);
	}
}

function get_product($conn,$limit='',$cat_id='',$product_id=''){
	$sql="select * from product where status=1 ";
	if($limit!=''){
		$sql.=" limit $limit";
	}
	if($product_id!=''){
		$sql.=" and product.id=$product_id ";
	}
	$res=mysqli_query($conn,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}

function wishlist_add($conn,$uid,$pid){
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($conn,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
}

?>