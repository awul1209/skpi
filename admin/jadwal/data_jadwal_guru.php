<div class="card">
	<?php
		if($data_level == 'admin'){
	?>
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Jadwal</h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pilih Kelas</label>
				<div class="col-sm-4">
					<select name="pilihkelas" id="pilihkelas" class="form-control select2bs4" required>
						<option value="minggu-ke-1">Pilih kelas</option>
						<?php
							// ambil data dari database
							$query = "SELECT * FROM kelas";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_assoc($hasil)) { 
								
								// $ket="";
								// if (isset($_POST['jadwal'])) {
								// 	$jadwal = trim($_POST['jadwal']);
								// 	if ($jadwal==$row['id_jadwal'])
								// 	{
								// 		$ket="selected";
								// 	}
								// }
						?>
						<option value="<?php echo $row['id_kelas']; ?>">
							<?= $row['nama_kelas']; ?>
						</option>
						<?php }
						?>
					</select>
				</div>
				<label class="col-sm-2 col-form-label">Pilih Kelas</label>
				<div class="col-sm-4">
					<select name="hari" id="hari" class="form-control" required>
					<option value="">-- Pilih hari --</option>
						<option>Senin</option>
						<option>Selasa</option>
						<option>Rabu</option>
						<option>Kamis</option>
						<option>Jumat</option>
						<option>Sabtu</option>
						<option>Minggu</option>
					</select>
				</div>
				<input  type="submit" name="BtnKode" class="btn bg-gradient-success"></input>
			</div>
		</div>
	</form>
</div>

<!-- tabel data jadwal -->
<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Jadwal</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Hari</th>
						<th>Mata Pelajaran</th>
						<th>Kelas</th>
						<th>Guru</th>
						<th>Jam</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (isset($_POST['BtnKode'])) {
					$id_kelas = $_POST['pilihkelas'];
					$hari = $_POST['hari'];
				}
				$no = 1;
				$sql = $koneksi->query("SELECT jadwal.id_jadwal, jadwal.hari, jadwal.waktu, matpel.matpel, kelas.nama_kelas, guru.nama_guru FROM jadwal 
				INNER JOIN matpel ON jadwal.matpel_id=matpel.id_matpel 
				INNER JOIN kelas ON jadwal.kelas_id=kelas.id_kelas 
				INNER JOIN guru ON jadwal.guru_id=guru.id_guru 
				WHERE kelas_id='$id_kelas' AND hari='$hari'");
				while ($data= $sql->fetch_assoc()) {
					?>
		
							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['hari']; ?>
								</td>
								<td>
									<?php echo $data['matpel']; ?>
								</td>
								<td>
									<?php echo $data['nama_kelas']; ?>
								</td>
								<td>
									<?php echo $data['nama_guru']; ?>
								</td>
								<td>
									<?php echo $data['waktu']; ?>
								</td>
								<!-- <td>
									<a href="?page=edit-jadwal&kode=<?php echo $data['id_jadwal']; ?>" title="Ubah"
									class="btn btn-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<a href="?page=del-jadwal&kode=<?php echo $data['id_jadwal']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
								title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								</>
							</td> -->
						</tr>
						
						<?php
					} }
					else if($data_level=='guru') { ?>
						<div class="card-header bg-gradient-dark">
							<h3 class="card-title">
								<i class="fa fa-table"></i> Data Jadwal</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Hari</th>
											<th>Mata Pelajaran</th>
											<th>Kelas</th>
											<th>Jam</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if (isset($_POST['BtnKode'])) {
										$id_kelas = $_POST['pilihkelas'];
										$hari = $_POST['hari'];
									}
									$no = 1;
									$sql = $koneksi->query("SELECT jadwal.id_jadwal, jadwal.hari, jadwal.waktu, matpel.matpel, kelas.nama_kelas FROM jadwal 
									INNER JOIN matpel ON jadwal.matpel_id=matpel.id_matpel 
									INNER JOIN kelas ON jadwal.kelas_id=kelas.id_kelas 
									INNER JOIN guru ON jadwal.guru_id=guru.id_guru 
									WHERE id_guru='$data_id'");
									while ($data= $sql->fetch_assoc()) {
										?>
							
												<tr>
													<td>
														<?php echo $no++; ?>
													</td>
													<td>
														<?php echo $data['hari']; ?>
													</td>
													<td>
														<?php echo $data['matpel']; ?>
													</td>
													<td>
														<?php echo $data['nama_kelas']; ?>
													</td>
													<td>
														<?php echo $data['waktu']; ?>
													</td>

					<?php } } ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->