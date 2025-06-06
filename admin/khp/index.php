<?php
$kategori = '';
if (isset($_POST['btn_kategori'])) {
    $kategori = $_POST['kategori'];
}



?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
 	<!-- Alert -->
  <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (wajib sebelum DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Font Awesome 6 Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
    .tabs form { display: inline; }
    </style>
<div class="kotak-khp">
    <h2>KARTU HASIL PARTISIPASI ( PERIODE AKTIF : <?= $tahunAjaran ?>-<?= $periode ?> )</h2>
<hr id="hr">
<?php 
$query_cekkhp=mysqli_query($koneksi,"SELECT * FROM khp where  tahun = '$tahunAjaran' AND (status = 'menunggu' OR status = 'diterima') AND periode = '$periode' AND npm='$data_id'");
if(mysqli_num_rows($query_cekkhp) <= 0){ ?>
    <div class="tabs">
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Wajib Universitas">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Wajib Universitas' ? 'background-color:#0d6efd;' : '' ?>">Wajib Univ/Fakultas</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Organisasi dan Kepemimpinan">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Organisasi dan Kepemimpinan' ? 'background-color:#0d6efd;' : '' ?>">Organisasi & Kepemimpinan</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Penalaran dan Keilmuan">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Penalaran dan Keilmuan' ? 'background-color:#0d6efd;' : '' ?>">Penalaran & Keilmuan</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Minat dan Bakat">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Minat dan Bakat' ? 'background-color:#0d6efd;' : '' ?>">Minat & Bakat</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Sosial dan Lainnya">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Sosial dan Lainnya' ? 'background-color:#0d6efd;' : '' ?>">Sosial & Lainnya</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="Kartu Rencana Partisipasi">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'Kartu Rencana Partisipasi' ? 'background-color:#0d6efd;' : '' ?>">KRP</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="kategori" value="validasi">
            <button class="button tab-button btn btn-outline-primary" type="submit" name="btn_kategori" style="<?= $kategori == 'validasi' ? 'background-color:#0d6efd;' : '' ?>">Validasi</button>
        </form>
    </div>

    <div class="card mt-3" style="    background-color: white;">
        <div class="card-header" id="cardTitle"><?= $kategori ?: 'Pilih Kategori' ?></div>
        <?php if($kategori == ''){ ?>
            <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
             <strong>Pilih Kategori KHP Yang Akan Di Tambahkan</strong> ... !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
       <?php } ?>
 <?php  if($kategori == 'validasi'){ ?>
<!-- tabel validasi -->
<!-- wajib univ -->
<div class="table-validasi wajib_univ">
      <h3>1. Wajib Universitas</h3>
      <?php
            $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori 
            FROM khp 
            LEFT JOIN krp ON khp.kode = krp.kode 
            WHERE kategori = 'Wajib Universitas' and status='' and npm='$data_id'");
            if (mysqli_num_rows($query) > 0) {
      ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_bobot=0;
                    while($row = mysqli_fetch_assoc($query)) { 
                        $total_bobot += $row['bobot'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td>
                                <?php if($row['file'] == ''){ ?>
                                    <a href="#" download>❌</a>
                               <?php } else{ ?>                             
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download>
                                <img src="././dist/img/icon_action/down1.png" width="25" title="Download"> 
                                </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        </tr>
              <?php  } else { ?>
                        <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                        Belum ada data yang ditambahkan pada Kategori <strong>'  Wajib Universitas/Fakultas  '</strong> ... !!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>

                </tbody>
            </table>
            <hr>
        </div>
      <!-- end wajib univ -->

<!-- Organisasi dan Kepemimpinan-->
    <div class="table-validasi organisasi">
    <h3>2. Organisasi dan Kepemimpinan</h3>
    <?php
        $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori 
        FROM khp 
        LEFT JOIN krp ON khp.kode = krp.kode 
        WHERE kategori = 'Organisasi dan Kepemimpinan' and status='' and npm='$data_id'");
        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_bobot=0;
                    while($row = mysqli_fetch_assoc($query)) { 
                        $total_bobot += $row['bobot'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td>
                                <?php if($row['file'] == ''){ ?>
                                    <a href="#" class="text-decoration-none">❌</a>
                               <?php } else{ ?>                             
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download> <img src="././dist/img/icon_action/down1.png" width="25" title="Download"></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        </tr>
              <?php  } else { ?>

                        <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                        Belum ada data yang ditambahkan pada Kategori <strong>' Organisasi dan Kepemimpinan  '</strong> ... !!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>

                </tbody>
            </table>
            <hr>
        </div>
      <!-- end Organisasi dan Kepemimpinan-->

<!--	Penalaran dan Keilmuan 	-->
    <div class="table-validasi penalaran">
    <h3>3. Penalaran dan Keilmuan</h3>
    <?php
        $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori 
        FROM khp 
        LEFT JOIN krp ON khp.kode = krp.kode 
        WHERE kategori = 'Penalaran dan Keilmuan' and status='' and npm='$data_id'");
        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_bobot =0;
                    while($row = mysqli_fetch_assoc($query)) {
                        $total_bobot += $row['bobot'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td>
                                <?php if($row['file'] == ''){ ?>
                                    <a href="#" download>❌</a>
                               <?php } else{ ?>                             
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download> <img src="././dist/img/icon_action/down1.png" width="25" title="Download"></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        </tr>
             <?php   } else { ?>

                        <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                        Belum ada data yang ditambahkan pada Kategori <strong>' Penalaran dan Keilmuan  '</strong> ... !!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>
 
                </tbody>
            </table>
            <hr>
        </div>
      <!-- end Penalaran dan Keilmuan-->

<!--	Minat dan Bakat 	-->
    <div class="table-validasi minat">
    <h3>4. Minat dan Bakat </h3>
    <?php
        $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori 
        FROM khp 
        LEFT JOIN krp ON khp.kode = krp.kode 
        WHERE kategori = 'Minat dan Bakat' and status='' and npm='$data_id'");
        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_bobot =0;
                        while($row = mysqli_fetch_assoc($query)) { ?>
                           $total_bobot += $row['bobot'];
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['tgl'] ?></td>
                                <td><?= $row['nama_b_indo'] ?></td>
                                <td><?= $row['nama_b_inggris'] ?></td>
                                <td><?= $row['bobot'] ?></td>
                                <td>
                                <?php if($row['file'] == ''){ ?>
                                    <a href="#" download>❌</a>
                               <?php } else{ ?>                             
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download> <img src="././dist/img/icon_action/down1.png" width="25" title="Download"></a>
                                <?php } ?>
                            </td>
                            </tr>
                        <?php } ?>
                        <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        </tr>
                  <?php  } else { ?>

                            <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                            Belum ada data yang ditambahkan pada Kategori <strong>' Minat dan Bakat  '</strong> ... !!!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php } ?>

                </tbody>
            </table>
            <hr>
        </div>
      <!-- end Minat dan Bakat-->

<!--		end Sosial dan Lainnya- 	-->
    <div class="table-validasi sosial">
    <h3>5. Sosial dan Lainnya</h3>
    <?php
        $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori 
        FROM khp 
        LEFT JOIN krp ON khp.kode = krp.kode 
        WHERE kategori = 'Sosial dan Lainnya' and status='' and npm='$data_id'");
        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_bobot =0;
                    $no = 1;
                        while($row = mysqli_fetch_assoc($query)) {
                            $total_bobot += $row['bobot'];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['tgl'] ?></td>
                                <td><?= $row['nama_b_indo'] ?></td>
                                <td><?= $row['nama_b_inggris'] ?></td>
                                <td><?= $row['bobot'] ?></td>
                                <td>
                                <?php if($row['file'] == ''){ ?>
                                    <a href="#" download>❌</a>
                               <?php } else{ ?>                             
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download> <img src="././dist/img/icon_action/down1.png" width="25" title="Download"></a>
                                <?php } ?>
                            </td>
                            </tr>
                        <?php } ?>
                        <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        </tr>
                   <?php } else { ?>

                            <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                            Belum ada data yang ditambahkan pada Kategori <strong>' Sosial dan Lainnyat  '</strong> ... !!!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php } ?>

                </tbody>
            </table>
            <hr>
               <?php
                // Cek semua data dari khp yang statusnya kosong
                $query_check_all = mysqli_query($koneksi, "SELECT file FROM khp 
                    LEFT JOIN krp ON khp.kode = krp.kode 
                    WHERE status = ''");

                $jumlah_data = mysqli_num_rows($query_check_all);
                $all_file_terisi = true;

                while ($row = mysqli_fetch_assoc($query_check_all)) {
                    if (empty($row['file'])) {
                        $all_file_terisi = false;
                        break;
                    }
                }
               ?>
                <div class="d-grid mb-2">
                <?php if (!$all_file_terisi): ?>
                <a href="#" class="btn btn-warning">File tidak lengkap</a>
                <?php else: ?>
                <form action="" method="post">
                    <button class="btn btn-validasi text-white" type="submit" name="validasi">Validasi</button>
                </form>
                <?php endif; ?>
                </div>
        </div>
      <!-- end Sosial dan Lainnya-->
       <!-- end validasi -->

       <!-- krp -->
<?php }elseif($kategori=='Kartu Rencana Partisipasi'){ ?>
  <div class="table-validasi krp">
    <h3>Data KRP Tahun <?= $tahunAjaran ?>/<?= $periode ?></h3>
    <?php
    $query = mysqli_query($koneksi, "
      SELECT krp_mhs.kode, krp_mhs.npm, krp_mhs.tahun, krp_mhs.periode,
             krp_mhs.bobot, krp_mhs.created_at, krp.nama, krp.kategori
      FROM krp_mhs
      INNER JOIN krp ON krp_mhs.kode = krp.kode
      WHERE tahun = '$tahunAjaran' AND periode = '$periode' AND npm = '$data_id'
    ");

    if (mysqli_num_rows($query) > 0) {
        $total_bobot = 0;
        $no = 1;
    ?>
    <table class="activity-table table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)) { 
                $total_bobot += $row['bobot']; ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= $row['bobot'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="3" class="text-center"><b>Total</b></td>
                <td><b><?= $total_bobot; ?></b></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <?php
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
            <strong>Belum ada data KRP yang dipilih</strong> ... !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Cek semua data dari khp yang statusnya kosong
    $query_check_all = mysqli_query($koneksi, "SELECT file FROM khp 
        LEFT JOIN krp ON khp.kode = krp.kode 
        WHERE status = ''");

    $jumlah_data = mysqli_num_rows($query_check_all);
    $all_file_terisi = true;

    while ($row = mysqli_fetch_assoc($query_check_all)) {
        if (empty($row['file'])) {
            $all_file_terisi = false;
            break;
        }
    }
    ?>
    <div class="d-grid mb-2">
        <?php if (!$all_file_terisi): ?>
            <a href="#" class="btn btn-warning">File tidak lengkap</a>
        <?php else: ?>
            <form action="" method="post">
                <button class="btn btn-validasi text-white" type="submit" name="validasi">Validasi</button>
            </form>
        <?php endif; ?>
    </div>
</div>

      <!-- end krp-->
<?php }else { ?>
        <!-- Tombol tambah hanya muncul jika kategori terpilih -->
        <?php if ($kategori): ?>
            <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Kegiatan
            </button>
        <?php endif; ?>

<?php if ($kategori != '') {
    $query = mysqli_query($koneksi, "SELECT khp.id as id_khp, khp.kode,no_sertifikat,tgl_sertifikat, DATE(khp.created_at) as tgl, nama_b_indo, nama_b_inggris, file, bobot, kategori FROM khp LEFT JOIN krp ON khp.kode = krp.kode LEFT JOIN mahasiswa ON khp.npm=mahasiswa.npm WHERE kategori = '$kategori' AND status = '' AND khp.npm='$data_id'");

    $jumlah_data = mysqli_num_rows($query);

    if ($jumlah_data == 0) {
        // 🔸 Tampilkan alert jika data kosong
        echo '<div class="alert alert-warning alert-dismissible fade show mt-0 ms-3 me-3" role="alert">
                Belum ada data yang ditambahkan pada Kategori <strong>' . htmlspecialchars($kategori) . '</strong> ... !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        // 🔸 Tampilkan tabel jika data ada
        ?>
        <div class="table-container">
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kegiatan (Indonesia)</th>
                        <th>Nama Kegiatan (Inggris)</th>
                        <th>Bobot</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total_bobot=0;
                    while($row = mysqli_fetch_assoc($query)) {
                        $total_bobot += $row['bobot'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <?php if($row['file'] == ''){ ?>
                                <td>-</td>
                            <?php }else {?>
                                <td><a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" download><i class="bi bi-cloud-download fs-5"></a></td>
                            <?php } ?>
                            <td>
                                <a href="#" title="Ubah" class="btn text-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['id_khp'] ?>">
                                <i class="fa fa-edit fa-lg"></i>
                                </a>
                                <a href="?page=del-khp&kode=<?= $row['id_khp']; ?>&file=<?= $row['file']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-sm text-danger">
                                <i class="fas fa-trash fa-lg"></i>  <!-- Ikon trash -->
                                </a>
                            </td>
                        </tr>

                       <!-- Modal Update -->
<div class="modal fade" id="modalUpdate<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Update Kegiatan - <?= htmlspecialchars($kategori) ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $row['file'] ?>">
          <input type="hidden" name="id_khp" value="<?= htmlspecialchars($row['id_khp']) ?>">

          <!-- Nama Kegiatan Indonesia -->
          <div class="mb-3">
            <label class="form-label">Nama Kegiatan ( B.Indonesia)</label>
            <textarea class="form-control" name="nama_b_indo" placeholder="Tulis Lengkap dengan Tahun dan Tempat Pelaksanaan"><?= htmlspecialchars($row['nama_b_indo']) ?></textarea>
          </div>

          <!-- Nama Kegiatan Inggris -->
          <div class="mb-3">
            <label class="form-label">Nama Kegiatan ( B.Inggris)</label>
            <textarea class="form-control" name="nama_b_inggris" placeholder="Write Theme/Title, Year Place, Activity Completly"><?= htmlspecialchars($row['nama_b_inggris']) ?></textarea>
          </div>

          <!-- Pilih Kegiatan -->
          <div class="mb-3">
            <label class="form-label">Pilih Kegiatan</label>
            <select class="form-select" name="kegiatan" required>
              <?php
                $kode_terpilih = $row['kode'];
                $query_kode = mysqli_query($koneksi, "SELECT kategori, nama FROM krp WHERE kode = '$kode_terpilih'");
                $data_kode = mysqli_fetch_assoc($query_kode);
              ?>
              <option value="<?= htmlspecialchars($row['kode']) ?>" selected>
                <?= $data_kode['nama'] . ' - (' . $data_kode['kategori'] . ')' ?>
              </option>
              <?php
              if ($kategori) {
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori = '$kategori'");
                while ($opt = mysqli_fetch_assoc($query_kategori)) {
                  echo '<option value="' . htmlspecialchars($opt['kode']) . '">' . htmlspecialchars($opt['nama']) . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <!-- Tanggal Diterbitkan -->
          <div class="mb-3">
            <label class="form-label">Tanggal Diterbitkan/Disahkan</label>
            <?php $tanggalFix = !empty($row['tgl_sertifikat']) ? date('Y-m-d', strtotime($row['tgl_sertifikat'])) : ''; ?>
            <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($tanggalFix) ?>">
          </div>

          <!-- Nomor Sertifikat -->
          <div class="mb-3">
            <label class="form-label">No Sert/SK/HAKI/ISSN/ISBN/Keterangan Lainnya</label>
            <input type="text" class="form-control" name="no" placeholder="No Sertifikat/SK/Lainnya" value="<?= htmlspecialchars($row['no_sertifikat']) ?>">
          </div>

          <!-- File -->
          <div class="mb-3">
            <label class="form-label">File</label>
            <input type="file" class="form-control" name="file">
            <?php if (!empty($row['file'])): ?>
              <small class="form-text text-muted">
                File saat ini: <?= htmlspecialchars($row['file']) ?></a>
              </small>
            <?php else: ?>
              <small class="form-text text-muted">Tidak ada file saat ini</small>
            <?php endif; ?>
          </div>

          <!-- Tombol -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- end update modal -->
                    <?php } ?>
                        <tr>
                        <td></td>
                        <td colspan="3" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
} }
?>
    </div>

</div>
<?php } else { ?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
  Anda sudah mengisi Kartu Hasil Partisipasi (KHP) Periode Aktif. <b><?= $tahunAjaran ?>-<?= $periode ?></b>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<!-- Histori -->
 <div class="histori">
     <div class="table-header text-white">Riwayat KHP Periode Sebelumnya</div>
        <div class="table-container">
        <table id="tabelRiwayat" class="activity-table table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Kategori</th>
                <th>Judul (Idn)</th>
                <th>Judul (Eng)</th>
                <th>file</th>
                <th>Skor</th>
                <th>Verivikasi</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                    $no = 1;
                    $total_bobot = 0;
                    $query=mysqli_query($koneksi,"SELECT khp.id AS id_khp,khp.tahun,khp.periode, krp.kategori, krp.bobot, khp.*, mahasiswa.*
                    FROM khp
                    JOIN mahasiswa ON khp.npm = mahasiswa.npm
                    JOIN krp on khp.kode=krp.kode
                   WHERE khp.npm = '$data_id' AND (khp.status = 'menunggu' OR khp.status = 'diterima')");
                    while($row = mysqli_fetch_assoc($query)) { 
                        $total_bobot += $row['bobot'];
                        ?>
                        <tr>
                            <td><b><?= $no++; ?></b></td>
                            <td><b><?= $row['tahun'] ?>-<?=$row['periode'] ?></b></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                           
                            <td>
                               <a href="#" data-bs-toggle="modal" data-bs-target="#modalView<?= $row['id_khp'] ?>" title="View">
                                   <i class="bi bi-eye fs-5"></i>
                                </a>

                              <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" title="Download" download>
                                <i class="bi bi-cloud-download fs-5"></i></a>
                            </td>
                            <!-- <td><?= $row['tahun'] ?> | <?= $row['periode'] ?></td> -->
                            <td><?= $row['bobot'] ?></td>
                            <td>
                              <?php if($row['status']=='menunggu'){ ?>
                              <span class="badge bg-warning text-white"><?= $row['status'] ?></span>
                              <?php }elseif($row['status']=='diterima'){ ?>
                                <span class="badge bg-success text-white"><?= $row['status'] ?></span>
                                <?php } ?>
                            </td>
                            <td>
                               <?php if($row['status']=='menunggu'){ ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['id_khp'] ?>" title="Update" class="btn text-primary btn-sm">
                                    <i class="fa fa-edit fa-lg"></i>
                                </a>
                                       <?php }elseif($row['status']=='diterima'){ ?>
                                        -
                                         <?php } ?>
                            </td>
                        </tr>

                        <!-- modal view -->
                          <!-- Modal Update -->
<div class="modal fade" id="modalView<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">File Kegiatan - <?= htmlspecialchars($kategori) ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
       <iframe src="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" width="100%" height="600px"></iframe>


          <!-- Tombol -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- end update modal -->
                        <!-- end modal view -->


                         <!-- Modal Update -->
<div class="modal fade" id="modalUpdate<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Update Kegiatan - <?= htmlspecialchars($kategori) ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $row['file'] ?>">
          <input type="hidden" name="id_khp" value="<?= htmlspecialchars($row['id_khp']) ?>">

          <!-- Nama Kegiatan Indonesia -->
          <div class="mb-3">
            <label class="form-label">Nama Kegiatan ( B.Indonesia)</label>
            <textarea class="form-control" name="nama_b_indo" placeholder="Tulis Lengkap dengan Tahun dan Tempat Pelaksanaan"><?= htmlspecialchars($row['nama_b_indo']) ?></textarea>
          </div>

          <!-- Nama Kegiatan Inggris -->
          <div class="mb-3">
            <label class="form-label">Nama Kegiatan ( B.Inggris)</label>
            <textarea class="form-control" name="nama_b_inggris" placeholder="Write Theme/Title, Year Place, Activity Completly"><?= htmlspecialchars($row['nama_b_inggris']) ?></textarea>
          </div>

          <!-- Pilih Kegiatan -->
          <div class="mb-3">
            <label class="form-label">Pilih Kegiatan</label>
            <select class="form-select" name="kegiatan" required>
              <?php
                $kode_terpilih = $row['kode'];
                $query_kode = mysqli_query($koneksi, "SELECT kategori, nama FROM krp WHERE kode = '$kode_terpilih'");
                $data_kode = mysqli_fetch_assoc($query_kode);
              ?>
              <option value="<?= htmlspecialchars($row['kode']) ?>" selected>
                <?= $data_kode['nama'] . ' - (' . $data_kode['kategori'] . ')' ?>
              </option>
              <?php
              if ($kategori) {
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori = '$kategori'");
                while ($opt = mysqli_fetch_assoc($query_kategori)) {
                  echo '<option value="' . htmlspecialchars($opt['kode']) . '">' . htmlspecialchars($opt['nama']) . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <!-- Tanggal Diterbitkan -->
          <div class="mb-3">
            <label class="form-label">Tanggal Diterbitkan/Disahkan</label>
            <?php $tanggalFix = !empty($row['tgl_sertifikat']) ? date('Y-m-d', strtotime($row['tgl_sertifikat'])) : ''; ?>
            <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($tanggalFix) ?>">
          </div>

          <!-- Nomor Sertifikat -->
          <div class="mb-3">
            <label class="form-label">No Sert/SK/HAKI/ISSN/ISBN/Keterangan Lainnya</label>
            <input type="text" class="form-control" name="no" placeholder="No Sertifikat/SK/Lainnya" value="<?= htmlspecialchars($row['no_sertifikat']) ?>">
          </div>

          <!-- File -->
          <div class="mb-3">
            <label class="form-label">File</label>
            <input type="file" class="form-control" name="file">
            <?php if (!empty($row['file'])): ?>
              <small class="form-text text-muted">
                File saat ini: <?= htmlspecialchars($row['file']) ?></a>
              </small>
            <?php else: ?>
              <small class="form-text text-muted">Tidak ada file saat ini</small>
            <?php endif; ?>
          </div>

          <!-- Tombol -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- end update modal -->
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="5" class="text-center"><b>Total</b></td>
                        <td><b><?= $total_bobot; ?></b></td>
                        <td></td>
                        <td></td>
                        </tr>
            </tbody>
        </table>
        </div>
     </div>
    <!-- end Histori -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $('#tabelRiwayat').DataTable({
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "→",
                "previous": "←"
            },
            "zeroRecords": "Belum ada Data History",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(disaring dari _MAX_ total data)"
        }
    });
});
</script>














    <!-- modal khp -->
 <!-- Modal Tambah Kegiatan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Tambah Kegiatan - <?= $kategori ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="kategori" value="<?= htmlspecialchars($kategori) ?>">

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Nama Kegiatan ( B.Indonesia)</label>
                        <textarea class="form-control" name="nama_b_indo" id="nama_b_indo" placeholder="Tulis Lengkap dengan Tahun dan Tempat Pelaksanaan"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Nama Kegiatan ( B.Inggris)</label>
                        <textarea class="form-control" name="nama_b_inggris" id="nama_b_inggris" placeholder="Akan terisi otomatis..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Pilih Kegiatan</label>
                        <select class="form-select" name="kegiatan" id="kegiatan" required>
                            <option value="" selected disabled>-- Pilih --</option>
                            <?php
                            if ($kategori) {
                                if ($kategori == 'Wajib Universitas') {
                                    $cek_kode = mysqli_query($koneksi, "SELECT kode FROM khp WHERE npm='$data_id' AND kode IN ('WU001', 'WU002')");
                                    $kode_terpilih = [];
                                    while ($row = mysqli_fetch_assoc($cek_kode)) {
                                        $kode_terpilih[] = $row['kode'];
                                    }
                                    $query_kategori = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='Wajib Universitas'");
                                    while ($row = mysqli_fetch_assoc($query_kategori)) {
                                        if (!in_array($row['kode'], $kode_terpilih)) {
                                            echo '<option value="' . $row['kode'] . '">' . $row['nama'] . '</option>';
                                        }
                                    }
                                } else {
                                    $query_kategori = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='$kategori'");
                                    while ($row = mysqli_fetch_assoc($query_kategori)) {
                                        echo '<option value="' . $row['kode'] . '">' . $row['nama'] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Tanggal Diterbitkan/Disahkan</label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tanggal">
                    </div>

                    <div class="mb-3">
                        <label for="no" class="form-label">No Sert/SK/HAKI/ISSN/ISBN/Keterangan Lainnya</label>
                        <input type="text" class="form-control" placeholder="No Sertifikat/SK/Lainnya" name="no">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" placeholder="File Sertifikat/SK/Lainnya (png,jpg,jpeg,pdf,word)" name="file">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Pastikan script berjalan setelah semua elemen HTML dimuat
    document.addEventListener('DOMContentLoaded', function() {
        
        // Ambil elemen textarea berdasarkan ID yang baru kita tambahkan
        const indoTextarea = document.getElementById('nama_b_indo');
        const inggrisTextarea = document.getElementById('nama_b_inggris');
        let debounceTimer;

        // Fungsi untuk memanggil API terjemahan
        async function terjemahkan(teks) {
            // Jika input kosong, kosongkan juga outputnya
            if (!teks) {
                inggrisTextarea.value = '';
                return;
            }

            // Beri feedback ke user bahwa proses sedang berjalan
            inggrisTextarea.placeholder = 'Menerjemahkan...';

            // URL API publik (tidak perlu kunci API)
            const apiUrl = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(teks)}&langpair=id|en`;

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                // Cek jika API memberikan hasil yang valid
                if (data.responseData && data.responseData.translatedText) {
                    // Masukkan hasil terjemahan ke dalam textarea Bahasa Inggris
                    inggrisTextarea.value = data.responseData.translatedText;
                } else {
                    inggrisTextarea.placeholder = 'Terjemahan otomatis tidak berhasil.';
                }
            } catch (error) {
                console.error('API Terjemahan Gagal:', error);
                inggrisTextarea.placeholder = 'Gagal menghubungi layanan terjemahan.';
            }
        }

        // Tambahkan event listener ke textarea Bahasa Indonesia
        indoTextarea.addEventListener('input', function() {
            const teksUntukDiterjemahkan = this.value.trim();
            
            // Hapus timer yang sedang berjalan (jika ada)
            clearTimeout(debounceTimer);

            // Atur timer baru. Fungsi 'terjemahkan' hanya akan berjalan 
            // setelah pengguna berhenti mengetik selama 800 milidetik (0.8 detik).
            debounceTimer = setTimeout(() => {
                terjemahkan(teksUntukDiterjemahkan);
            }, 800);
        });

    });
</script>

<?php 
if(isset($_POST['simpan'])){
// $bulan = date('n'); // Bulan dalam angka 1–12
// $periode = ($bulan >= 7) ? 'GENAP' : 'GANJIL';
// $tahunSekarang = date('Y'); // tahun: 2025
// $tahunDepan = $tahunSekarang + 1;

// $tahunAjaran = "$tahunSekarang/$tahunDepan";
  $status='';
  $nama_indo=htmlspecialchars($_POST['nama_b_indo']);
  $nama_inggris=htmlspecialchars($_POST['nama_b_inggris']);
  $kode=htmlspecialchars($_POST['kegiatan']);
  $tanggal=htmlspecialchars($_POST['tanggal']);
  $no=htmlspecialchars($_POST['no']);
      // Menangani gambar
      $file = ($_FILES['file']['error'] === 4) ? NULL : upload();

  $simpan=mysqli_query($koneksi,"INSERT INTO khp (kode,npm,nama_b_indo,nama_b_inggris,tgl_sertifikat,no_sertifikat,file,status,tahun,periode) VALUES ('$kode','$data_id','$nama_indo','$nama_inggris','$tanggal','$no','$file','$status','$tahunAjaran','$periode')");

  if ($simpan) {
    echo "<script>
    Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=khp';
        }
    })</script>";
} else {
    echo "<script>
    Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=khp';
        }
    })</script>";
}
}


if(isset($_POST['update'])){
// $bulan = date('n'); // Bulan dalam angka 1–12
// $periode = ($bulan >= 7) ? 'GENAP' : 'GANJIL';
// $tahunSekarang = date('Y'); // tahun: 2025
// $tahunDepan = $tahunSekarang + 1;

// $tahunAjaran = "$tahunSekarang/$tahunDepan";
  $id=htmlspecialchars($_POST['id_khp']);
  $gl=htmlspecialchars($_POST['gambarLama']);
  $nama_indo=htmlspecialchars($_POST['nama_b_indo']);
  $nama_inggris=htmlspecialchars($_POST['nama_b_inggris']);
  $kode=htmlspecialchars($_POST['kegiatan']);
  $tanggal=htmlspecialchars($_POST['tanggal']);
  $no=htmlspecialchars($_POST['no']);
      // Menangani gambar
$file = ($_FILES['file']['error'] === 4) ? $gl : upload();

  $update=mysqli_query($koneksi,"UPDATE khp SET
  nama_b_indo='$nama_indo',
  nama_b_inggris='$nama_inggris',
  tgl_sertifikat='$tanggal',
  no_sertifikat='$no',
  kode='$kode',
  file='$file'
  WHERE id=$id
  ");

  if ($update) {
    echo "<script>
    Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=khp';
        }
    })</script>";
} else {
    echo "<script>
    Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=khp';
        }
    })</script>";
}


}

// validasi
if(isset($_POST['validasi'])){
    $query_update=mysqli_query($koneksi, "UPDATE khp SET
    status='menunggu'
    WHERE status=''");
      if ($query_update) {
        echo "<script>
        Swal.fire({title: 'Berhasil Validasi',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=khp';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Gagal Validasi',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=khp';
            }
        })</script>";
    }
}




function upload()
{
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    // cek gambar tidak diupload
    if ($error === 4) {
        echo "
        <script>
        alert('pilih file');
        </script>
        
        ";
        return false;
    }
    // cek yang di uplod gambar atau tidak
    $ektensigambarvalid = ['jpg', 'jpeg', 'png', 'webp','jfif','word','pdf','xlsx','csv'];

    $ektensigambar = explode('.', $namafile);
    $ektensigambar = strtolower(end($ektensigambar));
    // cek adakah string didalam array
    if (!in_array($ektensigambar, $ektensigambarvalid)) {
        echo "
        <script>
        alert('yang anda upload bukan file/gambar');
        </script>
        ";

        return false;
    }
    // cek jika ukuran terlalu besar
    if ($ukuranfile > 90000000) {
        echo "
        <script>
        alert('ukuran gambar terlalu besar');
        </script>
        
        ";
        return false;
    }

    // lolos pengecekan , gambar siap di upload
    // generete nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ektensigambar;

    move_uploaded_file($tmpname, '././dist/img/file_skpi_mhs/' . $namafilebaru);

    return $namafilebaru;
}
?>
