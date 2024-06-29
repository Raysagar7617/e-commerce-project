<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Website Name</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
         <?php
            $con = mysqli_connect("localhost","root","root","news_site");
            $sql = "select * from setter";

            $result = mysqli_query($con,$sql) or die("Query Failed");
            if(mysqli_num_rows($result)>0){
                  while($row=mysqli_fetch_assoc($result)){
          ?>
        <form action="save-settings.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="website_name">Website Name</label>
                <input type="text" name="website_name"  class="form-control" id="exampleInputUsername" value="<?php echo $row['website_name']; ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="logo">
                <img  src="images/<?php echo $row['logo']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['logo']; ?>">
            </div>

            <div class="form-group">
                <label for="footer_desc">Footer Description</label>
                <textarea name="footer_desc" class="form-control"  required rows="5">
                    <?php echo $row['footer_desc']; ?>
                </textarea>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
  <?php } } ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
