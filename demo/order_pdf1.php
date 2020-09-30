<?php
ob_end_clean();
//  error_reporting (E_ALL ^ E_NOTICE); 
// Include autoloader 
require_once './dompdf/autoload.inc.php'; 
// require_once './dompdf/dompdf_config.inc.php';
include './dbconnection/db.php';
include './functions.php';


$order_id=get_safe_value($conn,$_GET['id']);
$order_date='';
$order_status='';
$res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$order_date=$row['added_on'];
$order_status=$row['order_status'];
}

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// html code
$html='<html><head>
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
</style>
</head>
<body>
  <!-- title row -->
  <div class="row">
    <div class="col-md-12">
      <h2>
        <i class="fa fa-globe"></i> AdminLTE, Inc.
        <small style="float:right">Date: 2/10/2014</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row">
    <div class="col-md-4 onethird">
      From
      <address>
        <strong>Admin, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (804) 123-5432<br>
        Email:info@almasaeedstudio.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-md-4 onethird">
      To
      <address>
        <strong>John Doe</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (555) 539-1037<br>
        Email: john.doe@example.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-md-4 onethird">
      <b>Invoice #007612</b><br>
      <br>
      <b>Order ID:</b> 4F3S8J<br>
      <b>Payment Due:</b> 2/22/2014<br>
      <b>Account:</b> 968-34567
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-md-12 table-responsive">
      <table class="table table-striped full">
        <thead>
        <tr>
          <th>Qty</th>
          <th>Product</th>
          <th>Serial #</th>
          <th>Description</th>
          <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>Call of Duty</td>
          <td>455-981-221</td>
          <td>El snort testosterone trophy driving gloves handsome</td>
          <td>$64.50</td>
        </tr>
        <tr>
          <td>1</td>
          <td>Need for Speed IV</td>
          <td>247-925-726</td>
          <td>Wes Anderson umami biodiesel</td>
          <td>$50.00</td>
        </tr>
        <tr>
          <td>1</td>
          <td>Monsters DVD</td>
          <td>735-845-642</td>
          <td>Terry Richardson helvetica tousled street art master</td>
          <td>$10.70</td>
        </tr>
        <tr>
          <td>1</td>
          <td>Grown Ups Blue Ray</td>
          <td>422-568-642</td>
          <td>Tousled lomo letterpress</td>
          <td>$25.99</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-md-6 half">
      <p class="lead">Payment Methods:</p>
      <img src=".\admin\slider_images\img\visa.png" alt="Visa">
      <img src=".\admin\slider_images\img\mastercard.png" alt="Mastercard">
      <img src=".\admin\slider_images\img\american-express.png" alt="American Express">
      <img src=".\admin\slider_images\img\paypal2.png" alt="Paypal">

      <p>
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
        jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-md-6 half">
      <p class="lead">Amount Due 2/22/2014</p>

      <div class="table-responsive">
        <table class="table">
          <tbody><tr>
            <th>Subtotal:</th>
            <td>$250.30</td>
          </tr>
          <tr>
            <th>Tax (9.3%)</th>
            <td>$10.34</td>
          </tr>
          <tr>
            <th>Shipping:</th>
            <td>$5.80</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>$265.24</td>
          </tr>
        </tbody></table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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