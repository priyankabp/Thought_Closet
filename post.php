<?php require_once('include/top.php');?>
  </head>
  <body>
    <?php require_once('include/header.php');?>
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
                   <div class="day">12</div>
                   <div class="month">October</div>
                   <div class="year">2017</div>
                </div>

                <div class="col-md-8 post-title">
                   <a href="#"><h2>This is demo heading for post one...</h2></a>
                   <p>Written by : <span> Priyanka</span></p>
                </div>

                <div class="col-md-2 profile-picture">
                   <img src="images/profile-picture.jpg" alt="Profile Picture" class="img-circle">
                </div>
              </div>
              <a href="#"><img src="images/slider-img1" alt="Post Image"></a>
              <p class="description">
                What is Lorem Ipsum?
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>

                Why do we use it?
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br><br>
              </p>
              <div class="bottom">
                <span class="category">
                  <i class="fa fa-folder-open" aria-hidden="true"></i><a href="#"> Category</a>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>