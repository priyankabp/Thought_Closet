<?php require_once('include/top.php'); ?>
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
              <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-users"></i> Users</li>
            </ol>


            <?php
              $query = "SELECT * FROM users ORDER BY id DESC";
              $run = mysqli_query($connection,$query);
              if (mysqli_num_rows($run) > 0) {
              
            ?>
            <div class="row">
              <div class="col-sm-8">
                <form action="">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="form-group">
                        <select name="" id="" class="form-control">
                          <option value="delete">Delete</option>
                          <option value="author">Change to author</option>
                          <option value="author">Change to admin</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-xs-8">
                      <input type="submit" name="" class="btn btn-success" value="Apply">
                      <a href="#" class="btn btn-primary">Add New</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox"></th>
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
                  <td><input type="checkbox"></td>
                  <td><?php echo $id;?></td>
                  <td><?php echo "$day $month $year";?></td>
                  <td><?php echo "$first_name $last_name";?></td>
                  <td><?php echo $username;?></td>
                  <td><?php echo $email;?></td>
                  <td><img src="images/<?php echo $image;?>" width="30px"></td>
                  <td>********</td>
                  <td><?php echo $role;?></td>
                  <td><a href="add-user.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="users.php?delete=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>

            <?php
              }
              else{
                echo "<center><h2>No Users Avaliable </h2></center>";
              }
            ?>

          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>