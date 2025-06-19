<?php
// PASTIKAN ANDA MEMILIKI AKSES KE VARIABEL INI DARI SESSISON ATAU LOGIN
// CONTOH:
// session_start();
// $data_id = $_SESSION['npm']; 
// $tahunAjaran = '2024/2025'; // Ganti dengan logika Anda untuk mendapatkan tahun ajaran
// $periode = 'Ganjil'; // Ganti dengan logika Anda untuk mendapatkan periode

// Asumsi variabel ini sudah ada dari file/login sebelumnya
// Jika belum, Anda harus mengaturnya di sini
// $data_id = 'NPM_MAHASISWA';
// $tahunAjaran = 'TAHUN_AJARAN_AKTIF';
// $periode = 'PERIODE_AKTIF';

$pesan_sukses = null;
$pesan_error = null;

// BAGIAN LOGIKA PENYIMPANAN DATA (DIPINDAHKAN KE ATAS)
// Agar proses penyimpanan selesai sebelum halaman dirender
if (isset($_POST['simpan'])) {
    $status = ''; // Status awal saat diajukan
    $nama_indo = htmlspecialchars($_POST['nama_b_indo']);
    $nama_inggris = htmlspecialchars($_POST['nama_b_inggris']);
    $kode = htmlspecialchars($_POST['kode']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $no = htmlspecialchars($_POST['no']);
    
    // Asumsi variabel $data_id, $tahunAjaran, $periode sudah tersedia
    // Ganti 'NPM_ANDA', 'TAHUN_SEKARANG', 'PERIODE_SEKARANG' dengan variabel yang benar
    $npm_mhs = $data_id; 

    // Menangani upload file
    $file = ($_FILES['file']['error'] === 4) ? NULL : upload();

    if ($file !== false) {
        $simpan = mysqli_query($koneksi, "INSERT INTO khp (kode, npm, nama_b_indo, nama_b_inggris, tgl_sertifikat, no_sertifikat, file, status, tahun, periode) VALUES ('$kode', '$npm_mhs', '$nama_indo', '$nama_inggris', '$tanggal', '$no', '$file', '$status', '$tahunAjaran', '$periode')");

        if ($simpan) {
            // Sebaiknya, update status di krp_mhs, bukan menghapusnya, untuk rekam jejak
            // Contoh: mysqli_query($koneksi,"UPDATE krp_mhs SET selesai='y' WHERE kode ='$kode' AND npm='$npm_mhs' AND tahun='$tahunAjaran' AND periode='$periode'");
            $pesan_sukses = "Data untuk kegiatan dengan kode <strong>{$kode}</strong> berhasil diajukan.";
        } else {
            $pesan_error = "Terjadi kesalahan saat menyimpan data ke database untuk kode <strong>{$kode}</strong>.";
        }
    } else {
        // Pesan error dari fungsi upload() sudah cukup
        $pesan_error = "Terjadi kesalahan saat mengupload file untuk kode <strong>{$kode}</strong>.";
    }
}

// BAGIAN UTAMA UNTUK MENAMPILKAN DAFTAR KEGIATAN

$query_krp_master = mysqli_query($koneksi, "SELECT * FROM krp");
$dataKegiatan = [];
while ($row = mysqli_fetch_assoc($query_krp_master)) {
    $dataKegiatan[$row['kode']] = [
        'nama' => $row['nama'],
        'bobot' => $row['bobot'],
        'kategori' => $row['kategori']
    ];
}

// Cek apakah ada data checkbox ('krpnilai') yang dikirim
if (isset($_POST['krpnilai']) && is_array($_POST['krpnilai'])) {
    
    $selected_codes = $_POST['krpnilai'];
    
    // PERBAIKAN: Ambil data KHP yang sudah pernah diisi oleh mahasiswa ini
    $npm_mhs_check = $data_id; // Pastikan variabel $data_id terisi NPM mahasiswa
    $query_khp_completed = mysqli_query($koneksi, "SELECT kode FROM khp WHERE npm = '$npm_mhs_check' AND tahun = '$tahunAjaran' AND periode = '$periode'");
    $completed_codes = [];
    while($row = mysqli_fetch_assoc($query_khp_completed)) {
        $completed_codes[] = $row['kode'];
    }

?>
    <div class="kotak-reviewkrp" style="margin-top: 50px;">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px; padding:10px;">
            <h4>Lengkapi Data untuk Menjadi KHP</h4>
        </div>
        <div class="p-3 border shadow-sm">
            <div class="alert alert-primary">
                Berikut adalah daftar kegiatan yang Anda pilih. Silakan lengkapi data untuk setiap kegiatan agar dapat diverifikasi sebagai Kartu Hasil Partisipasi (KHP).
            </div>

            <?php
            // Tampilkan pesan sukses atau error jika ada
            if ($pesan_sukses) {
                echo "<div class='alert alert-success'>{$pesan_sukses}</div>";
            }
            if ($pesan_error) {
                echo "<div class='alert alert-danger'>{$pesan_error}</div>";
            }
            ?>

            <div class="table-responsive mt-4">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode</th>
                            <th>Jenis Kegiatan</th>
                            <th width="20%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Loop untuk membuat baris tabel
                        foreach ($selected_codes as $kode) {
                            if (isset($dataKegiatan[$kode])) {
                                // PERBAIKAN: Cek apakah kode ini sudah ada di KHP
                                $is_completed = in_array($kode, $completed_codes);
                                $button_html = $is_completed
                                    ? '<button type="button" class="btn btn-success btn-sm" disabled><i class="bi bi-check-circle"></i> Sudah Dilengkapi</button>'
                                    : '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLengkapi' . htmlspecialchars($kode) . '">
                                        <i class="bi bi-pencil-square"></i> Lengkapi Data
                                      </button>';

                                echo '
                                <tr>
                                    <td class="text-center">' . $no++ . '</td>
                                    <td>' . htmlspecialchars($kode) . '</td>
                                    <td>' . htmlspecialchars($dataKegiatan[$kode]['nama']) . '</td>
                                    <td class="text-center">' . $button_html . '</td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <a href="?page=add-krp" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali & Ubah Pilihan
                </a>
            </div>
        </div>
    </div>

    <?php
    // PERBAIKAN: Loop kedua ini HANYA untuk membuat semua div modal
    foreach ($selected_codes as $kode) {
        if (isset($dataKegiatan[$kode]) && !in_array($kode, $completed_codes)) {
            $kegiatan = $dataKegiatan[$kode];
            
            // PERBAIKAN: Buat string berisi hidden input untuk semua kode yang dipilih
            $hidden_fields = '';
            foreach ($selected_codes as $c) {
                $hidden_fields .= '<input type="hidden" name="krpnilai[]" value="' . htmlspecialchars($c) . '">';
            }

            // PERBAIKAN: Gunakan ID unik untuk setiap elemen form
            $modal_id = htmlspecialchars($kode);
            
            // Menggunakan sintaks Heredoc (<<<HTML ... HTML;) agar lebih rapi
            echo <<<HTML
            <div class="modal fade" id="modalLengkapi{$modal_id}" tabindex="-1" aria-labelledby="modalLengkapiLabel{$modal_id}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLengkapiLabel{$modal_id}">Lengkapi Data: {$kegiatan['kategori']}</h1>
                        </div>
                        <div class="modal-body">
                            <form action="?page=proses-add-krp" method="post" enctype="multipart/form-data">
                                
                                {$hidden_fields}
                                
                                <input type="hidden" name="kode" value="{$modal_id}">
                                <input type="hidden" name="kategori" value="{$kegiatan['kategori']}">

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kegiatan (dari Sistem)</label>
                                    <input type="text" class="form-control" value="{$kegiatan['nama']}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_b_indo_{$modal_id}" class="form-label">Nama Kegiatan Lengkap (B. Indonesia)</label>
                                    <textarea class="form-control translate-indo" name="nama_b_indo" id="nama_b_indo_{$modal_id}" data-translate-target="nama_b_inggris_{$modal_id}" placeholder="Tulis Lengkap dengan Tahun dan Tempat Pelaksanaan" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_b_inggris_{$modal_id}" class="form-label">Nama Kegiatan Lengkap (B. Inggris)</label>
                                    <textarea class="form-control translate-eng" name="nama_b_inggris" id="nama_b_inggris_{$modal_id}" placeholder="Akan terisi otomatis..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Diterbitkan/Disahkan</label>
                                    <input type="date" class="form-control" name="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Sertifikat / SK / Keterangan Lainnya</label>
                                    <input type="text" class="form-control" name="no" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fileTambah_{$modal_id}" class="form-label">File Bukti (Sertifikat/SK/Lainnya)</label>
                                    <input type="file" class="form-control" name="file" id="fileTambah_{$modal_id}" onchange="previewFile(event, 'filePreview_{$modal_id}', 'previewText_{$modal_id}')" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Preview File</label>
                                    <center>
                                        <iframe id="filePreview_{$modal_id}" style="width: 70%; height: 250px; display: none; border: 1px solid #ccc;">
                                        </iframe>
                                    </center>
                                    <p id="previewText_{$modal_id}" class="text-center text-muted mt-2">Belum ada file dipilih</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="simpan" class="btn btn-primary">Ajukan sebagai KHP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
HTML;
        }
    }
    ?>

<?php
} else {
    // Jika halaman diakses langsung tanpa memilih kegiatan
    echo "<div class='alert alert-danger mt-5'><strong>Error:</strong> Tidak ada kegiatan yang dipilih. Silakan kembali ke halaman sebelumnya dan pilih minimal satu kegiatan.</div>";
    echo '<a href="?page=add-krp" class="btn btn-primary mt-2">Kembali ke Pemilihan KRP</a>';
}

// FUNGSI UPLOAD (TIDAK BERUBAH BANYAK)
function upload()
{
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    // cek gambar tidak diupload
    if ($error === 4) {
        echo "<script>alert('Pilih file yang akan diupload!');</script>";
        return false;
    }
    // cek yang di uplod gambar atau tidak
    $ektensigambarvalid = ['jpg', 'jpeg', 'png', 'webp', 'jfif', 'pdf']; // Batasi ekstensi yang diizinkan
    $ektensigambar = explode('.', $namafile);
    $ektensigambar = strtolower(end($ektensigambar));
    
    if (!in_array($ektensigambar, $ektensigambarvalid)) {
        echo "<script>alert('Format file yang Anda upload tidak diizinkan! Hanya (JPG, PNG, PDF)');</script>";
        return false;
    }
    // cek jika ukuran terlalu besar (misal 5MB)
    if ($ukuranfile > 5000000) {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 5MB.');</script>";
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Jika Anda ingin menggunakan DataTable, pastikan tabelnya punya ID
        // $('#namaTabelAnda').DataTable(); 
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    
    let debounceTimer;

    // Fungsi untuk memanggil API terjemahan
    async function terjemahkan(teks, outputTextarea) {
        if (!teks) {
            outputTextarea.value = '';
            return;
        }
        outputTextarea.placeholder = 'Menerjemahkan...';
        const apiUrl = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(teks)}&langpair=id|en`;

        try {
            const response = await fetch(apiUrl);
            const data = await response.json();
            if (data.responseData && data.responseData.translatedText) {
                outputTextarea.value = data.responseData.translatedText;
            } else {
                outputTextarea.placeholder = 'Terjemahan otomatis tidak berhasil.';
            }
        } catch (error) {
            console.error('API Terjemahan Gagal:', error);
            outputTextarea.placeholder = 'Gagal menghubungi layanan terjemahan.';
        }
    }

    // PERBAIKAN: Gunakan event listener pada semua textarea dengan class 'translate-indo'
    const indoTextareas = document.querySelectorAll('.translate-indo');
    indoTextareas.forEach(input => {
        input.addEventListener('input', function() {
            const teksUntukDiterjemahkan = this.value.trim();
            const targetId = this.getAttribute('data-translate-target');
            const inggrisTextarea = document.getElementById(targetId);

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                terjemahkan(teksUntukDiterjemahkan, inggrisTextarea);
            }, 800);
        });
    });
});

// PERBAIKAN: Fungsi preview file kini lebih dinamis
function previewFile(event, previewFrameId, textElementId) {
    const input = event.target;
    const file = input.files[0];
    const previewFrame = document.getElementById(previewFrameId);
    const textElement = document.getElementById(textElementId);
    
    if (file) {
        const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp'];
        const fileExtension = file.name.split('.').pop().toLowerCase();

        if (allowedExtensions.includes(fileExtension)) {
            const objectUrl = URL.createObjectURL(file);
            previewFrame.src = objectUrl + '#toolbar=0&navpanes=0'; // Tambahkan parameter untuk PDF
            previewFrame.style.display = 'block';
            textElement.innerHTML = `<span class="text-primary">Preview: ${file.name}</span>`;
            
            // Untuk memastikan object URL dilepaskan setelah tidak digunakan
            previewFrame.onload = () => {
                URL.revokeObjectURL(objectUrl);
            }
        } else {
            previewFrame.src = '';
            previewFrame.style.display = 'none';
            textElement.innerHTML = `<span class="text-danger">File dipilih: ${file.name} (Preview tidak didukung untuk tipe file ini)</span>`;
        }
    } else {
        previewFrame.src = '';
        previewFrame.style.display = 'none';
        textElement.innerHTML = 'Belum ada file dipilih';
    }
}
</script>