<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php
                     if(isset($_POST['save']))
                     {
                        include 'config.php';
                        $cat_name = $_POST['cat'];
                        $sql = "insert into category(category_name) values('{$cat_name}')";
                        if(mysqli_query($con,$sql))
                        {
                          header("Location:{$hostname}/admin/category.php");
                        }
                     }
                   ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
