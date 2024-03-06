<?php include("../includes/db.php"); ?>

<?php
// fungsi selisih
function calculatePriceDifference($harga_lama, $harga_baru)
{
    // Check if both values are numeric before performing the subtraction
    if (is_numeric($harga_lama) && is_numeric($harga_baru)) {
        return $harga_baru - $harga_lama;
    } else {
        // Handle the case where either or both values are not numeric
        return "Invalid input. Please enter numeric values.";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $tanggal = $_POST['tanggal'];
    $barang = $_POST['barang'];
    // $harga_lama = $_POST['harga_lama']);
    $harga_baru = $_POST['harga_baru'];
    $lokasi = $_POST['lokasi'];
    $jumlah_input = count($barang, $harga_baru);

    // Calculate price difference
    $selisih = calculatePriceDifference($harga_lama, $harga_baru);

    // Insert data into the database
    for ($x = 0; $x < $jumlah_input; $x++) {
        $sql = "INSERT INTO data_barang (tanggal, nama_barang, harga_lama, harga_baru, selisih, lokasi) VALUES ('$tanggal', '$barang[$x]', '$harga_lama', '$harga_baru[$x]', '$selisih', '$lokasi')";
    }
    if ($connection->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data Berhasil Ditambahkan";
        header("Location: survey.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close connection
$connection->close();
