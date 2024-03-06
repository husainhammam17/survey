<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_survey";

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    // Ambil data yang ingin diubah dari database
    $sql = "SELECT * FROM data_barang_bandar WHERE id_barang = $id_barang";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <h2>Edit Data</h2>
        <form method="post" action="">
            <label>Harga Sekarang:</label>
            <input type="text" name="harga_sekarang" value="<?php echo $row['harga_sekarang']; ?>">
            <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
            <input type="submit" name="submit_edit" value="Simpan">
        </form>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_edit'])) {
    $harga_sekarang = $_POST['harga_sekarang'];
    $id_barang = $_POST['id_barang'];

    // Update data di database
    $sql = "SELECT * FROM data_barang_bandar WHERE id_barang = $id_barang";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // hitung selisih baru
        $selisih_baru = $harga_sekarang - $row['harga_kemarin'];

        // update data di database
        $sql = "UPDATE data_barang_bandar SET harga_sekarang = $harga_sekarang, selisih = $selisih_baru WHERE id_barang = $id_barang";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            $message = "Data berhasil diubah";

            $_SESSION['floating_message'] = $message;
            echo "<script>window.history.go(-2);</script>";
            exit();
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Data tidak ditemukan";
    }
}

$conn->close();
?>