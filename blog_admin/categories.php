<?php require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
elseif (isset($_SESSION['username']) && $_SESSION['role'] =='author'){
  header('Location: index.php');
}

if (isset($_GET['edit'])) {
  $edit_id = $_GET['edit'];
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  if (isset($_SESSION['username']) and $_SESSION['role'] == 'admin') {
    $del_query = "DELETE FROM categories WHERE id = '$delete_id'";
      if(mysqli_query($connection,$del_query)){
        $del_msg = "Category has been deleted";
      }
      else{
        $del_error = "Category has not been deleted";
      }
  }
}

if (isset($_POST['submit'])) {
  $category_name = mysqli_real_escape_string($connection,strtolower($_POST['category_name']));
  if (empty($category_name)) {
    $error = "Please add category name";
  }
  else{
    $check_query = "SELECT * FROM categories WHERE category = '$category_name'";
    $check_run = mysqli_query($connection,$check_query);
    if (mysqli_num_rows($check_run) > 0) {
      $error = "Category name already exits";
    }
    else{
      $insert_query = "INSERT INTO `cms`.`categories` (`category`) VALUES ('$category_name');";
      if (mysqli_query($connection,$insert_query)) {
        $msg = "New Category added";
      }
      else{
        $error = "Failed to add New Category";
      }
    }
  }
}

if (isset($_POST['update'])) {
  $category_name = mysqli_real_escape_string($connection,strtolower($_POST['category_name']));
  if (empty($category_name)) {
    $update_error = "Please add category name";
  }
  else{
    $check_query = "SELECT * FROM categories WHERE category = '$category_name'";
    $check_run = mysqli_query($connection,$check_query);
    if (mysqli_num_rows($check_run) > 0) {
      $update_error = "Category name already exits";
    }
    else{
      $update_query = "UPDATE `categories` SET `category`='$category_name' WHERE `id`='$edit_id'";
      if (mysqli_query($connection,$update_query)) {
        $update_msg = "Category name updated";
      }
      else{
        $update_error = "Failed to update Category Name";
      }
    }
  }
}
?>
  </head>
  <body>
    <div id="wrapper">
      <?php require_once('include/header.php'); ?>

      <div class="container-fluid body-section">
        <div class="row">
          <div class="col-md-3">
            <?php require_once('include/left_sidebar.php'); ?>
          </div>
          <div class="col-md-9">
            <h1><i class="fa fa-folder-open" aria-hidden="true"></i> Categories <small>Different Categories</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-folder-open"></i> Categories</li>
            </ol>

            <div class="row">
              <div class="col-md-6">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="category">Category Name:</label>
                    <?php 
                      if (isset($msg)) {
                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                      }
                      elseif (isset($error)) {
                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                      }
                    ?>
                    <input type="text" placeholder="Category Name" class="form-control" name="category_name">
                  </div>
                  <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                </form>

                <?php 
                  if (isset($_GET['edit'])) {
                    $edit_check_query = "SELECT * FROM categories WHERE id = $edit_id";
                    $edit_check_run = mysqli_query($connection,$edit_check_query);
                    if (mysqli_num_rows($edit_check_run) > 0 ) {
                      

                    $edit_row = mysqli_fetch_array($edit_check_run);
                      $update_category = $edit_row['category'];
                    
                ?>
                <hr>

                    <form action="" method="post">
                      <div class="form-group">
                        <label for="category">Update Category Name:</label>
                        <?php 
                          if (isset($update_msg)) {
                            echo "<span class='pull-right' style='color:green;'>$update_msg</span>";
                          }
                          elseif (isset($update_error)) {
                            echo "<span class='pull-right' style='color:red;'>$update_rror</span>";
                          }
                        ?>
                        <input type="text" value="<?php echo $update_category;?>" placeholder="Category Name" class="form-control" name="category_name">
                      </div>
                      <input type="submit" value="Update Category" name="update" class="btn btn-primary">
                    </form>
                  <?php
                      }
                  }
                  ?>
              </div>
               
              <div class="col-md-6"><br>
                    <?php
                    $get_query = "SELECT * FROM categories";
                    $get_run = mysqli_query($connection,$get_query);
                    if (mysqli_num_rows($get_run) > 0) {
                      if (isset($del_msg)) {
                        echo "<span class='pull-right' style='color:green;'>$del_msg</span>";
                      }
                      elseif (isset($del_error)) {
                        echo "<span class='pull-right' style='color:red;'>$del_error</span>";
                      }
                    ?>
                    <table class="table table-hover table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Sr #</th>
                          <th>Category Name</th>
                          <th>Posts</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($get_row = mysqli_fetch_array($get_run)) {
                          $category_id = $get_row['id'];
                          $category_name = $get_row['category'];
                        ?>
                        <tr>
                          <td><?php echo $category_id;?></td>
                          <td><?php echo ucfirst($category_name);?></td>
                          <td>12</td>
                          <td><a href="categories.php?edit=<?php echo $category_id;?>"><i class="fa fa-pencil"></i></a></td>
                          <td><a href="categories.php?delete=<?php echo $category_id;?>"><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php 
                        } 
                      ?>
                      </tbody>
                    </table>
                <?php
                  }
                  else{
                    echo "<center><h3>No Categories Found</h3></center>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php require_once('include/footer.php'); ?>