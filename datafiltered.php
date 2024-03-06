<?php
$conn = mysqli_connect('localhost', 'root', '', 'data_survey');

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['filter']) && !empty($_POST['filter'])) {
  $filter_values = $_POST['filter'];

  // Membuat string untuk klausa IN
  $in_clause = implode(",", array_map(function ($value) {
    return "'" . $value . "'";
  }, $filter_values));


  // Your SQL query
  $sql = "SELECT
            data_barang_bandar.nama_barang,
            data_barang_bandar.tanggal,
            data_barang_bandar.harga_sekarang
        FROM
            data_barang_bandar
        WHERE nama_barang IN ($in_clause)
        ORDER BY
            nama_barang, tanggal";

  // Execute the query
  $result = mysqli_query($conn, $sql);

  // Initialize arrays to store the grouped data
  $tanggal = array();
  $datasets = array();

  // Fetch and organize the data
  while ($row = mysqli_fetch_assoc($result)) {
    $productName = $row['nama_barang'];
    $date = $row['tanggal'];
    $price = $row['harga_sekarang'];

    // Add date to 'tanggal' array if not exists
    if (!in_array($date, $tanggal)) {
      $tanggal[] = $date;
    }

    // Add product to 'datasets' array if not exists
    if (!isset($datasets[$productName])) {
      $datasets[$productName] = array(
        'label' => $productName,
        'data' => array()
      );
    }

    // Add price entry for the product
    $datasets[$productName]['data'][] = $price;
  }

  // Close the database connection
  mysqli_close($conn);

  // Convert the PHP arrays to JSON
  $jsonData = json_encode(array(
    'tanggal' => $tanggal,
    'dataset' => array_values($datasets)
  ), JSON_PRETTY_PRINT);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Checklist</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/check.css" />
  <script src="js/jquery.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
  <!-- banner -->
  <div class="banner-container">
    <div class="banner">
      <img src="asets/dp1.png" alt="logo" style="height: 70px;" class="img-fluid border border-white rounded-3">
    </div>
  </div>
  <div class="container mt-5 mb-5">
    <button type="button" onclick="goBack()" class="btn btn-primary ms-auto button blob">Kembali</button>
    <canvas id="lineChart"></canvas>
  </div>

  <script>
    // Your JSON data here
    const jsonData = <?php echo $jsonData; ?>;

    // Prepare data for Chart.js
    const labels = jsonData.tanggal;
    const datasets = jsonData.dataset.map(dataset => ({
      label: dataset.label,
      data: dataset.data.map(value => parseInt(value, 10)), // Convert string to integer
      fill: false,
      borderColor: getRandomColor(), // Helper function to generate random color
    }));

    // Create Line Chart
    let delayed;
    const ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: datasets,
      },
      options: {
        raidus: 5,
        hitRadius: 100,
        hoverRadius: 10,
        interaction: {
          mode: 'index',
          intersect: false,
        },
        animation: {
          onComplete: () => {
            delayed = true;
          },
          delay: (context) => {
            let delay = 0;
            if (context.type === 'data' && context.mode === 'default' && !delayed) {
              delay = context.dataIndex * 80 + context.datasetIndex * 100;
            }
            return delay;
          },
        },
        layout: {
          padding: 20
        },
        legend: true,
        tension: 0.4,
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            ticks: {
              callback: function(value, index, values) {
                // Format nilai dengan menambahkan satuan Rupiah (IDR)
                return 'Rp. ' + value.toLocaleString('id-ID');
              }
            }
          }
        },
        x: {
          type: 'time',
          time: {
            unit: 'day'
          }
        }
      }
    });

    // Helper function to generate a random color
    function getRandomColor() {
      const letters = '0123456789ABCDEF';
      let color = '#';
      for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>