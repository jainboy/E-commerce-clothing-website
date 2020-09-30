<?php
    include('../dbconnection/db.php');
    $id=$_GET['delete'];
    $query=mysqli_query($conn,"DELETE FROM `sub-category` WHERE `id`='$id'");
    if($query==true)
    {
        ?>
        <script>
            alert('sub-category delete successfully');
            
        </script>
        <?php
        header('location:./all_sub_category.php');
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