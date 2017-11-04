<?php require_once('include/top.php'); ?>
<?php
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
elseif (isset($_SESSION['username']) && $_SESSION['role'] =='author'){
  header('Location: index.php');
}

#session username
$session_username = $_SESSION['username'];

  # Delete Comments functionality
  if (isset($_GET['delete'])) {
    # Get the id of the comment to be deleted
    $delete_id = $_GET['delete'];
    $delete_check_query = "SELECT * FROM comments WHERE id = $delete_id";
    $delete_check_run = mysqli_query($connection,$delete_check_query);
    if (mysqli_num_rows($delete_check_run) > 0) {
      # Delete query to delete the comment
      $delete_query = "DELETE FROM `comments` WHERE `id`= $delete_id;";
      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if (mysqli_query($connection,$delete_query)) {
          $msg = "Comment has been deleted";
        }
        else{
          $error = "Comment has not been deleted";
        }
      }
    }
    else{
      header('Location: index.php');
    }
  }

  # Approve Comments functionality
  if (isset($_GET['approve'])) {
    # Get the id of the comment to be approved
    $approve_id = $_GET['approve'];
    $approve_check_query = "SELECT * FROM comments WHERE id = $approve_id";
    $approve_check_run = mysqli_query($connection,$approve_check_query);
    if (mysqli_num_rows($approve_check_run) > 0) {
      # Update query to approve the comment
      $approve_query = "UPDATE `comments` SET `status`='approve' WHERE `id`= $approve_id";
      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if (mysqli_query($connection,$approve_query)) {
          $msg = "Comment has been approved";
        }
        else{
          $error = "Comment has not been approved";
        }
      }
    }
    else{
      header('Location: index.php');
    }
  }

  # UnApprove Comments functionality
  if (isset($_GET['unapprove'])) {
    # Get the id of the comment to be approved
    $unapprove_id = $_GET['unapprove'];
    $unapprove_check_query = "SELECT * FROM comments WHERE id = $unapprove_id";
    $unapprove_check_run = mysqli_query($connection,$unapprove_check_query);
    if (mysqli_num_rows($unapprove_check_run) > 0) {
      # Update query to unapprove the comment
      $unapprove_query = "UPDATE `comments` SET `status`='pending' WHERE `id`= $unapprove_id";
      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if (mysqli_query($connection,$unapprove_query)) {
          $msg = "Comment has been Unapproved";
        }
        else{
          $error = "Comment has not been Unapproved";
        }
      }
    }
    else{
      header('Location: index.php');
    }
  }

  #Bulk status change functionality
  if (isset($_POST['checkboxes'])) {
    foreach ($_POST['checkboxes'] as $user_id) {
      $bulk_option = $_POST['bulk-options'];
      if ($bulk_option == 'delete') {
        $bulk_delete_query = "DELETE FROM `comments` WHERE `id`= $user_id;";
        mysqli_query($connection,$bulk_delete_query);
      }
      elseif ($bulk_option == 'approve') {
        $bulk_author_query = "UPDATE `comments` SET `status`='approve' WHERE `id`= $user_id";
        mysqli_query($connection,$bulk_author_query);
      }
      elseif ($bulk_option == 'pending') {
        $bulk_admin_query = "UPDATE `comments` SET `status`='pending' WHERE `id`= $user_id";
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
            <h1><i class="fa fa-comments" aria-hidden="true"></i> Comments <small>View All Comments</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-comments"></i> Comments</li>
            </ol>

            <?php
            if (isset($_GET['reply'])) {
              $reply_id = $_GET['reply'];
              $reply_check = "SELECT * FROM comments WHERE post_id = $reply_id";
              $reply_check_run = mysqli_query($connection,$reply_check);
              if (mysqli_num_rows($reply_check_run)>0) {
                if (isset($_POST['reply'])) {
                  $comment_data = $_POST['comment'];
                  if (empty($comment_data)) {
                    $comment_error = "Must Fill this field";
                  }
                  else{
                    $get_user_data = "SELECT * FROM users WHERE username = '$session_username'";
                    $get_user_run = mysqli_query($connection,$get_user_data);
                    $get_user_row = mysqli_fetch_array($get_user_run);
                    $date = time();
                    $first_name = $get_user_row['first_name'];
                    $last_name = $get_user_row['last_name'];
                    $full_name = "$first_name $last_name";
                    $email = $get_user_row['email'];
                    $image = $get_user_row['image'];

                    $insert_comment_query = "INSERT INTO `comments` (`date`,`name`,`username`,`post_id`,`email`,`image`,`comment`,`status`) VALUES ('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve')";

                    if (mysqli_query($connection,$insert_comment_query)) {
                      $comment_msg = "Comment has been submitted";
                      header('Location: comments.php');

                    }
                    else{
                      $comment_error = "Comment has not been submitted";
                    }
                  }
                }
            ?>
            <!-- Add new comment/ Reply to existing post -->
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="comment"> Comment:*</label>
                    <?php
                      if (isset($comment_error)) {
                        echo "<span class='pull-right' style='color:red;'>$comment_error</span>";
                      }
                      else if (isset($comment_msg)) {
                        echo "<span class='pull-right' style='color:green;'>$comment_msg</span>";
                      }
                    ?>
                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Please enter your comment here" class="form-control"></textarea>
                  </div>
                  <input type="submit" name="reply" class="btn btn-primary">
                </form>
              </div>
            </div>
            <hr>

            <?php
             }
            }
              $query = "SELECT * FROM comments ORDER BY id DESC";
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
                          <option value="approve">Approve</option>
                          <option value="pending">UnApprove</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-xs-8">
                      <input type="submit" name="" class="btn btn-success" value="Apply">
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
                  <th>Username</th>
                  <th>Comment</th>
                  <th>Status</th>
                  <th>Approve</th>
                  <th>UnApprove</th>
                  <th>Reply</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  # Reading all the users data from the database and storing each parameter in a variable
                  while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $status = $row['status'];
                    $comment = $row['comment'];
                    $post_id = $row['post_id'];
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
                  <td><?php echo $username;?></td>
                  <td><?php echo $comment;?></td>
                  <td><span style="color:<?php if ($status == 'approve') {echo 'green';}else if($status == 'pending'){echo "red";}?>;"><?php echo ucfirst($status);?></span>
                  </td>
                  <td><a href="comments.php?approve=<?php echo $id;?>">Approve</a></td>
                  <td><a href="comments.php?unapprove=<?php echo $id;?>">Upapprove</a></td>
                  <td><a href="comments.php?reply=<?php echo $post_id;?>"><i class="fa fa-reply" aria-hidden="true"></i></a></td>
                  <td><a href="comments.php?delete=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>

            <?php
              
              # Message to be displayed when no comments are available in the database

              }
              else{
                echo "<center><h2>No Comments Avaliable </h2></center>";
              }
            ?>
            </form>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>