<div class="widgets">
            <form action="index.php" method="post"><!-- Adding thisto activate search option -->
              <div class="input-group">
                <input type="text" name="search-title" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <input type="submit" name="search" value="Go!" class="btn btn-default">
                  </span>
              </div><!-- /input-group -->
            </form>
          </div><!-- widgets closed -->

            <div class="widgets"><!-- Popular Posts widgets open -->
              <div class="popular">
                <h4> Popular Posts</h4>
                <?php
                  $popular_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 5";
                  $popular_run = mysqli_query($connection,$popular_query);
                  if (mysqli_num_rows($popular_run) >0 ) {
                    while ($popular_row = mysqli_fetch_array($popular_run)) {
                      $popular_id = $popular_row['id'];
                      $popular_date = getdate($popular_row['date']);
                      $popular_day = $popular_date['mday'];
                      $popular_month = $popular_date['month'];
                      $popular_year = $popular_date['year'];
                      $popular_title = $popular_row['title'];
                      $popular_image = $popular_row['image'];

                  ?>
                  <hr>
                  <div class="row">
                    <div class="col-xs-4">
                      <a href="post.php?post_id=<?php echo $popular_id; ?>"><img src="images/<?php echo $popular_image;?>" alt="Image 1"></a>
                    </div>
                    <div class="col-xs-8 details">
                      <a href="post.php?post_id=<?php echo $popular_id; ?>"><h5><?php echo $popular_title;?></h5></a>
                      <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $popular_day." ".$popular_month." , ".$popular_year;?></p>
                    </div>
                  </div>
                  <?php
                    }
                   }
                   else{
                    echo "<h3>No Post Available</h3>";
                   }
                  ?>
              </div>
            </div><!-- Popular Posts widgets closed -->

            <div class="widgets"><!-- Recent Posts widgets open -->
              <div class="popular">
                <h4> Recent Posts</h4>
                <?php
                  $recent_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
                  $recent_run = mysqli_query($connection,$recent_query);
                  if (mysqli_num_rows($recent_run) >0 ) {
                    while ($recent_row = mysqli_fetch_array($recent_run)) {
                      $recent_id = $recent_row['id'];
                      $recent_date = getdate($recent_row['date']);
                      $recent_day = $recent_date['mday'];
                      $recent_month = $recent_date['month'];
                      $recent_year = $recent_date['year'];
                      $recent_title = $recent_row['title'];
                      $recent_image = $recent_row['image'];

                  ?>
                  <hr>
                  <div class="row">
                    <div class="col-xs-4">
                      <a href="post.php?post_id=<?php echo $recent_id; ?>"><img src="images/<?php echo $recent_image;?>" alt="Image 1"></a>
                    </div>
                    <div class="col-xs-8 details">
                      <a href="post.php?post_id=<?php echo $recent_id; ?>"><h5><?php echo $recent_title;?></h5></a>
                      <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $recent_day." ".$recent_month." , ".$recent_year;?></p>
                    </div>
                  </div>
                  <?php
                    }
                   }
                   else{
                    echo "<h3>No Post Available</h3>";
                   }
                  ?>
              </div>
            </div><!-- Recent Posts widgets closed -->

            <!-- Categories widgets open -->
            <div class="widgets">
              <div class="popular">
                <h4> Categories</h4>
                <hr>
                <div class="row">
                <div class="col-xs-6">
                  <ul>
                    <?php 
                      $category_query = "SELECT * FROM categories";
                      $category_run = mysqli_query($connection,$category_query);
                      if(mysqli_num_rows($category_run) > 0){
                        $count = 2;
                        while ($category_row = mysqli_fetch_array($category_run)) {
                          $category_id = $category_row['id'];
                          $category_category = $category_row['category'];
                          $count = $count+1;

                          if (($count %2)==1) {
                            echo "<li><a href='index.php?category=".$category_id."'>".(ucfirst($category_category))."</a></li>";
                          }
                          
                        }
                      }
                      else{
                        echo "<p>No Category</p>";
                      }
                    ?>
                  </ul>
                </div>
                <div class="col-xs-6">
                  <ul>
                    <?php 
                      $category_query = "SELECT * FROM categories";
                      $category_run = mysqli_query($connection,$category_query);
                      if(mysqli_num_rows($category_run) > 0){
                        $count = 2;
                        while ($category_row = mysqli_fetch_array($category_run)) {
                          $category_id = $category_row['id'];
                          $category_category = $category_row['category'];
                          $count = $count+1;

                          if (($count %2)==0) {
                            echo "<li><a href='index.php?category=".$category_id."'>".(ucfirst($category_category))."</a></li>";
                          }
                          
                        }
                      }
                      else{
                        echo "<p>No Category</p>";
                      }
                    ?>
                  </ul>
                </div>
              </div>
              </div>
            </div><!-- Categories widgets closed -->

            <!-- Social widgets open -->
            <div class="widgets">
              <div class="popular">
                <h4> Social</h4>
                <hr>
                <div class="row">
                  <div class="col-xs-4">
                    <a href="https://www.facebook.com"><img src="images/facebook.png" alt="Facebook"></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="https://twitter.com/"><img src="images/twitter.png" alt="Twitter"></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="https://plus.google.com/discover"><img src="images/googleplus.png" alt="Google Plus"></a>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-xs-4">
                    <a href="https://www.linkedin.com/"><img src="images/linkedin.png" alt="LinkedIn"></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="https://www.skype.com/en/"><img src="images/skype.png" alt="Skype"></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="https://www.youtube.com/"><img src="images/youtube.png" alt="YouTube"></a>
                  </div>
                </div>
              </div>
            </div><!-- Social widgets closed -->