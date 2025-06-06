
<div class="card">
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
						<th>Guru</th>
						<th>Jam</th>
						<th class="col-sm-3">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT jadwal.id_jadwal, jadwal.hari, jadwal.waktu, matpel.matpel, kelas.nama_kelas, guru.nama_guru FROM jadwal
				JOIN kelas ON id_kelas=kelas_id 
				JOIN matpel on id_matpel=matpel_id 
				JOIN guru ON guru.id_guru=jadwal.guru_id WHERE guru.id_guru='$data_id' AND hari='" .
						hari_ini() .
						"'");
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
								<td>
								<?php 
									$tanggal_sekarang = date('y-m-d');
									$id_jadwal = $data['id_jadwal']; 
              						$jmlData = mysqli_query($koneksi, "SELECT * FROM `absensi`JOIN jadwal ON id_jadwal=jadwal_id WHERE tanggal='$tanggal_sekarang' AND jadwal_id='$id_jadwal'");
              						$jml = mysqli_num_rows($jmlData);
									if ($jml == 0) {
								?>
									<a href="index.php?page=absensi-siswa&kode=<?= $data['id_jadwal'] ?>" title="absensi"
									class="btn bg-gradient-warning btn-sm">
									<h3 class="card-title">
										<i class="fa fa-edit"></i> Absensi</h3>
									</a>
								<?php } else if ($jml > 0){ ?>
									<a title="absensi selesai"
									class="btn bg-gradient-success btn-sm text-light">
									<h3 class="card-title">
										<i class="fa fa-check"></i> Absensi selesai</h3>
									</a>
									<a href="index.php?page=edit-absen&id=<?= $data['id_jadwal'] ?>" title="edit absen"
									class="btn bg-gradient-primary  btn-sm">
									<h3 class="card-title">
										<i class="fa fa-edit"></i> Edit</h3>
									</a>
               					 <?php } ?>  
								</td>
							</tr>
		
							<?php
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
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
						<th class="col-sm-3">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT jadwal.id_jadwal, jadwal.hari, jadwal.waktu, matpel.matpel, kelas.nama_kelas, guru.nama_guru FROM jadwal
				JOIN kelas ON id_kelas=kelas_id 
				JOIN matpel on id_matpel=matpel_id 
				JOIN guru ON guru.id_guru=jadwal.guru_id WHERE guru.id_guru='$data_id'");
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
								<td>
								
									
									<a href="index.php?page=absen-guru&id=<?= $data['id_jadwal'] ?>" title="edit absen"
									class="btn bg-gradient-primary  btn-sm">
									<h3 class="card-title">
										<i class="fa fa-edit"></i> View</h3>
									</a>
								</td>
							</tr>
		
							<?php
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
</div>
	<!-- /.card-body -->