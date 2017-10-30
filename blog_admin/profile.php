<?php 
require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
$session_username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$session_username'";
$run = mysqli_query($connection,$query);
$row = mysqli_fetch_array($run);

$image = $row['image'];
$id = $row['id'];
$date = getdate($row['date']);
$day = $date['mday'];
$month = substr($date['month'],0,3);
$year = $date['year'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$username = $row['username'];
$email = $row['email'];
$role = $row['role'];
$details = $row['details'];
?>
  </head>
  <body id="profile">
    <div id="wrapper">
      <?php require_once('include/header.php');  ?>
      <div class="container-fluid body-section">
        <div class="row">
          <div class="col-md-3">
            <?php require_once('include/left_sidebar.php'); ?>
          </div>
          <div class="col-md-9">
            <h1><i class="fa fa-user" aria-hidden="true"></i> Profile <small>Personal Details</small></h1><hr>
            <ol class="breadcrumb">
              <li class="active"><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
              <li><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
            </ol>
            <div class="row">
              <div class="col-xs-12">
                <center><img src="images/<?php echo $image;?>" width="200px" class="img-circle img-thumbnail" id="profile-image"></center><br>
                <a href="edit-profile.php?edit=<?php echo $id;?>" class="btn btn-primary pull-right"> Edit Profile</a><br><br>
                <center>
                  <h3>Profile Details</h3>
                </center>

                <br>

                <table class="table table-bordered">
                  <tr>
                    <td width="20%"><b>User ID:</b></td>
                    <td width="30%"><?php echo $id;?></td>
                    <td width="20%"><b>SignUp Date:</b></td>
                    <td width="30%"><?php echo "$day $month $year";?></td>
                  </tr>
                  <tr>
                    <td width="20%"><b>First Name:</b></td>
                    <td width="30%"><?php echo $first_name;?></td>
                    <td width="20%"><b>Last Name:</b></td>
                    <td width="30%"><?php echo $last_name;?></td>
                  </tr>
                  <tr>
                    <td width="20%"><b>Username:</b></td>
                    <td width="30%"><?php echo $username;?></td>
                    <td width="20%"><b>Email:</b></td>
                    <td width="30%"><?php echo $email;?></td>
                  </tr>
                  <tr>
                    <td width="20%"><b>Role:</b></td>
                    <td width="30%"><?php echo $role;?></td>
                    <td width="20%"><b></b></td>
                    <td width="30%"></td>
                  </tr>
                </table>
                <div class="row">
                  <div class="col-lg-8 col-sm-12">
                    <b>Details:</b>
                    <div> <?php echo $details;?></div>
                  </div>
                </div><br>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php require_once('include/footer.php');  ?>