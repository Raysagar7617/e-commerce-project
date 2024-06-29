<?php

include "config.php";
$id = $_GET['id'];

$sql = "DELETE from user where user_id={$id}";
if(mysqli_query($con,$sql))
{
  header("Location:http://localhost/news-template/admin/users.php");
}
else {
     echo "<p>Can't Delete User Record</p>";
}

 ?>
