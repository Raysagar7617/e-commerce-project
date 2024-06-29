<?php
include 'config.php';
$filename = basename($_SERVER['PHP_SELF']);
switch ($filename) {
  case "single.php":
     if(isset($_GET['id']))
     {

         $sql = "Select * from post where post_id = {$_GET['id']}";
         $result = mysqli_query($con,$sql) or die("QUERY Failed");
         $row = mysqli_fetch_assoc($result);
         $post_title = $row['title']." News";
     }
     else {
          $post_title ="NO File Found";
     }
    break;
    case "category.php":
    if(isset($_GET['cid']))
    {

        $sql = "Select * from category where category_id= {$_GET['cid']}";
        $result = mysqli_query($con,$sql) or die("QUERY Failed");
        $row = mysqli_fetch_assoc($result);
        $post_title = $row['category_name']." News";
    }
    else {
         $post_title ="NO File Found";
    }
   break;
   case "author.php":
   if(isset($_GET['a_id']))
   {

       $sql = "Select * from user where user_id= {$_GET['a_id']}";
       $result = mysqli_query($con,$sql) or die("QUERY Failed");
       $row = mysqli_fetch_assoc($result);
       $post_title = "News by :".$row['first_name']." ".$row['last_name'];
   }
   else {
        $post_title ="NO File Found";
   }
  break;
  case "search.php":
  if(isset($_GET['search']))
  {

      $post_title = $_GET['search'];
  }
  else {
       $post_title ="NO File Found";
  }
 break;
  default:
        $post_title = "News Site";
    break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $post_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<?php  ?>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
              <?php
                   include 'config.php';
                   $sql2 = "Select * from setter";
                   $result2 = mysqli_query($con,$sql2);
                   if(mysqli_num_rows($result2)>0)
                   {
                     while($row=mysqli_fetch_assoc($result2)){
                       if($row['logo']=="")
                       {
                         echo '<a href="index.php"><h1>'.$row['website_name'].'</h1></a>';
                       }
                       else {
                            echo '<a href="index.php" id="logo"><img src="admin/images/'.$row['logo'].'"></a>';
                       }
                     }
                   }
               ?>


            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php
                    include 'config.php';
                    if(isset($_GET['cid']))
                    {
                      $cat_id = $_GET['cid'];
                    }
                    $sql = "SELECT * from category WHERE post > 0 ";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)>0){
                      $active = "";
               ?>
                <ul class='menu'>
                  echo "<li ><a href='<?php echo $hostname; ?>'>Home</a></li>";
                   <?php while($row=mysqli_fetch_assoc($result))
                   {
                     if(isset($_GET['cid']))
                     {
                       if($row['category_id'] == $cat_id)
                       {
                        $active = "active";
                       }
                       else
                       {
                          $active = "";
                       }
                     }
                    echo "<li><a class ='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                   } ?>
                </ul>
              <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
