<?php 
require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

$comment_tag_query = "SELECT * FROM comments WHERE status = 'pending'";
$category_tag_query = "SELECT * FROM categories";
$users_tag_query = "SELECT * FROM users";
$posts_tag_query = "SELECT * FROM posts";

$comment_tag_run = mysqli_query($connection,$comment_tag_query);
$category_tag_run = mysqli_query($connection,$category_tag_query);
$users_tag_run = mysqli_query($connection,$users_tag_query);
$posts_tag_run = mysqli_query($connection,$posts_tag_query);

$comment_rows = mysqli_num_rows($comment_tag_run);
$category_rows = mysqli_num_rows($category_tag_run);
$users_rows = mysqli_num_rows($users_tag_run);
$posts_rows = mysqli_num_rows($posts_tag_run);
?>
  </head>
  <body>
    <div id="wrapper">
      <?php require_once('include/header.php');  ?>
      <div class="container-fluid body-section">
        <div class="row">
          <div class="col-md-3">
            <?php require_once('include/left_sidebar.php'); ?>
          </div>
          <div class="col-md-9">
            <h1><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <small>Statics Overview</small></h1><hr>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
            </ol>

            <!--Items Box Open-->
            <div class="row tag-boxes">

              <!--Comment Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge"><?php echo $comment_rows;?></div>
                        <div class="text-right">New Comments</div>
                      </div>
                    </div>
                  </div>
                  <a href="comments.php">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Comments</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Comment Box Close-->

              <!--Post Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-red">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge"><?php echo $posts_rows;?></div>
                        <div class="text-right">All Posts</div>
                      </div>
                    </div>
                  </div>
                  <a href="posts.php">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Posts</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Post Box Close-->

              <!--Users Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-yellow">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge"><?php echo $users_rows;?></div>
                        <div class="text-right">All Users</div>
                      </div>
                    </div>
                  </div>
                  <a href="users.php">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Users</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Users Box Close-->

              <!--Categories Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-green">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-folder-open fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge"><?php echo $category_rows;?></div>
                        <div class="text-right">All Categories</div>
                      </div>
                    </div>
                  </div>
                  <a href="categories.php">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Categories</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Categories Box Close-->
            </div><hr><!-- Items Box Close -->

            <?php
              $get_users_query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
              $get_users_run = mysqli_query($connection,$get_users_query);
              if (mysqli_num_rows($get_users_run)>0) {
                
            ?>
            <h3>New Users</h3>
            <table class="table table-hover table-stripped">
              <thead>
                <tr>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($get_users_row = mysqli_fetch_array($get_users_run)) {
                    $users_id = $get_users_row['id'];
                    $users_date = getdate($get_users_row['date']);
                    $day = $users_date['mday'];
                    $month = substr($users_date['month'], 0,3);
                    $year = $users_date['year'];
                    $users_firstname = $get_users_row['first_name'];
                    $users_lastname = $get_users_row['last_name'];
                    $users_role = $get_users_row['role'];
                ?>
                <tr>
                  <td><?php echo $users_id;?></td>
                  <td><?php echo "$day $month $year";?></td>
                  <td><?php echo $users_firstname;?></td>
                  <td><?php echo $users_lastname;?></td>
                  <td><?php echo $users_role;?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <a href="users.php" class="btn btn-primary">View All Users</a>
            <hr>
            <?php 
              } 
            ?>
            <?php
              $get_posts_query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
              $get_posts_run = mysqli_query($connection,$get_posts_query);
              if (mysqli_num_rows($get_posts_run)>0) {
                
            ?>
            <h3>New Posts</h3>
            <table class="table">
              <thead>
                <tr>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Post Title</th>
                  <th>Category</th>
                  <th>Views</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($get_posts_row = mysqli_fetch_array($get_posts_run)) {
                    $posts_id = $get_posts_row['id'];
                    $posts_date = getdate($get_posts_row['date']);
                    $day = $posts_date['mday'];
                    $month = substr($posts_date['month'], 0,3);
                    $year = $posts_date['year'];
                    $posts_title = $get_posts_row['title'];
                    $posts_category = $get_posts_row['categories'];
                    $posts_views = $get_posts_row['views'];
                ?>
                <tr>
                  <td><?php echo $posts_id;?></td>
                  <td><?php echo "$day $month $year";?></td>
                  <td><?php echo $posts_title;?></td>
                  <td><?php echo $posts_category;?></td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $posts_views;?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <a href="posts.php" class="btn btn-primary">View All Posts</a>
            <?php 
              } 
            ?>
          </div>
        </div>
      </div>

  <?php require_once('include/footer.php');  ?>