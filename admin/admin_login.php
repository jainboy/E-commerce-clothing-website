<?php
 session_start();
 ?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form action="admin_login.php" method="post" >
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control" placeholder="Username" name="name" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password"  required>
                     </div>
                     <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="apply" >Sign in</button>
					</form>
               </div>
            </div>
         </div>
      </div>
      <!-- <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script> -->
   </body>
</html>

<!-- ------------php start-------- -->

<?php
    include('../dbconnection/db.php');
    if(isset($_POST['apply'])) 
    {
      $username=$_POST['name'];
      $password=$_POST['password'];
 
         $res=mysqli_query($conn,"SELECT * FROM `admin` WHERE `first_name`='$username' AND `password`='$password' ");
         $check_user=mysqli_num_rows($res);
            if($check_user>0){
               $row=mysqli_fetch_assoc($res);
               $_SESSION['USER_LOGIN']='yes';
               $_SESSION['USER_ID']=$row['id'];
               $_SESSION['USER_NAME']=$row['first_name'];      
               $_SESSION['USER_IMAGE']=$row['image'];      
               header('location:admin_dashboard.php');
            }
            else
            {
            ?>
            <script>
                alert('username and password invalid !!');
                window.open('admin_login.php','_self');
            </script>
            <?php        
            }
        }
?>