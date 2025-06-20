<?php
// Mulai Sesion
date_default_timezone_set('Asia/Jakarta');
session_start();
include 'vendor/autoload.php';
//KONEKSI DB
include 'inc/koneksi.php';
error_reporting(0);
if (isset($_SESSION['login']) == '' && isset($_SESSION['s_iduser']) == '') {
    header('location: login.php');
} else {
    $data_id = $_SESSION['s_iduser'];
    $data_username = $_SESSION['s_username'];
    $data_password = $_SESSION['s_password'];
	$data_level = $_SESSION['s_level'];
	$data_prodi = $_SESSION['s_prodi'];

	$prodi=mysqli_query($koneksi,"select * from prodi where id_prodi='$data_prodi'");
	$row_prodi=mysqli_fetch_assoc($prodi);
	$nama_prodi=$row_prodi['nama_prodi'];
	$fakultas_id=$row_prodi['fakultas_id'];

	$fakultas=mysqli_query($koneksi,"select * from fakultas where id_fakultas='$fakultas_id'");
	$row_fakultas=mysqli_fetch_assoc($fakultas);
	$nama_fakultas=$row_fakultas['nama_fakultas'];

	
}






$page = $_GET['page'];

// fs
function human_time_ago($timestamp) {
    // Mengubah timestamp dari argumen menjadi format waktu UNIX
    $time_ago = $timestamp;
    
    // Mendapatkan waktu saat ini
    $current_time = time();
    
    // Menghitung selisih waktu dalam detik
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    
    // Mengonversi detik ke menit, jam, hari, dst.
    $minutes      = round($seconds / 60);           // 60 detik
    $hours        = round($seconds / 3600);         // 60 * 60
    $days         = round($seconds / 86400);        // 60 * 60 * 24
    $weeks        = round($seconds / 604800);       // 60 * 60 * 24 * 7
    $months       = round($seconds / 2629440);      // ((365+365+365+366)/5/12) * 86400
    $years        = round($seconds / 31553280);     // (365+365+365+366)/5 * 86400
    
    // Logika untuk menentukan teks yang ditampilkan
    if ($seconds <= 60) {
        return "Baru saja";
    } else if ($minutes <= 60) {
        return ($minutes == 1) ? "1 menit yang lalu" : "$minutes menit yang lalu";
    } else if ($hours <= 24) {
        return ($hours == 1) ? "1 jam yang lalu" : "$hours jam yang lalu";
    } else if ($days <= 7) {
        return ($days == 1) ? "Kemarin" : "$days hari yang lalu";
    } else if ($weeks <= 4.3) { // 4.3 minggu dalam sebulan
        return ($weeks == 1) ? "1 minggu yang lalu" : "$weeks minggu yang lalu";
    } else if ($months <= 12) {
        return ($months == 1) ? "1 bulan yang lalu" : "$months bulan yang lalu";
    } else {
        return ($years == 1) ? "1 tahun yang lalu" : "$years tahun yang lalu";
    }
}

$bulan = date('n'); // Bulan dalam angka 1–12
if ($bulan >= 2 && $bulan <= 7) {
    $periode = 'GENAP';
} else {
    $periode = 'GANJIL';
}
$tahunSekarang = date('Y'); // tahun: 2025
$tahunDepan = $tahunSekarang + 1;

$tahunAjaran = "$tahunSekarang/$tahunDepan";


