<?php
 include 'config.php';
 if(empty($_FILES['logo']['name']))
 {
    $filename = $_POST['old-image'];
 }
 else
 {
    $error = array();
    $filename = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_type = $_FILES['logo']['type'];
    $file_tmp  = $_FILES['logo']['tmp_name'];
    $exp  = explode('.',$filename);
    $file_ext = end($exp);

    $extension = array('jpeg','jpg','png');

    if(in_array($file_ext,$extension)===false)
    {
       $error = "Choose a valid file type.Please choose PNG ,JPG file";
    }
    if($file_size>2097152)
    {
       $error = "The size of the image must be 2MB or lower";
    }

    if(empty($error) == true)
    {
       move_uploaded_file($file_tmp,"images/".$filename);
    }
    else {
          print_r($error);
          die();
    }
}
    $sql = "UPDATE setter set website_name = '{$_POST['website_name']}',logo='{$filename}',footer_desc='{$_POST['footer_desc']}'";
     echo $sql;


    if(mysqli_query($con,$sql))
    {
      header("Location:{$hostname}/admin/settings.php");
    }
    else {
           echo "Query Failed";
    }



 ?>
