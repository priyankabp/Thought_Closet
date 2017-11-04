<?php require_once('include/top.php'); ?>
<?php
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
elseif (isset($_SESSION['username']) && $_SESSION['role'] =='author'){
  header('Location: index.php');
}
  # Delete User functionality
  if (isset($_GET['delete'])) {
    # Get the id of the user to be deleted
    $delete_id = $_GET['delete'];
    $delete_check_query = "SELECT * FROM users WHERE id = $delete_id";
    $delete_check_run = mysqli_query($connection,$delete_check_query);
    if (mysqli_num_rows($delete_check_run) > 0) {
      # Delete query to delete the user
      $delete_query = "DELETE FROM `users` WHERE `id`= $delete_id;";
      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if (mysqli_query($connection,$delete_query)) {
          $msg = "User has been deleted";
        }
        else{
          $error = "User has not been deleted";
        }
      }
    }
    else{
      header('Location: index.php');
    }
  }

  #Bulk options functionality
  if (isset($_POST['checkboxes'])) {
    foreach ($_POST['checkboxes'] as $user_id) {
      $bulk_option = $_POST['bulk-options'];
      if ($bulk_option == 'delete') {
        $bulk_delete_query = "DELETE FROM `users` WHERE `id`= $user_id;";
        mysqli_query($connection,$bulk_delete_query);
      }
      elseif ($bulk_option == 'author') {
        $bulk_author_query = "UPDATE `users` SET `role`='author' WHERE `id`= $user_id";
        mysqli_query($connection,$bulk_author_query);
      }
      elseif ($bulk_option == 'admin') {
        $bulk_admin_query = "UPDATE `users` SET `role`='admin' WHERE `id`= $user_id";
        mysqli_query($connection,$bulk_admin_query);
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
            <h1><i class="fa fa-users" aria-hidden="true"></i> Users <small>View All Users</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-users"></i> Users</li>
            </ol>


            <?php
              $query = "SELECT * FROM users ORDER BY id DESC";
              $run = mysqli_query($connection,$query);
              if (mysqli_num_rows($run) > 0) {
              
            ?>
            <form action="" method="post">
            <div class="row">
              <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="form-group">
                        <select name="bulk-options" id="" class="form-control">
                          <option value="delete">Delete</option>
                          <option value="author">Change to author</option>
                          <option value="admin">Change to admin</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-xs-8">
                      <input type="submit" name="" class="btn btn-success" value="Apply">
                      <a href="add-user.php" class="btn btn-primary">Add New</a>
                    </div>
                  </div>
              </div>
            </div>


            <!-- Displaying message for the admin if the user is deleted or not-->
            <?php
              if (isset($error)) {
                echo "<span style='color:red;' class='pull-right'>$error</span>";
              }
              elseif (isset($msg)) {
                echo "<span style='color:green;' class='pull-right'>$msg</span>";
              }
            ?>

            <!-- Displaying the rigistered user in tabular format -->
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectallcheckboxes"></th>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  # Reading all the users data from the database and storing each parameter in a variable
                  while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $first_name = ucfirst($row['first_name']);
                    $last_name = ucfirst($row['last_name']);
                    $email = $row['email'];
                    $username = $row['username'];
                    $role = ucfirst($row['role']);
                    $image = $row['image'];
                    $date = getdate($row['date']);
                    $day = $date['mday'];
                    $month = substr($date['month'], 0,3);
                    $year = $date['year'];

                ?>
                <tr>
                  <!-- Displaying users dynamically from database -->
                  <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                  <td><?php echo $id;?></td>
                  <td><?php echo "$day $month $year";?></td>
                  <td><?php echo "$first_name $last_name";?></td>
                  <td><?php echo $username;?></td>
                  <td><?php echo $email;?></td>
                  <td><img src="images/<?php echo $image;?>" width="30px"></td>
                  <td>********</td>
                  <td><?php echo $role;?></td>
                  <td><a href="edit-user.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="users.php?delete=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>

            <?php
              
              # Message to be displayed when no users are available in the database

              }
              else{
                echo "<center><h2>No Users Avaliable </h2></center>";
              }
            ?>
            </form>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>