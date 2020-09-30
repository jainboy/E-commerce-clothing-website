<?php
  include './dbconnection/db.php';
  include './functions.php';
$firstname=get_safe_value($conn,$_POST['firstname']);
$lastname=get_safe_value($conn,$_POST['lastname']);
$email=get_safe_value($conn,$_POST['email']);
$mobile=get_safe_value($conn,$_POST['mobile']);
$comment=get_safe_value($conn,$_POST['message']);
$added_on=date('Y-m-d h:i:s');
mysqli_query($conn,"INSERT INTO `contact_us`(`firstname`, `lastname`, `email`, `mobile`, `comment`, `added_on`) values('$firstname','$lastname','$email','$mobile','$comment','$added_on')");
echo "Thank you";
?>