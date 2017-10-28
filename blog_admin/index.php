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
            <h1><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <small>Statics Overview</small></h1><hr>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
            </ol>

            <!--Items Box Open-->
            <div class="row tag-boxes">

              <!--Comment Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge">11</div>
                        <div class="text-right">New Comments</div>
                      </div>
                    </div>
                  </div>
                  <a href="#">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Comments</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Comment Box Close-->

              <!--Post Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-red">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge">18</div>
                        <div class="text-right">All Posts</div>
                      </div>
                    </div>
                  </div>
                  <a href="#">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Posts</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Post Box Close-->

              <!--Users Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-yellow">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge">30</div>
                        <div class="text-right">All Users</div>
                      </div>
                    </div>
                  </div>
                  <a href="#">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Users</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Users Box Close-->

              <!--Categories Box Open-->
              <div class="col-md-6 col-lg-3">
                <div class="panel panel-green">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-folder-open fa-5x"></i>
                      </div>
                      <div class="col-xs-9">
                        <div class="text-right huge">9</div>
                        <div class="text-right">All Categories</div>
                      </div>
                    </div>
                  </div>
                  <a href="#">
                    <div class="panel-footer">
                      <span class="pull-left"> View All Categories</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
              </div><!--Categories Box Close-->
            </div><hr><!-- Items Box Close -->

            <h3>New Users</h3>
            <table class="table table-hover table-stripped">
              <thead>
                <tr>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>Admin</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>Admin</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>Admin</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>Admin</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>Priyanka</td>
                  <td>priyanka</td>
                  <td>Admin</td>
                </tr>
              </tbody>
            </table>
            <a href="#" class="btn btn-primary">View All Users</a>
            <h3>New Posts</h3>
            <table class="table">
              <thead>
                <tr>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Post Title</th>
                  <th>Category</th>
                  <th>Views</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>This demo heading for post one...</td>
                  <td>Tutorial</td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> 28</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>This demo heading for post one...</td>
                  <td>Tutorial</td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> 28</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>This demo heading for post one...</td>
                  <td>Tutorial</td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> 28</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>This demo heading for post one...</td>
                  <td>Tutorial</td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> 28</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td> 13 Oct 2017</td>
                  <td>This demo heading for post one...</td>
                  <td>Tutorial</td>
                  <td><i class="fa fa-eye" aria-hidden="true"></i> 28</td>
                </tr>
              </tbody>
            </table>
            <a href="#" class="btn btn-primary">View All Posts</a>
          </div>
        </div>
      </div>

  <?php require_once('include/footer.php');  ?>