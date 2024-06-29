<?php
 include 'config.php';
 $cat_id = $_GET['id'];
 $sql = "delete from category where category_id = {$cat_id}";
 if(mysqli_query($con,$sql))
 {
   header("Location:{$hostname}/admin/category.php");
 }

 ?>
