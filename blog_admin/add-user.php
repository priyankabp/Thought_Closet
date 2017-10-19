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
            <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Add Users <small>Add New User</small></h1><hr>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-user-plus"></i> Add New User</li>
            </ol>

            <div class="row">
              <div class="col-md-8">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="first-name">First Name:*</label>
                    <input type="text" id="first-name" name="first-name" class="form-control" placeholder="First Name">
                  </div>

                  <div class="form-group">
                    <label for="last-name">Last Name:*</label>
                    <input type="text" id="last-name" name="last-name" class="form-control" placeholder="Last Name">
                  </div>

                  <div class="form-group">
                    <label for="usernme">Username:*</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                  </div>

                  <div class="form-group">
                    <label for="email">Email:*</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email Address">
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
                    <input type="file" id="profile-image" name="profile-image">
                  </div>

                  <input type="submit" name="submit" value="Add User" class="btn btn-primary">
                </form>
              </div>
              <div class="col-md-4"></div>
            </div>
          </div>
        </div>
      </div>
<?php require_once('include/footer.php'); ?>