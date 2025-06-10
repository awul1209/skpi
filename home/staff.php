<!-- Bootstrap CSS (pastikan ini ada di <head>) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="row kotak-staf" style="margin-top: 50px;">

<div class="kotak-chart-staff">
    <div class="kotak-chart1">
        <canvas id="myChart1"></canvas>
    </div>
    <div class="kotak-chart2">
        <canvas id="myChart2"></canvas>
    </div>
</div>
<div class="card w-100" style="margin: 5px;">
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
				<tr>
                <th>No</th>
                <th>Npm</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Kategori</th>
                <th>Judul (Idn)</th>
                <th>Judul (Eng)</th>
                <th>file</th>
                <th>Skor</th>
                <th>Verivikasi</th>
            </tr>
					</tr>
				</thead>
				<tbody>
				  <?php 
                    $no = 1;
                    $total_bobot = 0;
                    $query=mysqli_query($koneksi,"SELECT khp.id AS id_khp, krp.kategori,khp.npm, krp.bobot, prodi.nama_prodi,khp.*, mahasiswa.*
                    FROM khp
                    JOIN mahasiswa ON khp.npm = mahasiswa.npm
                    JOIN krp on khp.kode=krp.kode
                    JOIN prodi on mahasiswa.prodi_id=prodi.id_prodi
                    JOIN fakultas on prodi.fakultas_id=fakultas.id_fakultas
                    WHERE  khp.status = 'menunggu' AND id_fakultas='$fakultas_id'");
                    while($row = mysqli_fetch_assoc($query)) { 
                        $total_bobot += $row['bobot'];
                        ?>
                                               
                        <tr>
                            <td class="text-center"><b><?= $no++; ?></b></td>
                            <td><?= $row['npm'] ?></td>
                            <td><?= $row['nama_lengkap'] ?></td>
                            <td><?= $row['nama_prodi'] ?></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                           
                            <td>
                               <a href="#" data-bs-toggle="modal" data-bs-target="#modalView<?= $row['id_khp'] ?>" title="View">
                                   <i class="bi bi-eye fs-5 text-decoration-none"></i>
                                </a>
                                
                                <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" title="Download" download>
                                  <i class="bi bi-cloud-download fs-5 text-decoration-none"></i></a>
                                </td>
                                <form action="" method="post">
                                  <input type="hidden" name="id_khp" value="<?= $row['id_khp'] ?>">
                                  <td class="text-center"><?= $row['bobot'] ?></td>
                                  
                                  <td class="text-center">
                                    <button type="submit" name="setuju" class="btn text-white">Setujui</button>
                                  </form>
                                   <a href="#" data-bs-toggle="modal" data-bs-target="#modaltolak<?= $row['id_khp'] ?>" title="View" class="btn text-white mt-2 p-1" style="background-color: red;">
                                   Tolak
                                </a>
                          </td>
                          </tr>

<!-- modal view -->
<div class="modal fade" id="modalView<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">File Kegiatan - <?= $row['kategori'] ?></h1>
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
<!-- end modal view -->
<!-- modal tolak -->
<div class="modal fade" id="modaltolak<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Kategori Kegiatan <?= $row['kategori'] ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <input type="hidden" name="id_khp" value="<?= $row['id_khp'] ?>">
       <textarea name="ket" id="" class="form-control" style="height: 150px;"></textarea>
          <!-- Tombol -->
          <div class="modal-footer">
            <button type="submit" name="tolak" class="mt-2 btn text-white" style="background-color: red;">Tolak</button>
          </div>
             </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal tolak -->
                           <?php } ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	</div>
	<!-- /.card-body -->
</div>

<!-- Bootstrap JS dan Popper.js (taruh sebelum </body>) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
  const ctx1 = document.getElementById('myChart1');

  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026'],
      datasets: [{
        label: '# Data Mahasiswa',
        data: [300, 500, 450, 650, 750, 400,600,800,900,650],
        backgroundColor:'#042366',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


<?php
// ASUMSI: Anda sudah memiliki koneksi database $koneksi
// ASUMSI: Variabel $fakultas_id sudah didefinisikan

// --- Langkah 1: Ambil Data Labels (Nama Prodi) dan Siapkan untuk Mengambil Data Nilai ---
// Ambil ID dan nama prodi untuk fakultas yang dipilih
// Pastikan nama tabel 'prodi' dan kolom 'id_prodi', 'nama_prodi', 'fakultas_id' sesuai
$sql_prodi = "SELECT id_prodi, nama_prodi FROM prodi WHERE fakultas_id = '$fakultas_id'";
$query_prodi = mysqli_query($koneksi, $sql_prodi);

$prodi_labels = [];      // Array PHP untuk menampung label (nama prodi)
$prodi_data_values = []; // Array PHP untuk menampung nilai data (jumlah mahasiswa)

if ($query_prodi) {
    // Check if any prodi were found for the faculty
    if (mysqli_num_rows($query_prodi) > 0) {
        while ($row = mysqli_fetch_assoc($query_prodi)) {
            $prodi_labels[] = $row['nama_prodi'];
            $prodi_id = $row['id_prodi']; // Ambil ID prodi untuk query selanjutnya
            // --- Langkah 2: Hitung Jumlah Mahasiswa per Prodi (Sub-Query) ---
            // Lakukan query COUNT di tabel 'mahasiswa' untuk prodi_id yang sedang diproses
            // Pastikan nama tabel 'mahasiswa' dan kolom 'prodi_id' sesuai
            $sql_count_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa WHERE prodi_id = '$prodi_id'";
            $query_count_mahasiswa = mysqli_query($koneksi, $sql_count_mahasiswa);

            $total_mahasiswa = 0; // Default value jika query gagal atau tidak ada mahasiswa
            if ($query_count_mahasiswa) {
                $count_row = mysqli_fetch_assoc($query_count_mahasiswa);
                if ($count_row && isset($count_row['total_mahasiswa'])) {
                    $total_mahasiswa = $count_row['total_mahasiswa'];
                }
                // Penting: Bebaskan hasil query COUNT untuk menghindari masalah memori/resource
                 mysqli_free_result($query_count_mahasiswa);
            } else {
                // Tangani error pada query COUNT (opsional, bisa hanya log error)
                error_log("Error counting mahasiswa for prodi_id $prodi_id: " . mysqli_error($koneksi));
                // Lanjutkan, total_mahasiswa tetap 0
            }

            // --- Langkah 3: Simpan Nilai Data (Jumlah Mahasiswa) ---
            $prodi_data_values[] = $total_mahasiswa;
        }

        // Penting: Bebaskan hasil query PRODI utama setelah loop selesai
         mysqli_free_result($query_prodi);

    } else {
        // Tidak ada program studi yang ditemukan untuk fakultas ini
        echo '<p>Tidak ada data program studi untuk fakultas ini.</p>';
        // Set array kosong agar JSON tetap valid, grafik tidak akan muncul
        $prodi_labels = [];
        $prodi_data_values = [];
    }

} else {
    // Tangani jika query prodi utama gagal
    echo "Error fetching prodi data: " . mysqli_error($koneksi);
    $prodi_labels = []; // Tetapkan array kosong jika error
    $prodi_data_values = [];   // Tetapkan array kosong jika error
}

// --- Langkah 4: Siapkan Warna Latar Belakang Dinamis ---
// Siapkan array warna. Chart.js akan mengulang warna jika jumlah data lebih banyak.
$backgroundColors = [
    '#042366', 'rgb(142, 144, 255)', 'rgb(255, 205, 86)',
    'rgb(201, 203, 207)', 'rgb(54, 162, 235)', 'rgb(153, 102, 255)',
    'rgb(255, 159, 64)', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
    '#9966FF', '#FF9F40', '#E7E9ED', '#8AC926', '#FFCA3A'
    // Tambahkan lebih banyak warna jika diperlukan
];
$json_background_colors = json_encode($backgroundColors);


// --- Langkah 5: Encode Array PHP ke JSON untuk Digunakan di JavaScript ---
$json_labels = json_encode($prodi_labels);
$json_data = json_encode($prodi_data_values);

?>

<canvas id="myChart2"></canvas>

<script>
  // Tunggu sampai DOM siap
  document.addEventListener('DOMContentLoaded', function() {
    const ctx2 = document.getElementById('myChart2');

    // Periksa apakah elemen canvas ditemukan DAN apakah ada data yang akan ditampilkan
    // Jika $json_data adalah '[]' (array kosong), maka tidak ada data
    // Pastikan $json_data dicetak oleh PHP sebelum blok script ini
    if (ctx2 && <?php echo $json_data; ?>.length > 0) {
      new Chart(ctx2, {
        type: 'pie', // Tipe grafik Pie
        data: {
          // Gunakan data JSON yang dicetak dari PHP
          // Pastikan $json_labels dicetak oleh PHP
          labels: <?php echo $json_labels; ?>, // Akan mencetak seperti: ["Prodi A", "Prodi B", ...]
          datasets: [{
            label: 'Jumlah Mahasiswa', // Label untuk dataset
            // Pastikan $json_data dicetak oleh PHP
            data: <?php echo $json_data; ?>, // Akan mencetak seperti: [nilai1, nilai2, ...]
            // Pastikan $json_background_colors dicetak oleh PHP
            backgroundColor: <?php echo $json_background_colors; ?> // Array warna
            // borderColor dan borderWidth bisa ditambahkan jika diperlukan
            // borderColor: '#ffffff',
            // borderWidth: 1
          }]
        },
        options: {
          responsive: true, // Grafik akan menyesuaikan ukuran container
          plugins: {
            legend: {
              position: 'top', // Posisi legenda (di atas grafik)
              labels: {
                  // Gaya label legenda
              }
            },
            title: {
              display: true, // Tampilkan judul grafik
              text: 'Jumlah Mahasiswa Per Program Studi di Fakultas <?= $nama_fakultas ?>' // Teks judul
            },
            tooltip: { // Konfigurasi tooltip (pop-up saat hover)
                callbacks: {
                    label: function(context) {
                        let label = context.label || ''; // Ambil label prodi
                        if (label) {
                            label += ': ';
                        }
                        // Tampilkan jumlah mahasiswa dari nilai data
                        if (context.parsed !== null) {
                             // context.parsed berisi nilai data (jumlah mahasiswa)
                            label += context.parsed + ' mahasiswa'; // Tambahkan teks ' mahasiswa'
                        }
                        return label;
                    }
                }
            }
          },
        }
      });
    } else if (ctx2) {
         // Jika canvas ada tapi data_values dari PHP kosong, tampilkan pesan
         console.log('Tidak ada data mahasiswa yang ditemukan untuk fakultas ini.');
         // Opsional: Ganti elemen canvas dengan pesan
         const container = ctx2.parentElement;
         if(container) {
             container.innerHTML = '<p>Tidak ada data mahasiswa untuk fakultas ini yang ditemukan.</p>';
         }

    } else {
      // Jika elemen canvas tidak ditemukan
      console.error('Elemen canvas dengan ID "myChart2" tidak ditemukan.');
    }
  });
</script>



<?php
if (isset($_POST['setuju'])) {
    $id_khp = $_POST['id_khp'];
    $update = mysqli_query($koneksi, "UPDATE khp SET status='diterima' WHERE id='$id_khp'");

    if ($update) {
        echo "<script>
        Swal.fire({
            title: 'Diterima',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                document.location.href='?page=home_staff';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal diterima',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                document.location.href='?page=home_staff';
            }
        })</script>";
    }
}

if (isset($_POST['tolak'])) {
    $id_khp = $_POST['id_khp'];
    $ket = $_POST['ket'];
    $update = mysqli_query($koneksi, "UPDATE khp SET status='ditolak',keterangan='$ket' WHERE id='$id_khp'");

    if ($update) {
        echo "<script>
        Swal.fire({
            title: 'Tolak',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                document.location.href='?page=home_staff';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal di Tolak',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                document.location.href='?page=home_staff';
            }
        })</script>";
    }
}
?>



