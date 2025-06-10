<?php

// --- Ambil data dari tabel KHP (Riwayat kegiatan yang sudah selesai) ---
// 1A. Ambil SEMUA riwayat KHP untuk menonaktifkan pilihan
$query_khp = mysqli_query($koneksi, "SELECT kode FROM khp WHERE npm='$data_id'");
$kode_di_khp = [];
while ($row_khp = mysqli_fetch_assoc($query_khp)) {
    $kode_di_khp[] = $row_khp['kode'];
}
$query_krp_mhs = mysqli_query($koneksi, "SELECT kode FROM krp_mhs WHERE npm='$data_id'");
$kode_di_krp_mhs = [];
while ($row_krp_mhs = mysqli_fetch_assoc($query_krp_mhs)) {
    $kode_di_krp_mhs[] = $row_krp_mhs['kode'];
}

// 1B. Ambil riwayat KHP WAJIB untuk PERIODE SAAT INI (untuk logika tampilan "Anda sudah memilih...")
$query_khp_saat_ini = mysqli_query($koneksi, "SELECT kode FROM khp WHERE npm='$data_id' AND tahun='$tahunAjaran' AND periode='$periode' AND kode IN ('WU001', 'WU002')");
$kode_khp_wajib_saat_ini = [];
while($row_khp_now = mysqli_fetch_assoc($query_khp_saat_ini)) {
    $kode_khp_wajib_saat_ini[] = $row_khp_now['kode'];
}

// --- Ambil data dari tabel KRP_MHS (Kegiatan yang baru direncanakan) ---
// 2. Ambil kegiatan yang sudah direncanakan di KRP untuk PERIODE SAAT INI
$query_krp_mhs = mysqli_query($koneksi, "SELECT kode FROM krp_mhs WHERE npm='$data_id' AND tahun='$tahunAjaran' AND periode='$periode'");
$kode_direncanakan_saat_ini = [];
while ($row_krp = mysqli_fetch_assoc($query_krp_mhs)) {
    $kode_direncanakan_saat_ini[] = $row_krp['kode'];
}

$wajib = [
    'WU001' => ['label' => 'PKKMB (Peserta)', 'bobot' => 25],
    'WU002' => ['label' => 'Dies Natalis (Peserta)', 'bobot' => 10]
];
?>


<div class="kotak-krp">
<h2>Kartu Rencana Partisipasi ( Periode Aktif : <?= $tahunAjaran ?>-<?= $periode ?>)</h2>
<div class="krp-alert">
  <strong>Kartu Rencana Partisipasi (KRP)</strong> Adalah Rencana Kegiatan yang akan diikuti, silahkan Pilih Beberapa Rencana Kegiatan Untuk Semester Depan !!!
</div>

<form  method="post" action="?page=data-krp">

<!-- kategori wajib -->
<div class="kategori-wajib">
     <?php
        if (count($kode_khp_wajib_saat_ini) >= 1) {
            echo "<div class='alert alert-success'>Anda sudah menyelesaikan salah satu kategori wajib untuk periode ini.</div>";
            $kode_sisa = array_diff(array_keys($wajib), $kode_di_khp);
            if (!empty($kode_sisa)) {
                echo '<div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Silakan pilih satu lagi jika diperlukan</div>';
                echo '<div class="table-container"><table class="activity-table table table-hover"><thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead><tbody>';
                $no = 1;
                foreach ($kode_sisa as $kode) {
                    $sudah_direncanakan = in_array($kode, $kode_direncanakan_saat_ini);
                    $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                    echo "<tr><td>{$no}</td><td>{$kode}</td><td>{$wajib[$kode]['label']}</td><td>{$wajib[$kode]['bobot']}</td><td><input type='checkbox' name='krpnilai[]' value='{$kode}' class='krp-checkbox' {$data_attribute_krp}></td></tr>";
                    $no++;
                }
                echo '</tbody></table></div>';
            }
        } else {
        ?>
            <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Wajib Universitas/Fakultas</div>
            <div class="table-container">
                <table class="activity-table table table-hover">
                    <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($wajib as $kode => $data) {
                            $pernah_diselesaikan = in_array($kode, $kode_di_khp);
                            $sudah_direncanakan = in_array($kode, $kode_direncanakan_saat_ini);
                            $row_class = $pernah_diselesaikan ? 'class="row-disabled"' : '';
                            $attributes = $pernah_diselesaikan ? 'disabled' : '';
                            $data_attribute_khp = $pernah_diselesaikan ? 'data-pernah-diambil="true"' : '';
                            $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                        ?>
                        <tr <?= $row_class ?>>
                            <td class="text-center"><?= $no ?></td><td class="text-center"><?= $kode ?></td><td><?= $data['label'] ?></td><td class="text-center"><?= $data['bobot'] ?></td>
                            <td class="text-center"><input type="checkbox" name="krpnilai[]" value="<?= $kode ?>" class="krp-checkbox" <?= $attributes ?> <?= $data_attribute_khp ?> <?= $data_attribute_krp ?>></td>
                        </tr>
                        <?php 
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
</div>


<!-- end wajib universitas -->


    
    <!-- organisasi -->
    <div class="kotak-organisasi">
    <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Organisasi dan Kepemimpinan</div>
   <div class="table-container table-responsive" style="max-height: 370px; overflow-y: auto;">
            <table class="activity-table table table-hover">
                <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead>
                <tbody>
                    <?php
                    $query_kegiatan_org = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='Organisasi dan Kepemimpinan' ORDER BY kode ASC");
                    $no = 1;
                    while ($kegiatan = mysqli_fetch_assoc($query_kegiatan_org)) {
                        $kode_kegiatan = $kegiatan['kode'];
                        $sudah_direncanakan = in_array($kode_kegiatan, $kode_direncanakan_saat_ini);
                        $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                    ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['kode']) ?></td><td><?= htmlspecialchars($kegiatan['nama']) ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['bobot']) ?></td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="<?= htmlspecialchars($kegiatan['kode']) ?>" class="krp-checkbox" <?= $data_attribute_krp ?>></td>
                    </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        
    </div>
</div>

    <!-- end organisasi -->

    <!-- penalaran -->
  <div class="kotak-penalaran" style="margin-bottom: 30px;">
    <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Penalaran dan Keilmuan</div>
    <div class="table-container table-responsive" style="max-height: 370px; overflow-y: auto;">
        <table class="activity-table table table-hover">
                <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead>
                <tbody>
                    <?php
                    $query_kegiatan_org = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='Penalaran dan Keilmuan' ORDER BY kode ASC");
                    $no = 1;
                    while ($kegiatan = mysqli_fetch_assoc($query_kegiatan_org)) {
                        $kode_kegiatan = $kegiatan['kode'];
                        $sudah_direncanakan = in_array($kode_kegiatan, $kode_direncanakan_saat_ini);
                        $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                    ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['kode']) ?></td><td><?= htmlspecialchars($kegiatan['nama']) ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['bobot']) ?></td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="<?= htmlspecialchars($kegiatan['kode']) ?>" class="krp-checkbox" <?= $data_attribute_krp ?>></td>
                    </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
    </div>