$tanggal = date('d - F - Y');
function hari_ini()
{
    $hari = date('D');

    switch ($hari) {
        case 'Sun':
            $hari_ini = 'Minggu';
            break;

        case 'Mon':
            $hari_ini = 'Senin';
            break;

        case 'Tue':
            $hari_ini = 'Selasa';
            break;

        case 'Wed':
            $hari_ini = 'Rabu';
            break;

        case 'Thu':
            $hari_ini = 'Kamis';
            break;

        case 'Fri':
            $hari_ini = 'Jumat';
            break;

        case 'Sat':
            $hari_ini = 'Sabtu';
            break;

        default:
            $hari_ini = 'Tidak di ketahui';
            break;
    }

    return $hari_ini;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php if ($page == '') {
			echo 'Dashboard';
		} else {
			echo $page;
		} ?>
	</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="stylesheet" href="dist/img/logoan.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- mycss assets -->
	  <!-- Template Main CSS File -->
	  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	  <!-- mycss -->


	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icon bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dist/css/mhs.css">
    <link rel="stylesheet" href="dist/css/krp.css">
    <link rel="stylesheet" href="dist/css/khp.css">
    <link rel="stylesheet" href="dist/css/histori.css">
    <link rel="stylesheet" href="dist/css/biodata_mhs.css">
    <link rel="stylesheet" href="dist/css/pw.css">
    <link rel="stylesheet" href="dist/css/staff.css">
    <link rel="stylesheet" href="dist/css/cssfoto.css">
	  
	<!-- Alert -->
	<script src="plugins/alert.js"></script>

</head>

<body class="hold-transition sidebar-mini" id="body">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<?php include 'layout/navbar.php' ?>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		 <?php include 'layout/sidebar.php' ?>
		<!-- end navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php include 'management_page.php'; ?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>

	<!-- modal notif -->
	 <div class="modal fade" id="detailNotifikasiModal" tabindex="-1" aria-labelledby="detailNotifikasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="detailNotifikasiModalLabel">
            <i class="bi bi-info-circle-fill me-2"></i>Detail Status Pengajuan KHP
        </h5>
        
      </div>
      <div class="modal-body" id="detailNotifikasiBody">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat data...</p>
        </div>
      </div>
      <div class="modal-footer">
		<a href="?page=home_mhs" class="text-decoration-none">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
		</a>
      </div>
    </div>
  </div>
</div>
	<!-- end modal notif -->

	<style>
    .nav-item:hover {
		border-left: 3px solid white;
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
		border-radius:5px;
    }
    
    .nav-item:hover .nav-link img {
        transform: rotate(10deg) scale(1.1);
    }

    .nav-item:hover .nav-link p {
        color: #FFD700; /* Warna emas untuk efek hover */
    }
	</style>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>


  <!-- aos -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

<script>
    $("#berat").change(function(){
        let a= parseFloat($("#harga").val());
        let b= parseFloat($("#berat").val());
        let c = a * b;
        $("#total").val(c);
    });
</script>

<script type="text/javascript">   
            <?php echo $a; ?>  
                function changePosyandu(nib){  
                document.getElementById('tgl_lahir').value = tgl_lahir[nib].tgl_lahir;
                document.getElementById('jekel').value = jekel[nib].jekel;
                document.getElementById('nama_ibu').value = nama_ibu[nib].nama_ibu;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $b; ?>  
                function changeNasabah(id_pend){  
                document.getElementById('jekel').value = jekel[id_pend].jekel;
                document.getElementById('desa').value = desa[id_pend].desa;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $b; ?>  
                function changeTransaksi(id_nasabah){  
                document.getElementById('desa').value = desa[id_nasabah].desa;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $a; ?>  
                function changeSampah(id_sampah){  
                document.getElementById('jenis').value = jenis[id_sampah].jenis;
                document.getElementById('harga').value = harga[id_sampah].harga;
            };  
        </script>
<script type="text/javascript">   
            <?php echo $tarik; ?>  
                function changeTarik(id_transaksi){  
                document.getElementById('saldo').value = saldo[id_transaksi].saldo;
            };  
        </script>

<script type="text/javascript">

let btn=document.getElementById("btn");
let none=document.getElementById("none");
btn.addEventListener("click",function(){
	none.classList.toggle('none');
});
</script>

<script>
// Pastikan script berjalan setelah semua dokumen siap
$(document).ready(function() {

    // Menggunakan event delegation yang lebih tangguh dengan jQuery
    $(document).on('click', '.notification-link', function(e) {
        // 1. Mencegah link berpindah halaman
        e.preventDefault();

        var link = $(this); // Simpan elemen <a> yang diklik
        var idNotif = link.data('id-notif');
        var idKhp = link.data('id-khp');
        var isUnread = link.hasClass('bg-light');

        // 2. Tampilkan modal dengan status "loading"
        $('#detailNotifikasiBody').html(`
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data detail...</p>
            </div>`);
        
        // Menampilkan modal dengan cara Bootstrap 4 / jQuery
        $('#detailNotifikasiModal').modal('show');

        // 3. FETCH PERTAMA: Ambil detail KHP (AJAX menggunakan jQuery)
        $.ajax({
            url: 'layout/get_detail_khp.php', // Pastikan path ini benar
            type: 'GET',
            data: { id_khp: idKhp },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const data = response.data;
                    let statusBadge = '';
                    if (data.status === 'diterima') {
                        statusBadge = `<span class="badge badge-success">DITERIMA</span>`;
                    } else if (data.status === 'ditolak') {
                        statusBadge = `<span class="badge badge-danger">DITOLAK</span>`;
                    }
                    
                    // Format tanggal
                    const updatedAt = new Date(data.updated_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

                    const contentHTML = `
                        <dl class="row">
                            <dt class="col-sm-4">Nama Kegiatan</dt>
                            <dd class="col-sm-8">: ${data.nama_b_indo || '-'}</dd>
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">: ${statusBadge}</dd>
                            <dt class="col-sm-4">Tgl Diperbarui</dt>
                            <dd class="col-sm-8">: ${updatedAt}</dd>
                            ${data.status === 'ditolak' ? `
                            <dt class="col-sm-4">Keterangan</dt>
                            <dd class="col-sm-8 text-danger fst-italic">: ${data.keterangan || '-'}</dd>` : ''}
                            ${data.status === 'diterima' ? `
                            <dt class="col-sm-4">Bobot</dt>
                            <dd class="col-sm-8 fw-bold">: ${data.bobot_disetujui || '0'}</dd>` : ''}
                        </dl>`;
                    $('#detailNotifikasiBody').html(contentHTML);
                } else {
                    $('#detailNotifikasiBody').html(`<p class="text-center text-danger">${response.message}</p>`);
                }
            },
            error: function() {
                $('#detailNotifikasiBody').html(`<p class="text-center text-danger">Gagal memuat data. Periksa koneksi atau path file.</p>`);
            }
        });

        // 4. FETCH KEDUA: Tandai notifikasi sebagai "dibaca" (jika belum dibaca)
        if (isUnread) {
            $.ajax({
                url: 'layout/tandai_dibaca.php', // Pastikan path ini benar
                type: 'POST',
                data: { id_notif: idNotif },
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success') {
                        link.removeClass('bg-light');
                        const badge = $('.navbar-badge');
                        if (badge.length) {
                            let currentCount = parseInt(badge.text());
                            if (currentCount > 1) {
                                badge.text(currentCount - 1);
                            } else {
                                badge.remove();
                            }
                        }
                    }
                }
            });
        }
    });
});
</script>
</body>

</html>

