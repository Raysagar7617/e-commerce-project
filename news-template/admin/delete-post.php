<?php

 include 'config.php';
 $post_id = $_GET['id'];
 $cat_id = $_GET['cat_id'];

$sql1 = "SELECT * from post where post_id = {$post_id}";
$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_assoc($result);
$post_name = $row['post_img'];
unlink("upload/".$post_name);

 $sql ="DELETE FROM post where post_id = {$post_id};";
 $sql .="UPDATE category set post=post-1 where category_id={$cat_id}";


 if(mysqli_multi_query($con,$sql))
 {
   header("Location:{$hostname}/admin/post.php");
 }
 else {
     echo "Query Failed";
 }

 ?>
