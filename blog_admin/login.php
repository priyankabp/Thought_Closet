<?php
require_once('../include/db.php');
ob_start();
session_start();

  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection,strtolower($_POST['username']));
    $password = mysqli_real_escape_string($connection,$_POST['password']);

    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_run = mysqli_query($connection, $check_username_query);

    if (mysqli_num_rows($check_username_run) > 0) {
      $row = mysqli_fetch_array($check_username_run);

      $db_username = $row['username'];
      $db_password = $row['password'];
      $db_role = $row['role'];
      $db_author_image = $row['image'];

      $password = crypt($password, $db_password);
      echo "$password";

      if ($username == $db_username) {
        header('Location: index.php');
        $_SESSION['username'] = $db_username;
        $_SESSION['role'] = $db_role;
        $_SESSION['author_image'] = $db_author_image;
      }
      else{
        $error = "You dont have access to this page";
      }
    }
    else{
      $error = "Username and password combination does not exit";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png">

    <title>Login | Thought Closet</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Text animation -->
    <link href="css/animated.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin animated shake" action="" method="post">
        <h2 class="form-signin-heading">Thought Closet Sign In</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <?php
            if (isset($error)) {
             echo "$error";
            }
            ?>
          </label>
        </div>
        <input type="submit" name="submit" value="Sign In" class="btn btn-lg btn-primary btn-block">
      </form>

    </div> <!-- /container -->
  </body>
</html>