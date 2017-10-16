<?php require_once('include/top.php');?>
  </head>
  <body>
    <?php require_once('include/header.php');?>

    <?php
      if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
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
              <p class="description">
                 <?php echo $post_data;?>
              </p>
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
                  <p>What is Lorem Ipsum?
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
                    <h4><?php echo ucfirst($c_username); ?></h4>
                    <p><?php echo $c_comment; ?></p>
                  </div>
                </div>
                <?php } ?>
              </div>
            <?php } ?>

            <!-- Add new comments on the Post on Single post page-->
            <div class="comment-box">
              <div class="row">
                <div class="col-xs-12">
                  <form action="">
                    <div class="form-group">
                      <label for="fullname">Full Name:*</label>
                      <input type="text" name="" id="fullname" class="form-control" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email Address:*</label>
                      <input type="text" name="" id="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                      <label for="website">Website:</label>
                      <input type="text" name="" id="website" class="form-control" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                      <label for="comment">Comment:*</label>
                      <textarea id="comment" cols="30" rows="10" placeholder="Enter your comment here..." class="form-control"></textarea> 
                    </div>

                     <a href="#"><input type="submit" name="submit" class="btn btn-primary" value="Submit Comment"></a>
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