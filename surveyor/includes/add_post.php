<h2>Input Survey</h2>
<hr>

<?php
session_start();
if (isset($_SESSION['success_message'])) {
    echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var floatingMessage = document.createElement("div");
                    floatingMessage.className = "floating-message";
                    floatingMessage.textContent = "' . $_SESSION['success_message'] . ',";

                    document.body.appendChild(floatingMessage);

                    setTimeout(function() {
                        document.body.removeChild(floatingMessage);
                    }, 3000);
                });
            </script>';
    unset($_SESSION['success_message']);
}
?>

<div class="container px-4 text-center">
    <div class="row gx-5">
        <img src="../../images/dp1.png" alt="">
    </div>
</div>

<form action="inputData.php" method="POST" onsubmit="return validateForm()">
    <div class="card">
        <div class="card-title">
            <h1 class="title">Form Input Data</h1>
            <div class="line"></div>
        </div>
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
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $tanggalHariIni; ?>">
                    </div>
                </td>
            </tr>
            <tr style="display:flex;">
                <!-- <td>
                        Lokasi
                    </td> -->
                <td>
                    <div class="input-group mb-3">
                        <select name="lokasi" id="lokasi" class="form-select">
                            <option value="pilih-lokasi">Pilih Lokasi</option>
                            <option value="Pasar Bandar">Pasar Bandar</option>
                            <option value="Pasar Pahing">Pasar Pahing</option>
                            <option value="Pasar Setono Betek">Pasar Setono Betek</option>
                        </select>
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <label for="barang">Beras Premium</label>
                        <input type="hidden" name="barang[]" id="barang" class="form-control" value="Beras Premium">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="harga_baru[]" id="harga_baru" class="form-control" aria-label="Amount" placeholder="Masukkan Harga Baru">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <label for="barang">Beras Medium</label>
                        <input type="hidden" name="barang[]" id="barang" class="form-control" value="Beras Medium">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="harga_baru[]" id="harga_baru" class="form-control" aria-label="Amount" placeholder="Masukkan Harga Baru">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <label for="barang">Daging Ayam Ras </label>
                        <input type="hidden" name="barang[]" id="barang" class="form-control" value="Daging Ayam Ras">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="harga_baru[]" id="harga_baru" class="form-control" aria-label="Amount" placeholder="Masukkan Harga Baru">
                    </div>
                </td>
            </tr>
        </table>
        <div class="btn">
            <div class="col-12">
                <input class="submit" name="submit" type="submit" value="Submit">
                <input class="reset" name="reset" type="reset" value="Reset">
            </div>
        </div>
    </div>
</form>


<script>
    function validateForm() {
        var tanggal = document.getElementById('tanggal').value;
        var barang = document.getElementById('barang').value;
        var hargaLama = document.getElementById('harga_lama').value;
        var hargaBaru = document.getElementById('harga_baru').value;
        var lokasi = document.getElementById('lokasi').value;

        if (tanggal === "" || barang === "" || hargaLama === "" || hargaBaru === "" || lokasi === "pilih-lokasi") {
            // Display floating message
            var floatingMessage = document.createElement("div");
            floatingMessage.className = "floating-message";
            floatingMessage.textContent = "Data Tidak Boleh Kosong";

            document.body.appendChild(floatingMessage);

            setTimeout(function() {
                document.body.removeChild(floatingMessage);
            }, 3000);

            return false;
        }

        return true;
    }
</script>