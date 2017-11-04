<?php require_once('include/top.php');?>
  </head>
  <body>
    <?php require_once('include/header.php');?>

    <?php
      if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id";
        mysqli_query($connection,$views_query);
        $query = "SELECT * FROM posts WHERE status = 'publish' and id = $post_id";
        $run = mysqli_query($connection,$query);
        if(mysqli_num_rows($run) > 0){
          $row = mysqli_fetch_array($run);
          $id = $row['id'];
          $date = getdate($row['date']);
          $day = $date['mday'];
          $month = $date['month'];
          $year = $date['year'];
          $title = $row['title'];
          $author = $row['author'];
          $author_image = $row['author_image'];
          $image = $row['image'];
          $categories = $row['categories'];
          $post_data = $row['post_data'];
        }
        else{
          header('Location : index.php');
        }
      }
    ?>
    <div class="jumbotron">
      <div class="container">
        <div id="details" class="animated fadeInLeft">
          <h1>Custom<span> Post</span></h1>
          <p>Add new post here...</p>
        </div>
      </div>
      <img src="images/top-image.jpg" alt="Top Image">
    </div>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">

            <div class="post">
              <div class="row">
                <div class="col-md-2 post-date" >
                   <div class="day"><?php echo $day;?></div>
                   <div class="month"><?php echo $month;?></div>
                   <div class="year"><?php echo $year;?></div>
                </div>

                <div class="col-md-8 post-title">
                   <a href="post.php?post_id=<?php echo $id;?>"><h2><?php echo $title;?></h2></a>
                   <p>Written by : <span> <?php echo ucfirst($author);?></span></p>
                </div>

                <div class="col-md-2 profile-picture">
                   <img src="images/<?php echo $author_image;?>" alt="Profile Picture" class="img-circle">
                </div>
              </div>
              <a href="images/<?php echo $image;?>"><img src="images/<?php echo $image;?>" alt="Post Image"></a>
              <div class="description">
                 <?php echo $post_data;?>
              </div>
              <div class="bottom">
                <span class="category">
                  <i class="fa fa-folder-open" aria-hidden="true"></i><a href="#"> <?php echo ucfirst($categories);?></a>
                </span>|
                <span class="comment">
                  <i class="fa fa-comment" aria-hidden="true"></i><a href="#"> Comment</a>
                </span>
              </div>
            </div>

            <!--Related Posts changed to dynamic on Single post page-->
            <div class="related-posts">
              <h3>Related Posts</h3><hr>
              <div class="row">
                <?php
                  $rp_query = "SELECT * FROM posts WHERE status = 'publish' AND title LIKE '%$title%' LIMIT 3";
                  $rp_run = mysqli_query($connection,$rp_query);
                  while ($rp_row = mysqli_fetch_array($rp_run)) {
                    $rp_id = $rp_row['id'];
                    $rp_title = $rp_row['title'];
                    $rp_image = $rp_row['image'];
                ?>
                  <div class="col-sm-4">
                    <a href="post.php?post_id=<?php echo $rp_id;?>">
                      <img src="images/<?php echo $rp_image;?>" alt="">
                      <h4><?php echo $rp_title;?></h4>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- Details of Author on the Post on Single post page-->
            <div class="author">
              <div class="row">
                <div class="col-sm-3">
                  <img src="images/<?php echo $author_image;?>" alt="Profile Picture" class="img-circle">
                </div>
                <div class="col-sm-9">
                  <h4><?php echo ucfirst($author);?></h4>
                  <?php
                    $bio_query = "SELECT * FROM users WHERE username = '$author'";
                    $boi_run = mysqli_query($connection,$bio_query);
                    if (mysqli_num_rows($boi_run)>0) {
                      $bio_row = mysqli_fetch_array($boi_run);
                      $author_deatils = $bio_row['details'];
                  ?>
                  <p><?php echo $author_details;?></p>
                    <?php } ?>
                </div>
              </div>
            </div>

            <!-- Query to fetch comments from DB -->
            <?php
              $c_query="SELECT * FROM comments WHERE status ='approve' and post_id = $post_id ORDER BY id DESC";
              $c_run = mysqli_query($connection,$c_query);
              if (mysqli_num_rows($c_run) > 0) {
              ?>

              <!-- Comments on the Post on Single post page-->
              <div class="comments">
                <h3>Comments</h3>
                <!--Loop to read all comments for this post -->
                <?php
                  while ($c_row = mysqli_fetch_array($c_run)) {
                    $c_id = $c_row['id'];
                    $c_image = $c_row['image'];
                    $c_username = $c_row['username'];
                    $c_name = $c_row['name'];
                    $c_comment = $c_row['comment'];
                ?>
                <hr>
                <div class="row single-comment">
                  <div class="col-sm-2">
                    <img src="images/<?php echo $c_image; ?>" alt="Profile Picture" class="img-circle">
                  </div>
                  <div class="col-sm-10">
                    <h4><?php echo ucfirst($c_name); ?></h4>
                    <p><?php echo $c_comment; ?></p>
                  </div>
                </div>
                <?php } ?>
              </div>
            <?php } ?>

            <!-- Add new comments on the Post on Single post page-->
            <?php
              if (isset($_POST['submit'])) {
                $cs_name = $_POST['name'];
                $cs_email = $_POST['email'];
                $cs_website = $_POST['website'];
                $cs_comment = $_POST['comment'];
                $cs_date = time();
                if (empty($cs_name) or empty($cs_email) or empty($cs_comment)) {
                  $error_msg = "All (*) fields are required";
                }
                else{
                  $cs_query = "INSERT INTO `comments` (`date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES ('$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'unknown-profile.png', '$cs_comment','pending')";
                  if(mysqli_query($connection,$cs_query)){
                    $msg = "Comment submitted and waiting for approval";
                    $cs_name = "";
                    $cs_email = "";
                    $cs_website = "";
                    $cs_comment = "";
                  }
                  else{
                    $error_msg = "Comment has not been submitted";
                  }
                }
              }
            ?>
            <div class="comment-box">
              <div class="row">
                <div class="col-xs-12">
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="fullname">Full Name:*</label>
                      <input type="text" value="<?php if(isset($cs_name)){echo $cs_name;}?>" name="name" id="fullname" class="form-control" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email Address:*</label>
                      <input type="text" value="<?php if(isset($cs_email)){echo $cs_email;}?>" name="email" id="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                      <label for="website">Website:</label>
                      <input type="text" value="<?php if(isset($cs_website)){echo $cs_website;}?>" name="website" id="website" class="form-control" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                      <label for="comment">Comment:*</label>
                      <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Enter your comment here..." class="form-control"><?php if(isset($cs_comment)){echo $cs_comment;}?></textarea> 
                    </div>

                     <a href="#"><input type="submit" name="submit" class="btn btn-primary" value="Submit Comment"></a>

                     <?php
                      if (isset($error_msg)) {
                        echo "<span style = 'color:red;' class='pull-right'>$error_msg</span>";
                      }
                      elseif (isset($msg)) {
                        echo "<span style = 'color:green;' class='pull-right'>$msg</span>";
                      }
                     ?>
                  </form>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-4"> <!-- Right side menu of the screen open -->
            <?php require_once('include/right_sidebar.php');?>
          </div> <!-- Right side menu of the screen closed -->
        </div>
      </div>
    </section>

  <?php require_once ('include/footer.php')  ?>