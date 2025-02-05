<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
             include 'config.php';
             $post_id = $_GET['id'];
             $sql ="SELECT post.post_id,post.title,post.description,post.category,post.post_img,post.post_date,
               category.category_name,user.username from post
               LEFT join category on post.category = category.category_id
               LEFT join user on post.author = user.user_id
               where post.post_id = {$post_id}";
               $result = mysqli_query($con,$sql);
               if(mysqli_num_rows($result)>0)
               {
                  while($row = mysqli_fetch_assoc($result)){
         ?>
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="description" class="form-control"  required rows="5">
                    <?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option disabled> Select Category</option>
                     <?php
                        include 'config.php';
                        $sql1 = "SELECT * from category";
                        $result1 = mysqli_query($con,$sql1) or die("Unsuccessfull query");
                        if(mysqli_num_rows($result1)>0)
                        {
                          while($row1 = mysqli_fetch_assoc($result1))
                          {
                            if($row['category']==$row1['category_id'])
                            {
                               $selected = "selected";
                            }
                            else {
                                 $selected = "";
                            }
                             echo "<option {$selected} value ='{$row1['category_id']}'>{$row1['category_name']}</option>";
                          }

                        }
                   ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
      <?php }
     }
      else {
            echo "Result Not Found";
      }
      ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
