<?php
 include 'config.php';
 if(empty($_FILES['new-image']['name']))
 {
    $filename = $_POST['old-image'];
 }
 else
 {
    $error = array();
    $filename = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_type = $_FILES['new-image']['type'];
    $file_tmp  = $_FILES['new-image']['tmp_name'];
    $file_ext  = end(explode('.',$filename));

    $extension = array('jpeg','jpg','png');

    if(in_array($file_ext,$extension)===false)
    {
       $error = "Choose a valid file type.Please choose PNG ,JPG file";
    }
    if($filesize>2097152)
    {
       $error = "The size of the image must be 2MB or lower";
    }

    if(empty($error) == true)
    {
       move_uploaded_file($file_tmp,"upload/".$filename);
    }
    else {
          print_r($error);
          die();
    }
}
    $sql = "UPDATE post set title = '{$_POST['title']}',description='{$_POST['description']}',category={$_POST['category']},post_img='{$filename}'
            where post_id = {$_POST['post_id']}";

    if(mysqli_query($con,$sql))
    {
      header("Location:{$hostname}/admin/post.php");
    }
    else {
           echo "Query Failed";
    }



 ?>
