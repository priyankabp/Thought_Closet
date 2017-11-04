<?php require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

$session_username = $_SESSION['username'];

if (isset($_GET['edit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    $edit_id = $_GET['edit'];
    $edit_query = "SELECT * FROM users WHERE id = $edit_id";
    $edit_query_run = mysqli_query($connection,$edit_query);
    if (mysqli_num_rows($edit_query_run) > 0) {
      $edit_row = mysqli_fetch_array($edit_query_run);
      $e_username = $edit_row['username'];
      if ($e_username == $session_username) {
        $e_firstname = $edit_row['first_name'];
        $e_lastname = $edit_row['last_name'];
        $e_image = $edit_row['image'];
        $e_details = $edit_row['details'];
      }
      else{
        header("location: index.php");
      }
    }
    else{
      header("location: index.php");
    }
}
else{
    header("location: index.php");
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
            <h1><i class="fa fa-user" aria-hidden="true"></i> Edit Profile <small>Edit Profile Details</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-user-plus"></i> Edit Profile</li>
            </ol>

            <?php
              if (isset($_POST['submit'])) {
                $first_name = mysqli_real_escape_string($connection,$_POST['first-name']);
                $last_name = mysqli_real_escape_string($connection,$_POST['last-name']);
                $password = mysqli_real_escape_string($connection,$_POST['password']);
                $profile_image = $_FILES['profile-image']['name'];
                $profile_image_tmp = $_FILES['profile-image']['tmp_name'];
                $details= mysqli_real_escape_string($connection,$_POST['details']);

                if (empty($profile_image)) {
                  $profile_image = $e_image;
                }

                # Encrypting password
                $salt_query = "SELECT * from users ORDER BY id DESC LIMIT 1";
                $salt_run = mysqli_query($connection,$salt_query);
                $salt_row = mysqli_fetch_array($salt_run);
                $salt = $salt_row['salt'];
                $insert_password = crypt($password,$salt);

                if (empty($first_name) or empty($last_name) or empty($profile_image)) {
                  $error = "All (*) fields are Required";
                }
                else{
                  $update_query = "UPDATE `users` SET `first_name`='$first_name', `last_name`='$last_name', `image`='$profile_image', `details`='$details'";
                  if (isset($passowrd)) {
                    $update_query .= ",`passowrd` = $insert_password";
                  }
                  $update_query .= " WHERE `users`.`id` = $edit_id";
                  if (mysqli_query($connection,$update_query)) {
                    $msg = "User has been updated";
                    header("refresh:0; url=edit-profile.php?edit=$edit_id");

                    if (!empty($profile_image)) {
                      move_uploaded_file($profile_image_tmp, "images/$profile_image");
                    }
                  }
                  else{
                    $error = "User has not been updated";
                  }
                }
              }
            ?>
            <div class="row">
              <div class="col-md-8">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="first-name">First Name:*</label>
                    <?php 
                      if (isset($error)) {
                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                      }
                      elseif (isset($msg)) {
                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                      }
                    ?>
                    <input type="text" id="first-name" name="first-name" class="form-control" value="<?php echo $e_firstname;?>" placeholder="First Name">
                  </div>

                  <div class="form-group">
                    <label for="last-name">Last Name:*</label>
                    <input type="text" id="last-name" name="last-name" class="form-control" value="<?php echo $e_lastname;?>" placeholder="Last Name">
                  </div>

                  <div class="form-group">
                    <label for="password">Password:*</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                  </div>

                  <div class="form-group">
                    <label for="profile-image">Profile Picture:*</label>
                    <input type="file" id="profile-image" name="profile-image" >
                  </div>

                  <div class="form-group">
                    <label for="details">Details:*</label>
                    <textarea name="details" id="details" cols="30" rows="10" class="form-control"><?php echo $e_details;?></textarea>
                  </div>

                  <input type="submit" name="submit" value="Update User" class="btn btn-primary">
                </form>
              </div>
              <div class="col-md-4">
                <?php
                #TODO: image not displayed - Bug fixing
                    echo "<img src='images/$e_image' width='100%'>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>