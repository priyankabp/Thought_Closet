<?php require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
elseif (isset($_SESSION['username']) && $_SESSION['role'] =='author'){
  header('Location: index.php');
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
            <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Add Users <small>Add New User</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-user-plus"></i> Add New User</li>
            </ol>

            <?php
              if (isset($_POST['submit'])) {
                $date = time();
                $first_name = mysqli_real_escape_string($connection,$_POST['first-name']);
                $last_name = mysqli_real_escape_string($connection,$_POST['last-name']);
                $username = mysqli_real_escape_string($connection,strtolower($_POST['username']));
                $username_trim = preg_replace("/\s+/",'', $username);
                $email = mysqli_real_escape_string($connection,strtolower($_POST['email']));
                $password = mysqli_real_escape_string($connection,$_POST['password']);
                $role = $_POST['role'];
                $profile_image = $_FILES['profile-image']['name'];
                $profile_image_tmp = $_FILES['profile-image']['tmp_name'];

                $check_query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
                $check_run = mysqli_query($connection,$check_query);

                # Encrypting password
                $salt_query = "SELECT * from users ORDER BY id DESC LIMIT 1";
                $salt_run = mysqli_query($connection,$salt_query);
                $salt_row = mysqli_fetch_array($salt_run);
                $salt = $salt_row['salt'];
                $password = crypt($password,$salt);

                if (empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($profile_image)) {
                  $error = "All (*) fields are Required";
                }
                else if($username != $username_trim){
                  $error = "Don't Use spaces in Username";
                }
                else if (mysqli_num_rows($check_run) > 0) {
                  $error = "Username or Email already exits";
                }
                else{
                  #Insert user into database

                  $insert_user_query = "INSERT INTO `users` (`date`, `first_name`, `last_name`, `username`, `email`, `image`, `passowrd`, `role`) VALUES ('$date', '$first_name', '$last_name', '$username', '$email', '$profile_image', '$password', '$role')";
                  if (mysqli_query($connection,$insert_user_query)) {
                    $msg = "New User Added";
                    move_uploaded_file($profile_image_tmp,"images/$image");
                    $image_check = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                    $image_run = mysqli_query($connection,$image_check);
                    $image_row = mysqli_fetch_array($image_run);
                    $check_image = $image_row['image'];

                    # Clearing all the fields of add-user after submit
                    $first_name="";
                    $last_name="";
                    $username="";
                    $email="";
                  }else{
                    echo "Error: " . $insert_user_query . "<br>" . $connection->error;
                    $error = "New User Not Added";
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
                    <input type="text" id="first-name" name="first-name" class="form-control" value="<?php if(isset($first_name)){echo $first_name;}?>" placeholder="First Name">
                  </div>

                  <div class="form-group">
                    <label for="last-name">Last Name:*</label>
                    <input type="text" id="last-name" name="last-name" class="form-control" value="<?php if(isset($last_name)){echo $last_name;}?>" placeholder="Last Name">
                  </div>

                  <div class="form-group">
                    <label for="usernme">Username:*</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php if(isset($username)){echo $username;}?>" placeholder="Username">
                  </div>

                  <div class="form-group">
                    <label for="email">Email:*</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" placeholder="Email Address">
                  </div>

                  <div class="form-group">
                    <label for="password">Password:*</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                  </div>

                  <div class="form-group">
                    <label for="Role">Role:*</label>
                    <select name="role" id="role" class="form-control">
                      <option value="author">Author</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="profile-image">Profile Picture:*</label>
                    <input type="file" id="profile-image" name="profile-image" >
                  </div>

                  <input type="submit" name="submit" value="Add User" class="btn btn-primary">
                </form>
              </div>
              <div class="col-md-4">
                <?php
                  if (isset($check_image)) {
                    echo "<img src='images/$check_image' width='100%'>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>