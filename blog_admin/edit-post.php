<?php 
require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];

if (isset($_GET['edit'])) {
  $edit_id = $_GET['edit'];
  if ($session_role == 'admin') {
    $get_query = "SELECT * FROM posts where id = $edit_id";
    $get_run = mysqli_query($connection,$get_query);
  }
  else if ($session_role == 'author') {
    $get_query = "SELECT * FROM posts where id = $edit_id and author = '$session_username'";
    $get_run = mysqli_query($connection,$get_query);
  }

  if (mysqli_num_rows($get_run)>0) {
    $get_row = mysqli_fetch_array($get_run);
    $title = $get_row['title'];
    $post_data = $get_row['post_data'];
    $tags = $get_row['tags'];
    $image = $get_row['image'];
    $status = $get_row['status'];
    $categories = $get_row['categories'];

  }
  else{
    header('Location: posts.php');
  }
}
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
            <h1><i class="fa fa-plus-pencil" aria-hidden="true"></i> Edit Post <small>Edit Post Details</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-plus-pencil" aria-hidden="true"></i> Edit Post</a></li>
            </ol>

            <?php
              if (isset($_POST['update'])) {
                $up_title = mysqli_real_escape_string($connection,$_POST['title']);
                $up_post_data = mysqli_real_escape_string($connection,$_POST['post-data']);
                $up_categories = $_POST['categories'];
                $up_tags = mysqli_real_escape_string($connection,$_POST['tags']);
                $up_status = $_POST['status'];
                $up_image = $_FILES['image']['name'];
                $up_tmp_name = $_FILES['image']['tmp_name'];

                if (empty($up_image)) {
                  $up_image = $image;
                }
                if (empty($up_title) or empty($up_post_data) or empty($up_tags) or empty($up_image)) {
                  $error = "All * fields are required";
                }
                else{
                  $update_query = "UPDATE `cms`.`posts` SET `title` = '$up_title',`image` = '$up_image',`categories` = '$up_categories',`tags` = '$up_tags',`post_data` = '$up_post_data',`status` = '$up_status' WHERE id = $edit_id";

                  if (mysqli_query($connection,$update_query)) {
                    $msg = "Post Updated";
                    $path = "images/$up_image";
                    header("location: edit-post.php?edit=$edit_id");
                    if (!empty($up_image)) {
                      if(move_uploaded_file($up_tmp_name, $path)){
                      copy($path, "../$path");
                      }
                    }
                  }
                  else{
                    $error = "Post is not Updated";
                  }
                }
              }
            ?>

            <div class="row">
              <div class="col-xs-12">
                <form action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="title">Title:*</label>
                    <?php 
                      if (isset($error)) {
                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                      }
                      elseif (isset($msg)) {
                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                      }
                    ?>
                    <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)){echo $title;}?>" class="form-control">
                  </div>

                  <div class="form-group">
                    <a href="media.php" class="btn btn-primary">Add Media</a>
                  </div>

                  <div class="form-group">
                    <textarea id="textarea" name="post-data" class="form-control" <?php if(isset($post_data)){echo $post_data;}?>></textarea>
                  </div>

                  <div class="row">

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="file">Post Image:*</label>
                          <input type="file" name="image">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="categories">Categories:*</label>
                            <select class="form-control" name="categories" id="categories">
                              <?php
                                $category_query = "SELECT * FROM categories";
                                $category_query_run = mysqli_query($connection,$category_query);
                                if (mysqli_num_rows($category_query_run)>0) {
                                  while ($category_row = mysqli_fetch_array($category_query_run)) {
                                    $category_name = $category_row['category'];
                                     echo "<option value='".$category_name."'".((isset($categories) and $categories == $category_name)?"selected":"").">".ucfirst($category_name)."</option>";
                                  }
                                }
                                else{
                                  echo "<center><h6>No Categories Available </h6></center>";
                                }
                              ?>
                            </select>
                        </div>
                      </div>

                  </div>

                  <div class="row">

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="tags">Tags:*</label>
                          <input type="text" name="tags" placeholder="Your tags here" value="<?php if(isset($tags)){echo $tags;}?>"class="form-control">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="status">Status:*</label>
                            <select class="form-control" name="status" id="status">
                              <option value="publish" <?php if (isset($status) and $status == 'publish'){echo "selected";}?>>Publish</option>
                              <option value="draft" <?php if (isset($status) and $status == 'draft'){echo "selected";}?>>Draft</option>
                            </select>
                        </div>
                      </div>

                  </div>
                  <input type="submit" name="update" value="Update Post" class="btn btn-primary">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php require_once('include/footer.php');  ?>