</div>
    <!-- end penalaran -->

    <!-- minat -->
    <div class="kotak-minat">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Minat dan Bakat</div>
        <div class="table-container" style="max-height: 370px; overflow-y: auto;">
            <table class="activity-table table table-hover">
                <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead>
                <tbody>
                    <?php
                    $query_kegiatan_org = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='Minat dan Bakat' ORDER BY kode ASC");
                    $no = 1;
                    while ($kegiatan = mysqli_fetch_assoc($query_kegiatan_org)) {
                        $kode_kegiatan = $kegiatan['kode'];
                        $sudah_direncanakan = in_array($kode_kegiatan, $kode_direncanakan_saat_ini);
                        $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                    ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['kode']) ?></td><td><?= htmlspecialchars($kegiatan['nama']) ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['bobot']) ?></td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="<?= htmlspecialchars($kegiatan['kode']) ?>" class="krp-checkbox" <?= $data_attribute_krp ?>></td>
                    </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
     </div>
    <!-- end minat -->

        <!-- sosial -->
        <div class="kotak-sosial">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Sosial dan Lainnya</div>
        <div class="table-container" style="max-height: 370px; overflow-y: auto;">
            <table class="activity-table table table-hover">
                <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead>
                <tbody>
                    <?php
                    $query_kegiatan_org = mysqli_query($koneksi, "SELECT * FROM krp WHERE kategori='Sosial dan Lainnya' ORDER BY kode ASC");
                    $no = 1;
                    while ($kegiatan = mysqli_fetch_assoc($query_kegiatan_org)) {
                        $kode_kegiatan = $kegiatan['kode'];
                        $sudah_direncanakan = in_array($kode_kegiatan, $kode_direncanakan_saat_ini);
                        $data_attribute_krp = $sudah_direncanakan ? 'data-sudah-direncanakan="true"' : '';
                    ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['kode']) ?></td><td><?= htmlspecialchars($kegiatan['nama']) ?></td><td class="text-center"><?= htmlspecialchars($kegiatan['bobot']) ?></td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="<?= htmlspecialchars($kegiatan['kode']) ?>" class="krp-checkbox" <?= $data_attribute_krp ?>></td>
                    </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
     </div>
    <!-- end sosial -->

        <!-- button -->
        <div class="mt-4 mb-4">
        <button name="KRPLanjut" type="submit" class="btn text-white" style="background-color:#042366;">Lanjutkan</button>
        </div>
</form>
</div>
<!-- Tombol Scroll to Top -->
<button onclick="scrollToTop()" id="scrollTopBtn" title="Kembali ke atas">
  ↑
</button>

<style>
	#scrollTopBtn {
  position: fixed;
  bottom: 40px;
  right: 40px;
  z-index: 99;
  background-color: #042366;
  color: white;
  border: none;
  outline: none;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  display: none;
  transition: all 0.3s ease;
}

#scrollTopBtn:hover {
  background-color: #042366;
}


</style>

<script>
  // Tampilkan tombol saat scroll ke bawah
  window.onscroll = function() {
    const btn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  // Scroll ke atas dengan smooth behavior
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const semuaCheckbox = document.querySelectorAll('.krp-checkbox');

    semuaCheckbox.forEach(function(checkbox) {
        checkbox.addEventListener('click', function(event) {
            
            // Prioritas 1: Cek apakah kegiatan sudah pernah diselesaikan (dari KHP)
            if (this.dataset.pernahDiambil === 'true') {
                event.preventDefault();
                this.checked = false;
                alert('Peringatan: Anda sudah pernah menyelesaikan kegiatan ini!');
            } 
            // Prioritas 2: Jika tidak, baru cek apakah sudah direncanakan (dari KRP_MHS)
            else if (this.dataset.sudahDirencanakan === 'true') {
                event.preventDefault();
                this.checked = false;
                alert('Informasi: Kegiatan ini sudah ada di KRP Anda untuk periode ini.');
            }
        });
    });
});
</script>
