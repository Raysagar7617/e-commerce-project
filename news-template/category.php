<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
                          include "config.php";

                        $sql2 = "Select * from category where category_id={$cat_id}";
                        $result2 = mysqli_query($con,$sql2);
                        $row1 =mysqli_fetch_assoc($result2);
                   ?>
                  <h2 class="page-heading"><?php echo $row1['category_name']; ?></h2>
                  <?php
                      include 'config.php';
                      if(isset($_GET['cid']))
                      {
                        $cat_id = $_GET['cid'];
                      }


                      $limit = 3;
                      if(isset($_GET['page']))
                      {
                        $page = $_GET['page'];
                      }
                      else {
                          $page = 1;
                      }
                      $offset = ($page-1)*$limit;

                      $sql = "SELECT post.post_id,post.title,post.description,post.post_img,
                              post.post_date,category.category_name,user.username,post.category,post.post_date,post.author from post
                              LEFT JOIN category on post.category = category.category_id
                              LEFT JOIN user on post.author = user.user_id
                              WHERE post.category = {$cat_id}
                              ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0)
                        {
                          while($row=mysqli_fetch_assoc($result)){

                   ?>
                 <div class="post-content">
                     <div class="row">
                         <div class="col-md-4">
                             <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                         </div>
                         <div class="col-md-8">
                             <div class="inner-content clearfix">
                                 <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                 <div class="post-information">
                                     <span>
                                         <i class="fa fa-tags" aria-hidden="true"></i>
                                         <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                     </span>
                                     <span>
                                         <i class="fa fa-user" aria-hidden="true"></i>
                                         <a href='author.php?a_id=<?php echo $row['author'];?>'><?php echo $row['username']; ?></a>
                                     </span>
                                     <span>
                                         <i class="fa fa-calendar" aria-hidden="true"></i>
                                          <?php echo $row['post_date']; ?>
                                     </span>
                                 </div>
                                 <p class="description">
                                    <?php echo substr($row['description'],0,130)."....."; ?>
                                 </p>
                                 <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <?php
                   }
                 }else {
                     echo "File not Found";
                 }
                 $sql1 = "SELECT * from category where category_id = {$cat_id}";
                 $result1 = mysqli_query($con,$sql1) or die("Query Failed");
                 $row = mysqli_fetch_assoc($result1);

                 if(mysqli_num_rows($result1)>0)
                 {
                    $total_records = $row['post'];
                    $totalpage = ceil($total_records/$limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if($page>1)
                    {
                      echo '<li><a href="index.php?cid='.$cat_id.'&page='.($page-1).'">Prev</a></li>';
                    }
                    for($i=1;$i<=$totalpage;$i++)
                    {
                       if($i==$page)
                       {
                          $active = "active";
                       }
                       else {
                            $active = "";
                       }
                        echo '<li class = "'.$active.'"><a href="index.php?cid='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
                    }
                    if($totalpage>$page)
                    {
                      echo '<li ><a href="index.php?cid='.$cat_id.'&page='.($page+1).'">Next</a></li>';;
                    }
                    echo "</ul>";
                 }

                  ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
