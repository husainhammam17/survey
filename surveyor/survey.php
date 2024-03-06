<?php include "includes/header.php" ?>

<!-- Navbar -->
<?php include "includes/navigation.php" ?>


<div id="wrapper">

  <!-- Sidebar -->
  <?php include "includes/sidebar.php" ?>

  <div id="content-wrapper">

    <div class="container-fluid">
      <!-- Page Content -->
      <style>
        .floating-message {
          position: fixed;
          bottom: 20px;
          left: 50%;
          transform: translateX(-50%);
          background-color: green;
          color: white;
          padding: 10px 20px;
          border: 1px solid #ccc;
          border-radius: 5px;
          z-index: 9999;
        }

        .floating-message-Error {
          position: fixed;
          bottom: 20px;
          left: 50%;
          transform: translateX(-50%);
          background-color: red;
          color: white;
          padding: 10px 20px;
          border: 1px solid #ccc;
          border-radius: 5px;
          z-index: 9999;
        }
      </style>

      <h2>Input Survey Komoditas</h2>
      <hr>

      <div class="container px-4 text-center">
        <div class="row gx-5">
          <img src="../../images/dp1.png" alt="">
        </div>
      </div>

      <form id="inputForm" action="action.php" method="POST" onsubmit="return validateForm()">
        <div class="card">
          <table>
            <tr style="display:flex;">
              <!-- <td>
                        Tanggal
                    </td> -->
              <td>
                <div class="input-group mb-3">
                  <?php
                  $tanggalHariIni = date("Y-m-d");
                  ?>
                  <input type="date" name="tanggal[]" id="tanggal" class="form-control" value="<?php echo $tanggalHariIni; ?>">
                </div>
              </td>
            </tr>
            <tr style="display:flex;">
              <!-- <td>
                        Lokasi
                    </td> -->
              <td>
                <div class="input-group mb-3">
                  <select name="lokasi[]" id="lokasi" class="form-select">
                    <option value="pilih-lokasi">Pilih Lokasi</option>
                    <option value="Pasar Bandar">Pasar Bandar</option>
                    <option value="Pasar Pahing">Pasar Pahing</option>
                    <option value="Pasar Setono Betek">Pasar Setono Betek</option>
                  </select>
                </div>
              </td>

            </tr>
            <?php
            $barang = array("Beras Premium", "Beras Medium", "Gula Kristal Putih", "Minyak Goreng Curah", "Minyak Goreng Kemasan Premium", "Minyak Goreng Kemasan Sederhana", "Minyak Goreng MINYAKITA", "Daging Sapi Paha Belakang", "Daging Ayam Ras", "Daging Ayam Kampung", "Telur Ayam Ras", "Telur Ayam Kampung", "SKM Merk Bendera", "SKM Merk Indomilk", "Susu Bubuk Merk Bendera (Instant)", "Susu Bubuk Merk Indomilk (Instant)", "Jagung Pipilan Kering", "Garam Beryodium Bata", "Garam Beryodium Halus", "Terigu Protein Sedang (Kemasan)", "Kedelai Impor", "Kedelai Lokal", "Indomie Rasa Kari Ayam", "Cabe Merah Keriting", "Cabe Merah Besar", "Cabe Rawit Merah", "Bawang Merah", "Bawang Putih Sinco/Honan", "Ikan Asin Teri", "Kacang Hijau", "Kacang Tanah", "Ketela Pohon", "Kol/Kubis", "Kentang", "Tomat Merah", "Wortel", "Buncis", "Ikan Bandeng", "Ikan Kembung", "Ikan Tuna", "Ikan Tongkol", "Ikan Cakalang", "Gas LPG 3Kg");
            foreach ($barang as $item) {
            ?>
              <tr>
                <td>
                  <div class="input-group mb-3">
                    <label for="barang"><?php echo $item; ?></label>
                    <input type="hidden" name="barang[]" class="form-control" value="<?php echo $item; ?>">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="text" name="harga_sekarang[]" class="form-control" aria-label="Amount" placeholder="Masukkan Harga">
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </table>
          <div class="btn">
            <div class="col-12">
              <input class="submit" name="submit" type="submit" value="Submit">
              <input class="reset" name="reset" type="reset" value="Reset">
            </div>
          </div>
        </div>
      </form>



    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<script>
  function validateForm() {
    var tanggal = document.getElementById('tanggal').value;
    var lokasi = document.getElementById('lokasi').value;
    var hargaBaruInputs = document.querySelectorAll('input[name="harga_sekarang[]"]');

    // Periksa data tidak boleh kosong
    if (tanggal === "" || hargaBaruInputs === "" || lokasi === "pilih-lokasi") {
      displayFloatingMessage("Data tidak boleh kosong", "floating-message-Error");
      return false;
    } else {
      displayFloatingMessage("Data berhasil disimpan"), "floating-message";
    }

    // Periksa setidaknya satu harga baru diisi
    // var hargaBaruFilled = false;
    // for (var i = 0; i < hargaBaruInputs.length; i++) {
    //   if (hargaBaruInputs[i].value.trim() !== "") {
    //     hargaBaruFilled = true;
    //     break;
    //   }
    // }
    // if (!hargaBaruFilled) {
    //   displayFloatingMessage("Minimal satu harga baru harus diisi");
    //   return false;
    // }

    // Validasi sukses
    // return true;
  }

  // Fungsi untuk menampilkan pesan floating
  function displayFloatingMessage(message, className) {
    var floatingMessage = document.createElement("div");
    floatingMessage.className = className;
    floatingMessage.textContent = message;

    document.body.appendChild(floatingMessage);

    setTimeout(function() {
      document.body.removeChild(floatingMessage);
    }, 3000);
  }
</script>
<?php include "includes/footer.php" ?>