<?php
session_start();
if (isset($_SESSION["login"])) {
	header("location: index.php");
	exit;
}

include 'inc/koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>login</title>
	<link rel="icon" href="dist/img/title/logounija.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-color:rgb(255, 255, 255); border-radius: 25px;">
	<div class="login-box" style="background-color:rgb(255, 255, 255); border-radius: 25px;">
		<div class="login-logo">
		</div>
		<!-- /.login-logo -->
		<div class="card" style="border-radius: 25px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">
		<div class="card-body login-card-body" style="border-radius: 25px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">
				<center>
					<img src="dist/img/title/logounija.png" width=100px />
					<br>
					<p class="text-muted mt-3" style="font-size:16px; margin-bottom:0px; font-weight:500;">
						E-Prestasi 
						</p>
					<h5 class="mt-1">
						<b style="">Universitas Wiraraja</b>
					</h5>
					<br>
				</center>


				<form action="" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="username" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
					<select class="form-control text-center border border-1" aria-label="select example" name="sebagai">
					<option selected>--Login Sebagai--</option>
					<option value="mahasiswa">Mahasiswa</option>
					<option value="staff">Staff</option>
					</select>
					</div>
					<br>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-block btn-flat mb-1 text-white" name="btnLogin" title="Masuk Sistem" style="border-radius: 5px; background-color:#042366;">
								<b>Login System</b>
							</button>
							<center>

						</div>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- Alert -->
		<script src="plugins/alert.js"></script>

</body>

</html>

<?php if (isset($_POST['btnLogin'])) {
    //anti inject sql
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $sebagai = mysqli_real_escape_string($koneksi, $_POST['sebagai']);
	if($sebagai == 'staff'){
		//query login
		$sql_login = "SELECT * FROM user WHERE BINARY username='$username'";
		$query_login = mysqli_query($koneksi, $sql_login);
		$data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
		$jumlah_login = mysqli_num_rows($query_login);

		
		if ($jumlah_login == 1) {
			if (password_verify($password, $data_login['password'])) {

			$_SESSION['s_iduser'] = $data_login['id_user'];
			$_SESSION['s_username'] = $data_login['username'];
			$_SESSION['s_password'] = $data_login['password'];
			$_SESSION['s_level'] = 'staff';
			$_SESSION['s_prodi'] = $data_login['prodi_id'];
			$_SESSION['login'] = true;
			
			echo "<script>
				Swal.fire({title: 'Login Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {if (result.value)
					{window.location = 'index.php';}
				})</script>";
		} else {
			echo "<script>
				Swal.fire({title: 'Login Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {if (result.value)
					{window.location = 'login.php';}
				})</script>";
		}
	}else{
		echo "<script>
		Swal.fire({title: 'Username atau Password Salah',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'login.php';}
		})</script>";
	}

	}elseif($sebagai == 'mahasiswa'){
		//query login
		$sql_login = "SELECT * FROM mahasiswa WHERE BINARY npm='$username'";
		$query_login = mysqli_query($koneksi, $sql_login);
		$data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
		$jumlah_login = mysqli_num_rows($query_login);

		if ($jumlah_login == 1) {
			if (password_verify($password, $data_login['password'])) {

			$_SESSION['s_iduser'] = $data_login['npm'];
			$_SESSION['s_username'] = $data_login['nama_lengkap'];
			$_SESSION['s_password'] = $data_login['password'];
			$_SESSION['s_level'] = 'mahasiswa';
			$_SESSION['login'] = true;
			
			echo "<script>
				Swal.fire({title: 'Login Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {if (result.value)
					{window.location = 'index.php';}
				})</script>";
		} else {
			echo "<script>
				Swal.fire({title: 'Login Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {if (result.value)
					{window.location = 'login.php';}
				})</script>";
		}
	}else{
		echo "<script>
		Swal.fire({title: 'Username atau Password Salah',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'login.php';}
		})</script>";
	}
	}else{
		echo "<script>
		Swal.fire({title: 'Anda Login Sebagai Apa?',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {if (result.value)
			{window.location = 'login.php';}
		})</script>";
	}


}
