<nav class="main-header navbar navbar-expand " style="background-color:#060930;">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>

			</ul>

			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">

				<li class="nav d-none d-sm-inline-block">
						<font color="white">
							<?php if($data_level=='staff'){ ?>
							<b class="nav-link" style="color: white;">Fakultas <?= $nama_fakultas ?></b>
							<?php }elseif($data_level=='mahasiswa'){ ?>
								<b class="nav-link" style="color: white;">Welcome, <?= $data_username ?></b>
							<?php } ?>
						</font>
				</li>
				<li class="nav">
					<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
					<i class="bi bi-bell-fill"></i>
					</a>
				</li>
			</ul>

		</nav>