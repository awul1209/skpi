<?php
// Simulasi data dari database (nanti bisa diganti query SQL)
$query_krp = mysqli_query($koneksi, "SELECT * FROM krp");
$dataKegiatan = [];
while ($row = mysqli_fetch_assoc($query_krp)) {
    $dataKegiatan[$row['kode']] = [
        'nama' => $row['nama'],
        'bobot' => $row['bobot']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['KRPSimpan'])) {
    $kodeDipilih = $_POST['kode'];

    foreach ($kodeDipilih as $kode) {
        if (isset($dataKegiatan[$kode])) {
            $nama = mysqli_real_escape_string($koneksi, $dataKegiatan[$kode]['nama']);
            $bobot = $dataKegiatan[$kode]['bobot'];

            // Lakukan simpan ke tabel hasil_krp (misalnya)
            $queryInsert = mysqli_query($koneksi, "INSERT INTO krp_mhs (kode,npm,bobot,periode,tahun) VALUES ('$kode','$data_id', '$bobot','$periode','$tahunAjaran')");


            if (!$queryInsert) {
                echo "<script>
                Swal.fire({title: 'Gagal Menyimpan',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    document.location.href='?page=krp';
                    }
                })</script>";
            }
        }
    }

    echo "<script>
    Swal.fire({title: 'Berhasil Menyimpan',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=krp';
        }
    })</script>";

} elseif (!isset($_POST['krpnilai'])) {
    echo "Tidak ada kegiatan yang dipilih.";
    exit;
}

$selected = $_POST['krpnilai'];
?>
 	<!-- Alert -->
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="kotak-reviewkrp">
<!-- TAMPILKAN PREVIEW -->
<form method="post" action="">
    <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">List KRP dipilih :</div>
    <p class="text-danger text-center h5 blink border border-1" style="padding:30px 25px">Data yang sudah tersimpan tidak dapat di ubah kembali, Silahkan Cek Terlebih dahulu Rencana Kegiatan Sebelum Disimpan !!! </p>
<div class="table-reviewkrp">
        <table class="activity-table table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Jenis Kegiatan</th>
                <th>Bobot</th>
            </tr>
            </thead>
            <tbody>
            <?php
$no = 1;
$totalBobot = 0; // Inisialisasi total

foreach ($selected as $kode) {
    if (isset($dataKegiatan[$kode])) {
        echo '<tr>';
        echo '<td>' . $no++ . '</td>';
        echo '<td>' . htmlspecialchars($kode) . '</td>';
        echo '<td>' . htmlspecialchars($dataKegiatan[$kode]['nama']) . '</td>';
        echo '<td>' . htmlspecialchars($dataKegiatan[$kode]['bobot']) . '</td>';
        echo '</tr>';

        // Tambahkan ke total
        $totalBobot += $dataKegiatan[$kode]['bobot'];

        // Kirim lagi datanya via hidden input ke halaman simpan
        echo '<input type="hidden" name="kode[]" value="' . htmlspecialchars($kode) . '">';
    }
}
?>

<tr>
    <td colspan="3" class="text-bold">TOTAL</td>
    <td class="text-bold fs-2"><?php echo $totalBobot; ?></td>
</tr>

            </tbody>
        </table>
</div>
        <!-- TOMBOL -->
        <div class="mt-2">
        <a href="?page=krp"><button type="button" class="btn text-white" style="background-color:#042366;">Kembali</button></a>
        <button type="submit" class="btn text-white" name="KRPSimpan" style="background-color:#042366;">Simpan</button>
        </div>
    </form>
</div>



