<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-__-</title>
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/check.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- <link rel="icon" type="png/jpg" href="asets/dp1.png" /> -->

    <style>
        .container {
            border: 1px solid black;
            border-radius: 7px;
            margin-top: .5rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            padding-top: 1rem;
        }

        .btn-search {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-search .btn {
            background-color: #0d6efd;
            color: white;
        }
    </style>

</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'data_survey');

    $sql = "SELECT DISTINCT
                data_barang_pahing.nama_barang,
                data_barang_pahing.tanggal,
                data_barang_pahing.harga_sekarang
            FROM
                data_barang_pahing
            ORDER BY
                nama_barang, tanggal";

    $result = mysqli_query($conn, $sql);
    ?>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'data_survey');

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    ?>
    <!-- feed ig -->

    <?php
    echo "<tr><td colspan='2' class='selected-item'>Jumlah item yang dipilih: <span id='selected-count'>0</span></td></tr>";
    ?>
    <div class="container">
        <form method="post" action="category.php">
            <table>
                <tr>
                    <?php
                    $query_checkbox = "SELECT DISTINCT nama_barang FROM data_barang_pahing";
                    $result_checkbox = $conn->query($query_checkbox);

                    if ($result_checkbox->num_rows > 0) {
                        echo "<tr><th><label><input type='checkbox' id='select-all'> Select All</label></th></tr>";
                        while ($row_checkbox = $result_checkbox->fetch_assoc()) {
                            $field_data = $row_checkbox['nama_barang'];
                            echo "<tr><label><input type='checkbox' name='filter[]' value='$field_data'> $field_data</label></tr>";
                        }
                    } else {
                        echo "Tidak ada data untuk ditampilkan.";
                    }
                    ?>
                    <br>
                    <script>
                        // fungsi select all
                        document.getElementById('select-all').addEventListener('change', function() {
                            var checkboxes = document.querySelectorAll("input[name='filter[]']");
                            checkboxes.forEach(function(checkbox) {
                                checkbox.checked = document.getElementById('select-all').checked;
                            });
                            updateSelectedCount();
                        });

                        // fungsi check box
                        var checkboxes = document.querySelectorAll("input[name='filter[]']");
                        checkboxes.forEach(function(checkbox) {
                            checkbox.addEventListener('change', function() {
                                updateSelectedCount();
                            });
                        });

                        // fungsi count select
                        function updateSelectedCount() {
                            var selectedCheckboxes = document.querySelectorAll("input[name='filter[]']:checked");
                            document.getElementById('selected-count').innerText = selectedCheckboxes.length;
                        }
                    </script>
            </table>
            <button type="submit" value="Filter" class="button blob btn-primary btn">
                <span>Filter</span>
            </button>
        </form>
    </div>

    <div class="container-filter">
        <!-- fiilter untuk rentang tanggal -->
        <h2 class="d-flex justify-content-center">Data Tabel Harga Barang</h2>
        <form action="grafik_tabel.php" method="get" class="p-auto m-2 d-flex justify-content-center">
            <div class="border border-3 border-dark rounded-3 mx-1 row gx-5 d-flex justify-content-center ">
                <div class="col-6">
                    <label class="col-2"><strong>Periode</strong></label>
                    <input type="date" class="form-control" name="dari" required>
                </div>
                <div class="col-6">
                    <label class="col-2"><strong>hingga</strong></label>
                    <input type="date" class="form-control" name="ke" required>
                </div>
                <div class="btn-search">
                    <button class="btn" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <!-- table  -->
    <div class="p-5 table-responsive">
        <table class="table table-bordered border-dark">
            <tr>
                <thead>
                    <th class="bg-primary text-white">No</th>
                    <th class="bg-primary text-white">Tanggal Transaksi</th>
                    <th class="bg-primary text-white">Komoditas</th>
                    <th class="bg-primary text-white">Harga Kemarin</th>
                    <th class="bg-primary text-white">Harga Hari ini</th>
                    <th class="bg-primary text-white">Pasar</th>
                </thead>
            </tr>
            <!-- logika filter pasar -->

            <!-- logika filter tanggal -->
            <?php
            $selisih = "SELECT harga_kemarin, harga_sekarang FROM data_barang_pahing";

            // Check if both 'dari' and 'ke' parameters are set
            if (isset($_GET['dari']) && isset($_GET['ke'])) {
                // Display data within the specified date range
                $data = mysqli_query($conn, "SELECT * FROM data_barang_pahing WHERE tanggal BETWEEN '" . $_GET['dari'] . "' AND '" . $_GET['ke'] . "' ORDER BY tanggal DESC LIMIT 42");
            } else {
                // If no date range is specified, display the latest data
                $data = mysqli_query($conn, "SELECT * FROM data_barang_pahing ORDER BY tanggal DESC LIMIT 42");
            }

            // Check if 'lokasi' parameter is set
            if (isset($_GET['lokasi'])) {
                // Filter data based on the specified location
                $data = mysqli_query($conn, "SELECT * FROM data_barang_pahing WHERE lokasi = '" . $_GET['lokasi'] . "' ORDER BY tanggal DESC LIMIT 42");
            }

            // Counter for numbering
            $no = 1;

            // Loop through the data
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['tanggal']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td> Rp. <?php echo $d['harga_kemarin']; ?></td>
                    <td> Rp. <?php echo $d['harga_sekarang']; ?></td>
                    <td><?php echo $d['lokasi']; ?></td>
                </tr>
            <?php } ?>


        </table>
    </div>
</body>

</html>