<?php
ob_end_clean();
 error_reporting (E_ALL ^ E_NOTICE); 
// Include autoloader 
require_once './dompdf/autoload.inc.php'; 
// require_once './dompdf/dompdf_config.inc.php';
include './dbconnection/db.php';
include './functions.php';

// if(isset($_SESSION['USER_LOGIN'])){
//     $user_id=$_SESSION['USER_ID'];
//     $res=mysqli_query($conn,"SELECT * FROM `users` where id='$user_id'");
//     $check=mysqli_num_rows($res);
//     if($check>0){
//     $row=mysqli_fetch_assoc($res);
//     $image=$row['image'];
//     }
//     }
$order_id=get_safe_value($conn,$_GET['id']);
$order_date='';
$order_status='';
$res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$order_date=$row['added_on'];
$order_status=$row['order_status'];
$date=date_format(new DateTime($order_date),'d-m-Y');
}

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// html code
$html = '<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <style>
    .onethird{
        width: 33.333%;
        float: left;
    }
    .full{
        margin-top: 200px;
    }
    .half{
        width: 50%;
        float: left;
    }
    .table td, .table th{
        border: none !important;
    }
    .address{
        padding:100px;
    </style>
  </head>
  <body>
  <!-- title row -->
  <div class="row">
    <div class="col-md-12">
      <h2>
        <i class="fa fa-globe"></i> AdminLTE, Inc.
        <small style="float:right">Date:'.$date.'</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row address">
    <div class="col-md-4 onethird">
      From
      <address>
        <strong>Admin, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (804) 123-5432<br>
        Email:info@almasaeedstudio.com
      </address>
    </div>';     
                        $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
                        $check=mysqli_num_rows($res);
                        if($check>0){
                            $row=mysqli_fetch_assoc($res);
                            $firstname=$row['firstname'];
                            $lastname=$row['lastname'];
                            $street=$row['street'];
                            $city=$row['city'];
                            $dist=$row['dist'];
                            $zip=$row['zip'];
                            $state=$row['state'];
                            $mobile=$row['mobile'];
                            $email=$row['email'];
                    }
                    $html.=' <div class="col-md-4 onethird">
                    To
                    <address>
                    <strong>'.$firstname.' '.$lastname.'</strong><br>
                    '.$street.'<br>
                    '.$city.'('.$dist.')'.'<br>
                    '.$zip.'<br/>
                    Phone: '.$mobile.'<br>
                    Email:'.$email.'
                    </address>
                    </div>
                    <div class="col-md-4 onethird">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b>'.$order_id.' <br>
                    <b>Order ID:</b>'.$order_id.'<br>
                    <b>Payment Status:</b> &nbsp;COD<br>
                    <b>Account:</b> 968-34567
                    </div>
                </div>
<div class="row">
<div class="col-md-12 table-responsive">
<table class="table table-striped full">
    <thead>
        <tr>                                                
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Shipping</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>';
    $uid=$_SESSION['USER_ID'];
    $res1=mysqli_query($conn,"SELECT DISTINCT(`order_details`.`id`) ,`order_details`.*,`product`.`pro_name`,`product`.`pro_image`,`product`.`pro_sell_price`,`product`.`pro_shipping`,`product`.`id` FROM `order_details`,`product`,`customer_order` WHERE `order_details`.`order_id`='$order_id' AND `customer_order`.`user_id`='$uid' AND `order_details`.`product_id`=`product`.`id`");
    $total_price=0;
    $shipping_charges=0;
    $cart_total=0;
      while($row1=mysqli_fetch_assoc($res1)){
        $total_price=$total_price+($row1['quantity']*$row1['price']);
        $shipping_value=$row1['quantity']*$row1['pro_shipping'];
        $sub_total=($row1['quantity']*$row1['price'])+$shipping_value;                                       
        $shipping_charges=$shipping_charges+($row1['quantity']*$row1['pro_shipping']);
        $cart_total=$cart_total+$sub_total;
        $total_price=$cart_total-$shipping_charges;
    $html.='<tr>
    <td>'.$row1['pro_name'].'</td>
    <td>'.$row1['quantity'].'</td>
    <td>'.$row1['pro_sell_price'].'</td>
    <td>'.$row1['quantity'].'*'.$row1['pro_shipping'].'='.$shipping_value.'</td>
    <td>'.$sub_total.'</td>
    </tr>';
    }
    $html.='</tbody>
    </table>
    </div>
    </div>           
    <div class="row">
    <div class="col-md-6 half">
    <p class="lead">Payment Methods:</p>
    <img src=".\admin\slider_images\img\visa.png" alt="Visa">
    <img src=".\admin\slider_images\img\mastercard.png" alt="Mastercard">
    <img src=".\admin\slider_images\img\american-express.png" alt="American Express">
    <img src=".\admin\slider_images\img\paypal2.png" alt="Paypal">

    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
    plugg
    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
    </p>
    </div>';
    $html.=' <div class="col-md-6 half">
    <p class="lead">Amount Due '.$date.'</p>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th>Subtotal:</th>
                    <td>'.$total_price.'</td>
                </tr>
                <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                </tr>
                <tr>
                    <th>Shipping:</th>
                    <td>'.$shipping_charges.'</td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td>'.$cart_total.'</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </body>
    </html>';

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

// Load content from html file 
$dompdf->loadHtml($html); 

// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("order invoice", array("Attachment" => "0"));

?>