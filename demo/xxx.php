<?php 
 include "./topbar.php";
 include './dbconnection/db.php';
  //  error_reporting (E_ALL ^ E_NOTICE); 
    
      $image='';
if(isset($_SESSION['USER_LOGIN'])){
$image_required='';
$user_id=$_SESSION['USER_ID'];
$res=mysqli_query($conn,"SELECT * FROM `users` where id='$user_id'");
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$image=$row['image'];
}
}
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
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h3>
                            <i class="fa fa-globe"></i> <b>TsirtX Clothing</b>
                            <small class="float-right">Date:<?php echo date_format(new DateTime($order_date),'d-m-Y'); ?></small>
                            </h3>
                        </div>
                    </div><br/><br/>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                            <strong>TsirtX Clothing Pvt.Ltd.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                            <?php $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
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
                            }?>

                            <strong><?php echo $firstname.' '.$lastname?></strong><br>
                            <?php echo $street?><br>
                            <?php echo $city.'('.$dist.')'?><br>
                            <?php echo $zip?><br/>
                            Phone: <?php echo $mobile?><br>
                            Email: <?php echo $email?>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b><?php echo $order_id ?> <br>
                            <b>Order ID:</b> <?php echo $order_id ?><br>
                            <b>Payment Status:</b> &nbsp; <?php echo $payment_status ?><br>
                            <b>Account:</b> 968-34567
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>                                                
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
                                    ?>
                                    <tr>
                                        <td><?php echo $row1['pro_name']?></td>
                                        <td><?php echo $row1['quantity']?></td>
                                        <td><?php echo $row1['pro_sell_price']?></td>
                                        <td><?php echo $row1['quantity'].'*'.$row1['pro_shipping'].'='.$shipping_value?></td>
                                        <td><?php echo $sub_total?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div><br/>               
                    <div class="row">
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
                            <p class="lead">Amount Due <?php echo date_format(new DateTime($order_date),'d-m-Y'); ?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><?php echo $total_price ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td><?php echo $shipping_charges ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><?php echo $cart_total?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br/>
                </div>
            </div>
        </div>
    </div>
</section>