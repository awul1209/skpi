<?php


$jenis='';
$periode='';
$tahun='';
if(isset($_POST['tampilkan'])){
  $jenis=$_POST['jenis'];
  $tahun=$_POST['tahun'];
  $periode=$_POST['semester'];
}



?>

<!-- Tambahkan link ke Bootstrap CSS jika belum -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="kotak-histori">


  <form action="" method="post" class="d-flex gap-2 align-items-center flex-wrap bg-white p-3 rounded shadow-sm">

    <!-- Jenis -->
    <select name="jenis" class="form-select" style="max-width: 300px;">
      <option value="">Pilih Jenis</option>
      <option value="KRP">Kartu Rencana Partisipasi (KRP)</option>
      <option value="KHP">Kartu Hasil Partisipasi (KHP)</option>
    </select>

    <!-- Tahun Akademik -->
    <select name="tahun" class="form-select" style="max-width: 250px;">
      <option value="">Pilih Tahun Akademik</option>
      <?php
        for ($i = 2020; $i <= date('Y'); $i++) {
            $next = $i + 1;
            echo "<option value='$i/$next'>$i/$next</option>";
        }
      ?>
    </select>

    <!-- Semester -->
    <select name="semester" class="form-select" style="max-width: 250px;">
      <option value="">Pilih Semester</option>
      <option value="GANJIL">Ganjil</option>
      <option value="GENAP">Genap</option>
    </select>

    <!-- Tombol Tampilkan -->
    <button type="submit" class="btn btn-primary text-white" name="tampilkan">Tampilkan</button>
    
    <!-- Tombol Reset -->
    <button type="submit" class="btn btn-danger text-white">Reset</button>
  
  </form>

  <?php if($tahun=='') { ?>
  <!-- alert -->
<div class="alert alert-warning alert-dismissible fade show mt-3 " role="alert">
<strong>⚠ Belum ada Jenis data Histori yang dipilih ... !!!</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } else { ?>


<div class="kotak-hasil-histori">


 <!-- wajib univ -->
 <div class="kotak-histori-header">
    <div class="kotak1">
        <h2>Data Histori <?= $jenis ?> <?= $tahun ?> <?= $periode ?></h2>
    </div>
    <div class="kotak2">
        <a href="././cetak/cetak_histori.php" target="_blank" class="btn btn-primary">Cetak</a>
    </div>
</div>

<div class="table-historikrp wajib_univ">
      <h3>1. Wajib Universitas</h3>
      <?php
      if($jenis=='KRP'){
            $query = mysqli_query($koneksi, "SELECT krp_mhs.kode,krp.nama,krp.kategori,krp_mhs.npm FROM `krp_mhs` JOIN krp ON krp_mhs.kode=krp.kode
            WHERE kategori = 'Wajib Universitas' and npm='$data_id' and krp_mhs.tahun='$tahun' and krp_mhs.periode='$periode'");
      }else if($jenis=='KHP'){
            $query = mysqli_query($koneksi, "SELECT khp.kode,khp.npm,krp.nama,khp.tahun,khp.periode,krp.kategori FROM `khp` JOIN krp ON khp.kode=krp.kode WHERE khp.tahun='$tahun' and periode='$periode' and kategori='Wajib Universitas'and npm='$data_id' and status='menunggu'");
      }
            if (mysqli_num_rows($query) > 0) {
      ?>
             <table class="activity-table table table-hover w-100">
                <thead>
                    <tr>
      <th style="width: 30px;">No</th>
      <th style="width: 50px;">Kode</th>
      <th class="text-start">Jenis Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)) { 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kode'] ?></td>
                            <td class="text-start"><?= $row['nama'] ?></td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
              <?php  } else { ?>

                        <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                        Belum ada data yang ditambahkan pada Kategori <strong>'  Wajib Universitas/Fakultas  '</strong> ... !!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>
            <hr>
        </div>
      <!-- end wajib univ -->

<!-- Organisasi dan Kepemimpinan-->
    <div class="table-historikrp organisasi">
    <h3>2. Organisasi dan Kepemimpinan</h3>
    <?php
          if($jenis=='KRP'){
            $query = mysqli_query($koneksi, "SELECT krp_mhs.kode,krp.nama,krp.kategori,krp_mhs.npm FROM `krp_mhs` JOIN krp ON krp_mhs.kode=krp.kode
        WHERE kategori = 'Organisasi dan Kepemimpinan' and npm='$data_id' and krp_mhs.tahun='$tahun' and krp_mhs.periode='$periode'");
      }else if($jenis=='KHP'){
            $query = mysqli_query($koneksi, "SELECT khp.kode,khp.npm,krp.nama,khp.tahun,khp.periode,krp.kategori FROM `khp` JOIN krp ON khp.kode=krp.kode WHERE khp.tahun='$tahun' and periode='$periode' and kategori='Organisasi dan Kepemimpinan'and npm='$data_id' and status='menunggu'");
      }

        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover w-100">
                <thead>
                    <tr>
      <th style="width: 30px;">No</th>
      <th style="width: 50px;">Kode</th>
      <th class="text-start">Jenis Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)) { 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kode'] ?></td>
                            <td class="text-start"><?= $row['nama'] ?></td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
            <?php  } else { ?>
            <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
            Belum ada data yang ditambahkan pada Kategori <strong>' Organisasi dan Kepemimpinan  '</strong> ... !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
            <hr>
        </div>
      <!-- end Organisasi dan Kepemimpinan-->

<!--	Penalaran dan Keilmuan 	-->
    <div class="table-historikrp penalaran">
    <h3>3. Penalaran dan Keilmuan</h3>
    <?php
              if($jenis=='KRP'){
                $query = mysqli_query($koneksi, "SELECT krp_mhs.kode,krp.nama,krp.kategori,krp_mhs.npm FROM `krp_mhs` JOIN krp ON krp_mhs.kode=krp.kode
        WHERE kategori = 'Penalaran dan Keilmuan' and npm='$data_id' and krp_mhs.tahun='$tahun' and krp_mhs.periode='$periode'");
          }else if($jenis=='KHP'){
                $query = mysqli_query($koneksi, "SELECT khp.kode,khp.npm,krp.nama,khp.tahun,khp.periode,krp.kategori FROM `khp` JOIN krp ON khp.kode=krp.kode WHERE khp.tahun='$tahun' and periode='$periode' and kategori='Penalaran dan Keilmuan'and npm='$data_id' and status='menunggu'");
          }

        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
      <th style="width: 30px;">No</th>
      <th style="width: 50px;">Kode</th>
      <th class="text-start">Jenis Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kode'] ?></td>
                            <td class="text-start"><?= $row['nama'] ?></td>
                        </tr>
                    <?php }
                } else { ?>

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
    <div class="table-historikrp minat">
    <h3>4. Minat dan Bakat </h3>
    <?php
          if($jenis=='KRP'){
                $query = mysqli_query($koneksi, "SELECT krp_mhs.kode,krp.nama,krp.kategori,krp_mhs.npm FROM `krp_mhs` JOIN krp ON krp_mhs.kode=krp.kode
                WHERE kategori = 'Minat dan Bakat' and npm='$data_id' and krp_mhs.tahun='$tahun' and krp_mhs.periode='$periode'");
          }else if($jenis=='KHP'){
                $query = mysqli_query($koneksi, "SELECT khp.kode,khp.npm,krp.nama,khp.tahun,khp.periode,krp.kategori FROM `khp` JOIN krp ON khp.kode=krp.kode WHERE khp.tahun='$tahun' and periode='$periode' and kategori='Minat dan Bakat'and npm='$data_id' and status='menunggu'");
          }

        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
      <th style="width: 30px;">No</th>
      <th style="width: 50px;">Kode</th>
      <th class="text-start">Jenis Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                        while($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td class="text-start"><?= $row['nama'] ?></td>
                            </tr>
                        <?php }
                    } else { ?>

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
    <div class="table-historikrp sosial">
    <h3>5. Sosial dan Lainnya</h3>
    <?php
              if($jenis=='KRP'){
                $query = mysqli_query($koneksi, "SELECT krp_mhs.kode,krp.nama,krp.kategori,krp_mhs.npm FROM `krp_mhs` JOIN krp ON krp_mhs.kode=krp.kode
        WHERE kategori = 'Sosial dan Lainnya' and npm='$data_id' and krp_mhs.tahun='$tahun' and krp_mhs.periode='$periode'");
          }else if($jenis=='KHP'){
                $query = mysqli_query($koneksi, "SELECT khp.kode,khp.npm,krp.nama,khp.tahun,khp.periode,krp.kategori FROM `khp` JOIN krp ON khp.kode=krp.kode WHERE khp.tahun='$tahun' and periode='$periode' and kategori='Sosial dan Lainnyat'and npm='$data_id' and status='menunggu'");
          }

        if (mysqli_num_rows($query) > 0) {
    ?>
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
      <th style="width: 50px;">No</th>
      <th style="width: 100px;">Kode</th>
      <th class="text-start">Jenis Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                        while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['kode'] ?></td>
                                <td class="text-start"><?= $row['nama'] ?></td>
                            </tr>
                        <?php }
                    } else { ?>

                            <div class="alert alert-warning alert-dismissible fade show mt-1 ms-3 me-3" role="alert">
                            Belum ada data yang ditambahkan pada Kategori <strong>' Sosial dan Lainnyat  '</strong> ... !!!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php } ?>

                </tbody>
            </table>

        </div>
      <!-- end Sosial dan Lainnya-->
       <!-- end historikrp -->
        <?php } ?>

        </div>
       
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>