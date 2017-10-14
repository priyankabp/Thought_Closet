hemml<?php require_once('include/top.php'); ?>
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
                  <th>Posts</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>priya@gmail.com</td>
                  <td><img src="images/unknown-profile.png" width="30px"></td>
                  <td>abc</td>
                  <td>Admin</td>
                  <td>11</td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#"><i class="fa fa-times"></i></a></td>
                </tr>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>priya@gmail.com</td>
                  <td><img src="images/unknown-profile.png" width="30px"></td>
                  <td>abc</td>
                  <td>Admin</td>
                  <td>11</td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#"><i class="fa fa-times"></i></a></td>
                </tr>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>priya@gmail.com</td>
                  <td><img src="images/unknown-profile.png" width="30px"></td>
                  <td>abc</td>
                  <td>Admin</td>
                  <td>11</td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#"><i class="fa fa-times"></i></a></td>
                </tr>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>priya@gmail.com</td>
                  <td><img src="images/unknown-profile.png" width="30px"></td>
                  <td>abc</td>
                  <td>Admin</td>
                  <td>11</td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#"><i class="fa fa-times"></i></a></td>
                </tr>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>priya@gmail.com</td>
                  <td><img src="images/unknown-profile.png" width="30px"></td>
                  <td>abc</td>
                  <td>Admin</td>
                  <td>11</td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#"><i class="fa fa-times"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>