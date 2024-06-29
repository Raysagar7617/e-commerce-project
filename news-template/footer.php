<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php
                include 'config.php';
                $sql2 = "Select * from setter";
                $result2 = mysqli_query($con,$sql2);
                if(mysqli_num_rows($result2)>0)
                {
                  while($row=mysqli_fetch_assoc($result2)){
                 ?>
                <span><?php echo $row['footer_desc']; ?></span>
              <?php } } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
