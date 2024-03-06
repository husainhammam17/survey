<?php include "includes/header.php" ?>

<!-- Navbar -->
<?php include "includes/navigation.php" ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include "includes/sidebar.php" ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <!-- Page Content -->
      <h2>Admin Panel</h2>
      <hr>

      <!-- /.row -->
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <i class="fas fa-file-alt fa-5x"></i>
                </div>
                <div class="col-sm-9 text-right">

                  <div>Posts</div>
                </div>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="posts.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-sm-9 text-right">

                  <div>Comments</div>
                </div>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="comments.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-sm-9 text-right">

                  <div> Users</div>
                </div>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="users.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-sm-9 text-right">

                  <div>Categories</div>
                </div>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="category.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- /.row -->


      <?php

      $query = "SELECT * FROM users WHERE user_role = 'Surveyor' ";
      $select_all_surveyors = mysqli_query($connection, $query);
      $surveyor_count = mysqli_num_rows($select_all_surveyors);

      ?>


      <div class="row">
        <script type="text/javascript">
          google.charts.load('current', {
            'packages': ['bar']
          });
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data', 'Count'],

              <?php
              $element_text = ['All Posts', 'Active Posts', 'Draft Post', 'Comments', 'Hide Comments', 'Users', 'Surveyor', 'Categories'];
              $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $hide_comments_count, $user_count, $surveyor_count, $category_count];
              for ($i = 0; $i < 8; $i++) {
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
              }
              ?>

            ]);
            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>
        <div class="ml-3 mt-4 mr-3" id="columnchart_material" style="width: 1400px; height: 500px;"></div>

      </div>



    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php" ?>