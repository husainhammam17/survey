<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "data_survey"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $tanggal = $_POST['tanggal'][0];
    $lokasi = $_POST['lokasi'][0];
    $barang = $_POST['barang'];
    $harga_sekarang = $_POST['harga_sekarang'];

    // tentukan tabel berdasarkan lokasi
    $tabel = ""; //variabel untuk menampung tabel

    // tentukan nama tabel berdasarkan lokasi
    switch ($lokasi) {
        case 'Pasar Bandar':
            $tabel = "data_barang_bandar";
            break;
        case 'Pasar Pahing':
            $tabel = "data_barang_pahing";
            break;
        case 'Pasar Setono Betek':
            $tabel = "data_barang_setonobetek";
            break;
        default:
            break;
    }

    if ($tabel !== "") {

        // Loop untuk menyimpan data ke database
        for ($i = 0; $i < count($barang); $i++) {
            // Periksa harga terakhir untuk barang ini
            $sql_last_price = "SELECT harga_sekarang FROM $tabel WHERE nama_barang='$barang[$i]' ORDER BY tanggal DESC LIMIT 1";
            $result_last_price = $conn->query($sql_last_price);
            if ($result_last_price->num_rows > 0) {
                $row = $result_last_price->fetch_assoc();
                $harga_kemarin = $row["harga_sekarang"];
            } else {
                // Jika tidak ada harga terakhir, set harga lama ke 0
                $harga_kemarin = 0;
            }

            // hitung selisih
            $selisih = $harga_sekarang[$i] - $harga_kemarin;

            // insert data ke database
            $sql = "INSERT INTO $tabel (tanggal, lokasi, nama_barang, harga_sekarang, harga_kemarin, selisih) 
                VALUES ('$tanggal', '$lokasi', '$barang[$i]', '$harga_sekarang[$i]', '$harga_kemarin', '$selisih')";

            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil disimpan ke database.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Tutup koneksi ke database
    $conn->close();

    // Redirect ke halaman form input setelah data berhasil disimpan
    header("Location: survey.php");
    exit();
}
