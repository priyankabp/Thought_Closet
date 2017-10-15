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

            <div class="related-posts">
              <h3>Related Posts</h3><hr>
              <div class="row">
                <div class="col-sm-4">
                  <a href="#">
                    <img src="images/slider-img1.jpg" alt="">
                    <h4>This is heading for post one. We can add some more here</h4>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="#">
                    <img src="images/slider-img2.jpg" alt="">
                    <h4>This is heading for post one. We can add some more here</h4>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="#">
                    <img src="images/slider-img3.jpg" alt="">
                    <h4>This is heading for post one. We can add some more here</h4>
                  </a>
                </div>
              </div>
            </div>

            <div class="author">
              <div class="row">
                <div class="col-sm-3">
                  <img src="images/profile-picture.jpg" alt="Profile Picture" class="img-circle">
                </div>
                <div class="col-sm-9">
                  <h4>Priyanka</h4>
                  <p>What is Lorem Ipsum?
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
              </div>
            </div>

            <div class="comments">
              <h3>Comments</h3><hr>
              <div class="row single-comment">
                <div class="col-sm-2">
                  <img src="images/unknown-profile" alt="Profile Picture" class="img-circle">
                </div>
                <div class="col-sm-10">
                  <h4>Priyanka</h4>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                </div>
              </div>

              <div class="row single-comment">
                <div class="col-sm-2">
                  <img src="images/unknown-profile" alt="Profile Picture" class="img-circle">
                </div>
                <div class="col-sm-10">
                  <h4>Priyanka</h4>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                </div>
              </div>
            </div>

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