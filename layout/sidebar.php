<aside class="main-sidebar elevation-4" style="background-color:#060930; position:fixed">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link" style="text-decoration: none;">
				<img src="dist/img/title/logounija.png" class="brand-image">
				<span class="brand-text" style="color: #fff;">E-PRESTASI</span>
				
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-2 pb-2 mb-2 d-flex">
					<?php if ($data_level == 'admin' || $data_level == 'staff') { ?>
					<div class="image">
						<img src="dist/img/admin.ico">
					</div>
					<div class="info">
						<a href="index.php" class="d-block"  style="color: #fff; text-decoration: none; font-size: 14px;">
							<?php echo $data_username; ?>
						</a>
						<span class="badge bg-primary" style="padding: 5px;">
							<?php echo $data_level; ?>
						</span>
					</div>
					<?php } else { ?>
						<!-- <div class="info">
						<a href="index.php" class="d-block"  style="color: #fff; text-decoration: none; font-size: 14px;">
							<?php echo $data_username; ?>
						</a>
						<span class="badge bg-primary" style="padding: 5px;">
							<?php echo $data_id; ?>
						</span>
					</div> -->
					<?php } ?>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<?php if ($data_level == 'admin') { ?>
							<li class="nav-item" style="transition: all 0.3s ease-in-out;">
								<a href="index.php" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
									<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px; margin-left: 0px; margin-right: 4px; transition: transform 0.3s ease-in-out;">
									<p style="color: #fff; margin: 0; transition: color 0.3s ease-in-out;">
										Dashboard Admin
									</p>
								</a>
							</li>

						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="#" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
							<img src="dist/img/iconsidebar/data.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Data Master
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-user" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data User</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-siswa" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-kelas" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Kelas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-matpel" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Mata Pelajaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-jadwal" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Jadwal</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-kriteria" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Kriteria Penilian</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=rekap-absensi" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
								<img src="dist/img/rekapabsen.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Rekap Absensi
								</p>
							</a>
						</li>
						
						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=nilai-rata-rata" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
								<img src="dist/img/pn.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Nilai
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=pilih-rangking" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
								<img src="dist/img/rangking.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Rangking
								</p>
							</a>
						</li>
						<?php } else if ($data_level == 'staff') { ?>
							<li class="nav-item" style="transition: all 0.3s ease-in-out;">
							<a href="?page=home_staff" 
							class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'home_staff') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
							<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px; margin-left: 0px; margin-right: 4px; transition: transform 0.3s ease-in-out;">
							<p style="color: #fff;">Dashboar</p>
							</a>
							</li>
							<li class="nav-item has-treeview">
								<a href="#" class="nav-link" 	style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'data_mhs_staff') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
									<img src="dist/img/iconsidebar/data.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
									<p  style="color: #fff;">
										Data Mahasiswa
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php
									$menu=mysqli_query($koneksi,"select * from prodi where fakultas_id='$fakultas_id'");
									while($row_menu=mysqli_fetch_assoc($menu)){
									?>
									<li class="nav-item ">
										<a href="?page=data_mhs_staff&kode=<?= $row_menu['id_prodi'] ?>" class="nav-link">
											<i class="nav-icon far fa-circle text-white"></i>
											<p  style="color: #fff;"><?= $row_menu['nama_prodi']; ?></p>
										</a>
									</li>
									<?php } ?>
								</ul>
							</li>


						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=data-skpi" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'data-skpi') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
										<img src="dist/img/pn.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								
								<p  style="color: #fff;">
									SKPI
										<i class="fas fa-angle-left right"></i>
									</p>
								</p>
							</a>
							<ul class="nav nav-treeview">
									<?php
									$menu=mysqli_query($koneksi,"select * from prodi where fakultas_id='$fakultas_id'");
									while($row_menu=mysqli_fetch_assoc($menu)){
									?>
									<li class="nav-item ">
										<a href="?page=data-skpi&kode=<?= $row_menu['id_prodi'] ?>" class="nav-link">
											<i class="nav-icon far fa-circle text-white"></i>
											<p  style="color: #fff;"><?= $row_menu['nama_prodi']; ?></p>
										</a>
									</li>
									<?php } ?>
								</ul>
						</li>
						
						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=nilai-rata-rata" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
						<img src="dist/img/rekapabsen.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Laporan
								</p>
							</a>
						</li>
						
						</li>
						
                        <?php } elseif ($data_level == 'mahasiswa') { ?>
							<li class="nav-item" style="transition: all 0.3s ease-in-out;">
							<a href="?page=home_mhs" 
							class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'home_mhs') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
							<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px; margin-left: 0px; margin-right: 4px; transition: transform 0.3s ease-in-out;">
							<p style="color: #fff;">Dashboar</p>
							</a>
							</li>
							

							<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=biodata" class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'biodata' || $page =='edit-bio' || $page=='edit-pw') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
								<img src="dist/img/iconsidebar/3.png" alt="" style="width: 20px; margin-left: 0px; margin-right: 4px;">
								<p style="color: #fff;">Biodata</p>
							</a>
							</li>

						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
						<a href="?page=krp" class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'krp' || $page=='data-krp') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
								<img src="dist/img/iconsidebar/2.png" alt="" style="width: 20px; margin-left: 0px; margin-right: 4px;">
								<p style="color: #fff;">KRP</p>
							</a>
						</li>
						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=khp" class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'khp' || $page=='data-khp') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
							<img src="dist/img/iconsidebar/4.png" alt="" style="width: 20px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									KHP
								</p>
							</a>
						</li>

						<li class="nav-item has-treeview" style="transition: all 0.3s ease-in-out;">
							<a href="?page=histori" class="nav-link" 
							style="display: flex; align-items: center; gap:6px; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;<?php echo ($page == 'histori') ? 'background-color: rgba(255, 255, 255, 0.2); border-left: 3px solid white;' : ''; ?>">
							<img src="dist/img/iconsidebar/5.png" alt="" style="width: 20px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Histori
								</p>
							</a>
						</li>

                        <?php } ?>
                        
						

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; transition: all 0.3s ease-in-out;">
								<i class="nav-icon fas fa-sign-out-alt text-white"></i>
								<p style="color: #fff;">
									Logout
								</p>
							</a>
						</li>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>