<?php include "includes/header.php" ?>

<!-- Navbar -->
<?php include "includes/navigation.php" ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include "includes/sidebar.php" ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php

            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = '';
            }

            switch ($source) {
                case 'grafik_bandar';
                    include "includes/grafik_bandar.php";
                    break;

                case 'grafik_pahing';
                    include "includes/grafik_pahing.php";
                    break;

                case 'grafik_setonobetek';
                    include "includes/grafik_setonobetek.php";
                    break;
            }

            ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php" ?>