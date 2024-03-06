<?php include "includes/header.php" ?>

<!-- Navbar -->
<?php include "includes/navigation.php" ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include "includes/sidebar.php" ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <!-- Page Content -->
      <h2>Dashboard</h2>
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
                $element_text = ['All Posts', 'Active Posts', 'Draft Post', 'Comments', 'hide Comments'];
                $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $hide_comment_count];
                for ($i = 0; $i < 5; $i++) {
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
          <div class="ml-5 mt-5" id="columnchart_material" style="width: 1200px; height: 350px;"></div>

        </div>



      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php include "includes/footer.php" ?>