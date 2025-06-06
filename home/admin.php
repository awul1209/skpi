<?php
// $queryguru = mysqli_query($koneksi, "SELECT * FROM guru WHERE rl = 'guru'");

// $jumlahguru = mysqli_query($koneksi, "SELECT COUNT('id_guru') as jml_guru FROM guru WHERE rl='guru'");
// $guru = mysqli_fetch_assoc($jumlahguru);

// $jumlahsiswa = mysqli_query($koneksi, "SELECT COUNT('id_siswa') as jml_siswa FROM siswa");
// $siswa = mysqli_fetch_assoc($jumlahsiswa);

// $jumlahkelas = mysqli_query($koneksi, "SELECT COUNT('id_kelas') as jml_kelas FROM kelas");
// $kelas = mysqli_fetch_assoc($jumlahkelas);

// $jumlahmatpel = mysqli_query($koneksi, "SELECT COUNT('id_matpel') as jml_matpel FROM matpel");
// $matpel = mysqli_fetch_assoc($jumlahmatpel);


?>

<div class="row kotak-admin">
	<div class="kotak-card">
		<!-- small box -->
		<div class="small-box" style="background-color: #fff; color:#222;">
			<div class="inner">
				<h3 style="color: rgb(46, 46, 46);">
                <!-- <?= $guru['jml_guru']; ?> -->
				 6
				</h3>
				<p style="color: rgb(46, 46, 46); font-weight: bold; font-size: 22px;">Guru</p>
			</div>
			<div class="icon">
			<i style="display: flex; justify-content: flex-start;"><img src="dist/img/guru.png" alt="" style="width: 80px;"></i>
			</div>
			<a href="?page=data-guru" class="small-box-footer" style="background-color: rgb(46, 46, 46);">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="kotak-card">
		<!-- small box -->
		<div class="small-box" style="background-color: #fff; color:#222;">
			<div class="inner">
				<h3 style="color: rgb(46, 46, 46);">
                <!-- <?= $siswa['jml_siswa']; ?> -->
				 0
				</h3>

				<p style="color: rgb(46, 46, 46); font-weight: bold; font-size: 22px;">siswa</p>
			</div>
			<div class="icon">
			<i style="display: flex; justify-content: flex-start;"><img src="dist/img/students.png" alt="" style="width: 80px;"></i>
			</div>
			<a href="?page=data-siswa" class="small-box-footer" style="background-color: rgb(46, 46, 46);">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
    	<!-- ./col -->
	<div class="kotak-card">
		<!-- small box -->
		<div class="small-box" style="background-color: #fff; color:#222;">
			<div class="inner">
				<h3 style="color: rgb(46, 46, 46);">
                <!-- <?= $kelas['jml_kelas']; ?> -->
				 0
				</h3>

				<p style="color: rgb(46, 46, 46); font-weight: bold; font-size: 22px;">kelas</p>
			</div>
			<div class="icon">
			<i style="display: flex; justify-content: flex-start;"><img src="dist/img/classroom.png" alt="" style="width: 80px;"></i>
			</div>
			<a href="?page=data-kelas" class="small-box-footer" style="background-color: rgb(46, 46, 46);">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
    	<!-- ./col -->
	<div class="kotak-card">
		<!-- small box -->
		<div class="small-box" style="background-color: #fff; color:#222;">
			<div class="inner">
				<h3 style="color: rgb(46, 46, 46);">
                <!-- <?= $matpel['jml_matpel']; ?> -->
				 0
				</h3>

				<p style="color: rgb(46, 46, 46); font-weight: bold; font-size: 22px;">matpel</p>
			</div>
			<div class="icon">
			<i style="display: flex; justify-content: flex-start;"><img src="dist/img/books.png" alt="" style="width: 80px; color:rgb(46, 46, 46);"></i>
			</div>
			<a href="?page=data-matpel" class="small-box-footer" style="background-color: rgb(46, 46, 46);">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
</div>
<div class="card-body">
	
	</div>
	</div>
	<!-- /.card-body -->
