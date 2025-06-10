<?php
// Pastikan SweetAlert2 sudah dimuat
// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

// ==================== LANGKAH 1: AMANKAN VARIABEL SESSION ====================
// Ambil NPM dari session dan simpan ke variabel yang 'aman' dan deskriptif.
// Ganti $_SESSION['npm'] sesuai dengan nama session Anda.
$npm_mahasiswa_aktif = $data_id; // Menggunakan $data_id yang Anda bilang sudah benar di awal.

// Kita akan gunakan $npm_mahasiswa_aktif untuk semua proses simpan.
// ============================================================================


// Ambil semua data kegiatan sekali saja di atas
$query_krp = mysqli_query($koneksi, "SELECT * FROM krp");
$dataKegiatan = [];
while ($row = mysqli_fetch_assoc($query_krp)) {
    $dataKegiatan[$row['kode']] = [
        'nama' => $row['nama'],
        'bobot' => $row['bobot']
    ];
}

// JIKA TOMBOL SIMPAN DI HALAMAN REVIEW DITEKAN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['KRPSimpan'])) {
    
    $kodeDipilih = $_POST['kode'];
    $periode = $_POST['periode'];
    $tahunAjaran = $_POST['tahunAjaran'];

    // Lakukan proses INSERT
    foreach ($kodeDipilih as $kode) {
        if (isset($dataKegiatan[$kode])) {
            $nama = mysqli_real_escape_string($koneksi, $dataKegiatan[$kode]['nama']);
            $bobot = $dataKegiatan[$kode]['bobot'];
            
            // ==================== LANGKAH 2: GUNAKAN VARIABEL AMAN ====================
            // Ganti $data_id dengan $npm_mahasiswa_aktif di dalam query INSERT
            $queryInsert = mysqli_query($koneksi, "INSERT INTO krp_mhs (kode,npm,bobot,periode,tahun) VALUES ('$kode','$npm_mahasiswa_aktif', '$bobot','$periode','$tahunAjaran')");
            // ========================================================================

            if (!$queryInsert) {
                echo "<script>
                Swal.fire({title: 'Gagal Menyimpan',text: 'Terjadi kesalahan saat menyimpan data.',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    document.location.href='?page=krp';
                    }
                })</script>";
                exit; 
            }
        }
    }

    // Jika loop selesai tanpa error, tampilkan notifikasi sukses
    echo "<script>
    Swal.fire({title: 'Berhasil Menyimpan',text: 'Data KRP Anda telah disimpan.',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=krp';
        }
    })</script>";

} 
// JIKA HALAMAN INI DITAMPILKAN PERTAMA KALI
elseif (isset($_POST['krpnilai']) && is_array($_POST['krpnilai'])) {
    
    $selected = $_POST['krpnilai'];
?>
    <div class="kotak-reviewkrp">
        <form method="post" action="">
            <input type="hidden" name="periode" value="<?= htmlspecialchars($periode) ?>">
            <input type="hidden" name="tahunAjaran" value="<?= htmlspecialchars($tahunAjaran) ?>">
            <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">List KRP dipilih :</div>
            <p class="text-danger text-center h5 blink border border-1" style="padding:30px 25px">Data yang sudah tersimpan tidak dapat di ubah kembali, Silahkan Cek Terlebih dahulu Rencana Kegiatan Sebelum Disimpan !!!</p>
            <div class="table-reviewkrp">
                <table class="activity-table table table-hover">
                    <thead><tr><th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th></tr></thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $totalBobot = 0;
                        foreach ($selected as $kode) {
                            if (isset($dataKegiatan[$kode])) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . htmlspecialchars($kode) . '</td>';
                                echo '<td>' . htmlspecialchars($dataKegiatan[$kode]['nama']) . '</td>';
                                echo '<td>' . htmlspecialchars($dataKegiatan[$kode]['bobot']) . '</td>';
                                echo '</tr>';
                                $totalBobot += $dataKegiatan[$kode]['bobot'];
                                echo '<input type="hidden" name="kode[]" value="' . htmlspecialchars($kode) . '">';
                            }
                        }
                        ?>
                        <tr><td colspan="3" class="text-bold">TOTAL</td><td class="text-bold fs-2"><?php echo $totalBobot; ?></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <a href="?page=krp"><button type="button" class="btn text-white" style="background-color:#042366;">Kembali</button></a>
                <button type="submit" class="btn text-white" name="KRPSimpan" style="background-color:#042366;">Simpan</button>
            </div>
        </form>
    </div>
<?php
} else {
    echo "Tidak ada kegiatan yang dipilih. Silakan kembali dan pilih kegiatan.";
    echo '<br><a href="?page=krp">Kembali ke Pemilihan KRP</a>';
}
?>