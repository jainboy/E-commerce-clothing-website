<?php
    include('../dbconnection/db.php');
    $id=$_GET['delete'];
    $query=mysqli_query($conn,"DELETE FROM `product_categories` WHERE `cat_id`='$id'");
    if($query==true)
    {
        ?>
        <script>
            alert('category delete successfully');
            
        </script>
        <?php
        header('location:./all_categories.php');
    }
    else
    {
        ?>
        <script>
            alert('error');
        </script>
        <?php
    }
?>