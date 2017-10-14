<?php require_once('include/top.php');?>
  </head>
  <body>
    <?php require_once('include/header.php');?>

    <div class="jumbotron">
      <div class="container">
        <div id="details" class="animated fadeInLeft">
          <h1>Thought Closet <span>Blog</span></h1>
          <p>This is an online personel blog.So, put your thoughts in closet</p>
        </div>
      </div>
      <img src="images/top-image.jpg" alt="Top Image">
    </div>

    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-8">
            <?php 
              $slider_query = "SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 5";
              $slider_run = mysqli_query($connection,$slider_query);
              if (mysqli_num_rows($slider_run) > 0) { #IF open
                $count = mysqli_num_rows($slider_run);
              ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php
                    for ($i=0;$i < $count; $i++) { 
                      if ($i==0) {
                        echo "<li data-target='#carousel-example-generic' data-slide-to=".$i." class='active'></li>";
                      }
                      else{
                        echo "<li data-target='#carousel-example-generic' data-slide-to=".$i."'></li>";
                      }
                    }
                  ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <?php 
                    $check = 0;
                    while ($slider_row = mysqli_fetch_array($slider_run)) {
                      $slider_id = $slider_row['id'];
                      $slider_image = $slider_row['image'];
                      $slider_title = $slider_row['title'];
                      $check = $check +1;
                      if ($check==1) {
                        echo "<div class='item active'>";
                      }
                      else{
                        echo "<div class='item'>";
                      }
                  ?>
                    <a href="post.php?post_id=<?php echo $slider_id; ?>"><img src="images/<?php echo $slider_image; ?>" alt="Slider 1"></a>
                    <div class="carousel-caption">
                      <h2><?php echo $slider_title; ?></h2>
                    </div>
                  </div>
              <?php } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>

            <?php 
              }# IF close
              $query = "SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 3";
              $run = mysqli_query($connection,$query);
              if (mysqli_num_rows($run) > 0) {
                while($row = mysqli_fetch_array($run)){
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
                  $tags = $row['tags'];
                  $post_data = $row['post_data'];
                  $views = $row['views'];
                  $status = $row['status'];
              ?>   
                  <div class="post">
                      <div class="row">
                        <div class="col-md-2 post-date" >
                           <div class="day"><?php echo $day; ?></div>
                           <div class="month"><?php echo $month; ?></div>
                           <div class="year"><?php echo $year; ?></div>
                        </div>

                        <div class="col-md-8 post-title">
                           <a href="post.php?post_id=<?php echo $id; ?>"><h2><?php echo $title; ?></h2></a>
                           <p>Written by : <span> <?php echo ucfirst($author); ?></span></p>
                        </div>

                        <div class="col-md-2 profile-picture">
                           <img src="images/<?php echo $author_image; ?>" alt="Profile Picture" class="img-circle">
                        </div>
                      </div>
                      <a href="post.php?post_id=<?php echo $id; ?>"><img src="images/<?php echo $image; ?>" alt="Post Image"></a>
                      <p class="description">
                        <?php echo substr($post_data,0,300)."...."; ?>
                      </p>
                      <a href="post.php?post_id=<?php echo $id; ?>" class="btn btn-primary">Read More...</a>
                      <div class="bottom">
                        <span class="category">
                          <i class="fa fa-folder-open" aria-hidden="true"></i><a href="index.php?category=<?php echo $id; ?>"> <?php echo ucfirst($categories); ?></a>
                        </span>|
                        <span class="comment">
                          <i class="fa fa-comment" aria-hidden="true"></i><a href="#"> Comment</a>
                        </span>
                      </div>
                  </div>

              <?php      
                  }
                }
                else{
                  echo "<center><h2>No Posts Available</h2></center>";
                }
              ?>

            <nav aria-label="Page navigation" id="pagination">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>

          <div class="col-md-4">
            <?php require_once('include/right_sidebar.php');?>
          </div> <!-- Right side menu of the screen closed -->
        </div>
      </div>
    </section>
<?php require_once('include/footer.php');?>