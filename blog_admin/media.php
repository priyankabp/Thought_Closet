<?php 
require_once('include/top.php'); 
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
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
            <h1><i class="fa fa-database" aria-hidden="true"></i> Media <small>Add / View Media Files</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-database" aria-hidden="true"></i> Media</li>
            </ol>

            <?php 
              if (isset($_POST['submit'])) {
                mkdir("media");
                if (count($_FILES['media']['name'])>0) {
                  for ($i=0; $i < count($_FILES['media']['name']); $i++) { 
                    $image = $_FILES['media']['name'][$i];
                    $tmp_name = $_FILES['media']['tmp_name'][$i];
                    $query = "INSERT INTO `media` (`image`) VALUES ('$image')";
                    if(mysqli_query($connection,$query)){
                      $path = "media/$image";
                      if(move_uploaded_file($tmp_name,$path)){
                        copy($path, "../$path");
                      }
                    }
                  }
                }
              }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-4 col-xs-8">
                  <input type="file" name="media[]" required multiple>
                </div>
                <div class="col-sm-4 col-xs-4">
                  <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Media">
                </div>
              </div>
            </form><hr>

            <div class="row">
              <?php 
               $get_query = "SELECT * FROM media ORDER BY id DESC";
               $get_run = mysqli_query($connection,$get_query);
               if (mysqli_num_rows($get_run)>0) {
                  while ($get_row = mysqli_fetch_array($get_run)) {
                    $get_image = $get_row['image'];
                 
              ?>
              <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
                <a href="media/<?php echo $get_image;?>" class="thumbnail">
                  <img src="media/<?php echo $get_image;?>" width="100%" alt="">
                </a>
              </div>
              <?php
                  }
                }
               else{
                echo "<center><h2>No Media Files available</h2></center>";
               }
              ?>
            </div>

          </div>
        </div>
      </div>

  <?php require_once('include/footer.php');  ?>