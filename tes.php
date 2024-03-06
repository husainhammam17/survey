<div class="container m-auto border border-dark border-5 rounded-1 mt-5 mb-5">
  <?php
  echo "<tr><td colspan='2' class='selected-item'>Jumlah item yang dipilih: <span id='selected-count'>0</span></td></tr>";
  ?>
  <form method="post" action="datafiltered.php">
    <table>
      <tr>
        <?php
        $query_checkbox = "SELECT DISTINCT nama_barang FROM daftar_harga";
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
        <button type="submit" value="Filter" class="button blob btn-primary btn">
          <span>Filter</span>
        </button>
    </table>
  </form>
</div>

<?php
include("../includes/db.php");
// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";
$jml_data = count($_POST);
// echo $jml_data;

for ($i = 0; $i <= $jml_data - 5; $i++) {
  $tanggal = $_POST['tanggal'][$i];
  $lokasi = $_POST['lokasi'][$i];
  $barang = $_POST['barang'][$i];
  $harga_baru = $_POST['harga_baru'][$i];

  mysqli_query($connection, "insert into data_barang(tanggal, lokasi, nama_barang, harga_baru) values('$tanggal', '$lokasi', '$barang', '$harga_baru')");
}
?>


<style>
  tr:nth-child(even) {
    background-color: #D6EEEE;
  }

  tr {
    border: 1px solid #000;
  }

  th {
    background-color: grey;
    padding-left: 5px;
    padding-right: 5px;
    text-align: center;
  }

  td {
    padding-left: 4px;
    padding-right: 4px;
  }
</style>
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

// Fungsi untuk memvalidasi data
function validasiData($id_barang)
{
  global $conn;
  $sql = "UPDATE data_barang_bandar SET status_validasi = 'true' WHERE id_barang = $id_barang";
  $result = $conn->query($sql);
  if ($result === TRUE) {
    $message = "Data berhasil divalidasi";
    echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: green; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
    echo "<script>
                setTimeout(function() {
                    var elem = document.getElementById('floating-message');
                    elem.remove();
                }, 1000);
              </script>";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
    echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: red; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
    echo "<script>
                setTimeout(function() {
                    var elem = document.getElementById('floating-message');
                    elem.remove();
                }, 1000);
              </script>";
  }
}


// Fungsi untuk mengedit data
function editData($id_barang, $harga_baru)
{
  global $conn;
  $sql = "UPDATE data_barang_bandar SET harga_sekarang = $harga_baru WHERE id_barang = $id_barang";
  $result = $conn->query($sql);
  if ($result === TRUE) {
    $message = "Data berhasil diubah";
    echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: green; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
    echo "<script>
                setTimeout(function() {
                    var elem = document.getElementById('floating-message');
                    elem.remove();
                }, 1000);
              </script>";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
    echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: red; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
    echo "<script>
                setTimeout(function() {
                    var elem = document.getElementById('floating-message');
                    elem.remove();
                }, 1000);
              </script>";
  }
}

// Tampilkan form untuk memvalidasi data
if (isset($_GET['action']) && $_GET['action'] == 'validasi') {
  $id_barang = $_GET['id'];
  echo validasiData($id_barang);
}

// Tampilkan form untuk mengedit data
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
  $id_barang = $_GET['id'];
  echo "<h2>Edit Data</h2>";
  echo "<form method='post' action=''>";
  echo "<label>Harga Baru:</label>";
  echo "<input type='text' name='harga_baru'>";
  echo "<input type='hidden' name='id_barang' value='$id_barang'>";
  echo "<input type='submit' name='submit_edit' value='Simpan'>";
  echo "</form>";

  // Proses pengeditan data setelah form disubmit
  if (isset($_POST['submit_edit'])) {
    $harga_baru = $_POST['harga_baru'];
    $id_barang = $_POST['id_barang'];
    echo editData($id_barang, $harga_baru);
  }
}


// Tampilkan daftar data yang perlu divalidasi
$sql = "SELECT * FROM data_barang_bandar WHERE status_validasi = 'pending'";

// Jika terdapat parameter lokasi dari form filter, tambahkan filter tersebut ke dalam query
if (isset($_GET['lokasi']) && !empty($_GET['lokasi'])) {
  $lokasi_filter = $_GET['lokasi'];
  $sql .= " AND lokasi = '$lokasi_filter'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Data yang perlu divalidasi:</h2>";
  echo "<table border='1'>";
  echo "<tr><th>ID Barang</th><th>Nama Barang</th><th>Tanggal</th><th>Harga Kemarin</th><th>Harga Sekarang</th><th>Selisih</th><th>Lokasi</th><th>Status Validasi</th><th>Action</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id_barang'] . "</td>";
    echo "<td>" . $row['nama_barang'] . "</td>";
    echo "<td>" . $row['tanggal'] . "</td>";
    echo "<td>" . $row['harga_kemarin'] . "</td>";
    echo "<td>" . $row['harga_sekarang'] . "</td>";
    echo "<td>" . $row['selisih'] . "</td>";
    echo "<td>" . $row['lokasi'] . "</td>";
    echo "<td>" . $row['status_validasi'] . "</td>";
    echo "<td><a href='?action=validasi&id=" . $row['id_barang'] . "'>Validasi</a> | <a href='?action=edit&id=" . $row['id_barang'] . "'>Edit</a></td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada data yang perlu divalidasi.";
}

$conn->close();
?>

// Tampilkan form untuk mengedit data
// if (isset($_GET['action']) && $_GET['action'] == 'edit') {
// $id_barang = $_GET['id'];
// echo "<h2>Edit Data</h2>";
// echo "<form method='post' action='edit_bandar.php'>";
  // echo "<label>Harga Baru:</label>";
  // echo "<input type='text' name='harga_baru'>";
  // echo "<input type='hidden' name='id_barang' value='$id_barang'>";
  // echo "<input type='submit' name='submit_edit' value='Simpan'>";
  // echo "</form>";

// // Proses pengeditan data setelah form disubmit
// if (isset($_POST['submit_edit'])) {
// $harga_baru = $_POST['harga_baru'];
// $id_barang = $_POST['id_barang'];
// echo editData($id_barang, $harga_baru);
// }
// }

// Fungsi untuk mengedit data
// function editData($id_barang, $harga_sekarang)
// {
// global $conn;
// $sql = "UPDATE data_barang_bandar SET harga_sekarang = $harga_sekarang WHERE id_barang = $id_barang";
// $result = $conn->query($sql);
// if ($result === TRUE) {
// $message = "Data berhasil diubah";
// echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: green; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
// echo "<script>
  //                 setTimeout(function() {
  //                     var elem = document.getElementById('floating-message');
  //                     elem.remove();
  //                 }, 1000);
  //               
</script>";
// } else {
// $message = "Error: " . $sql . "<br>" . $conn->error;
// echo "<div id='floating-message' style='position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); background-color: red; color: white; padding: 10px; border-radius: 5px;'>" . $message . "</div>";
// echo "<script>
  //                 setTimeout(function() {
  //                     var elem = document.getElementById('floating-message');
  //                     elem.remove();
  //                 }, 1000);
  //               
</script>";
// }
// // echo "<script>
  window.history.go(-2);
</script>";
// }