<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Jadwal</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-jadwal" class="btn bg-gradient-dark">
					<i class="fa fa-plus"></i> Tambah Data Jadwal</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Hari</th>
						<th>Mata Pelajaran</th>
						<th>Kelas</th>
						<th>Guru</th>
						<th>Jam</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT jadwal.id_jadwal, jadwal.hari, jadwal.waktu, matpel.matpel, kelas.nama_kelas, guru.nama_guru FROM jadwal INNER JOIN matpel ON jadwal.matpel_id=matpel.id_matpel INNER JOIN kelas ON jadwal.kelas_id=kelas.id_kelas INNER JOIN guru ON jadwal.guru_id=guru.id_guru");
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
									<a href="?page=edit-jadwal&kode=<?php echo $data['id_jadwal']; ?>" title="Ubah"
									class="btn bg-gradient-primary btn-sm">
										<i class="fa fa-edit"></i>
									</a>
									<a href="?page=del-jadwal&kode=<?php echo $data['id_jadwal']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
									title="Hapus" class="btn bg-gradient-danger btn-sm">
										<i class="fa fa-trash"></i>
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
	<!-- /.card-body -->