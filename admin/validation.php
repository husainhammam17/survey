<?php include "includes/header.php" ?>

<!-- Navbar -->
<?php include "includes/navigation.php" ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include "includes/sidebar.php" ?>

  <div id="content-wrapper">

    <div class="container-fluid">
      <!-- Page Content -->
      <?php

      if (isset($_GET['source'])) {
        $source = $_GET['source'];
      } else {
        $source = '';
      }

      switch ($source) {
        case 'pasar_bandar';
          include "includes/pasar_bandar.php";
          break;

        case 'pasar_pahing';
          include "includes/pasar_pahing.php";
          break;

        case 'pasar_setonobetek';
          include "includes/pasar_setonobetek.php";
          break;
      }

      ?>

      <?php

      if (isset($_GET['source'])) {
        $source = $_GET['source'];
      } else {
        $source = '';
      }

      switch ($source) {
        case 'edit_bandar';
          include "includes/edit_bandar.php";
          break;

        case 'edit_pahing';
          include "includes/edit_pahing.php";
          break;

        case 'edit_setonobetek';
          include "includes/edit_setonobetek.php";
          break;
      }

      ?>

      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php include "includes/footer.php" ?>