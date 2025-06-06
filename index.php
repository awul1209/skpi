<?php
// Mulai Sesion
session_start();
include 'vendor/autoload.php';
//KONEKSI DB
include 'inc/koneksi.php';
// error_reporting(0);
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
	  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->
	  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	  <!-- mycss -->
	   <link rel="stylesheet" href="dist/css/style.css">

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
</body>

</html>

