<?php
$conn = mysqli_connect('localhost', 'root','','tsirtxclothing');
if($conn==false)
{
    ?>
    <script>
        alert('connection error');
    </script>
    <?php
}
?>