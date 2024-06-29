<?php

include 'config.php';

if(isset($_FILES['fileToUpload']))
{
  $errors = array();
  $filename = $_FILES['fileToUpload']['name'];
  $filesize = $_FILES['fileToUpload']['size'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_ext = end(explode('.',$filename));
  $extension = array('jpeg','jpg','png');

  if(in_array($file_ext,$extension)===false)
  {
    $errors = "This file extension not allowed.Please use Jpg or png file";
  }
  if($filesize>2097152)
  {
    $errors = "The size of the file be 2MB or lower";
  }
  if(empty($errors)== true)
  {
    move_uploaded_file($file_tmp,"upload/".$filename);
  }
  else {
        print_r($errors);
        die();
  }

}
session_start();
$title = mysqli_real_escape_string($con,$_POST['post_title']);
$postdes = mysqli_real_escape_string($con,$_POST['postdesc']);
$category =mysqli_real_escape_string($con,$_POST['category']);
$date = date("d M, Y");
$author = $_SESSION["user_id"];

$sql = "INSERT into post(title,description,category,post_date,author,post_img)
       values('{$title}','{$postdes}',{$category},'{$date}',{$author},'{$filename}');";
$sql .="UPDATE category set post = post+1 where category_id = {$category}";



if(mysqli_multi_query($con,$sql))
{
  header("Location:{$hostname}/admin/post.php");
}
else {
      echo '<div class ="alert alert-danger">Query Failed</div>';
}

 ?>
