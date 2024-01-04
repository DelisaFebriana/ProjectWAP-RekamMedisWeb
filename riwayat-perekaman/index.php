<?php 

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";

$title = "Riwayat Perekaman - Rekam Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";


?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Rekam Medis Pasien</h1>
      </div>

      <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
            while ($pasien = mysqli_fetch_assoc($queryPasien)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pasien['id'] ?> </td>
                <td><?= $pasien['nama'] ?> </td>
                <td><?= htgUmur($pasien['tgl_lahir']) ?> </td>
                <td>
                   <?php 
                    if ($pasien['gender'] == 'P') {
                        echo 'Pria';
                    } else {
                        echo 'Wanita';
                    } 
                   ?> 
                </td>
                <td><?= $pasien['telpon'] ?> </td>
                <td><?= $pasien['alamat'] ?> </td>
                <td class="col-1">
                <a href="laporan.php?id=<?= $pasien['id'] ?>" class="btn btn-sm btn-outline-primary" 
                    title="cetak pdf" data-bs-toggle="modal" data-bs-target="#successModal">
                <i class="bi bi-envelope-at-fill align-top"></i>
                </a>
<!-- Modal popup untuk menampilkan pesan -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Rekam Medis Terkirim</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Rekam medis Anda telah berhasil dikirim ke Email.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eQFpLpuFkpS8Zl4Wl3rJbD5kRvHdjHb0RnP9Mg8J+9JKbXU3uANoILwObF5i2Ml" crossorigin="anonymous"></script>
                </td>
            </tr>
            <?php } ?>
        </tbody>
      </table>

    </main>

<script>
  window.setTimeout(function(){
    $('.updated').fadeOut()
  }, 5000) 
</script>
 

<?php 

require "../template/footer.php";

?>