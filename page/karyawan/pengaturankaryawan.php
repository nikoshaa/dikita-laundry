<?php
	// Jika tidak ada ID di URL
	if (!isset($_GET['id'])) {
		header("Location: ?page=Karyawan");
		exit;
	}

	// Ambil ID dari URL
	$id = $_GET['id'];

	// Ambil semua data karyawan berdasarkan ID
	$data = viewData("SELECT * FROM tbl_karyawan WHERE id = '$id'");	

	if( isset($_POST['submit'])) {
		$password_baru    = mysqli_real_escape_string($koneksi, $_POST['password_baru']);
		$repeat_password	= mysqli_real_escape_string($koneksi, $_POST['repeat_password']);
    $role    					= $_POST['role'];
    
		// Konfirmasi password
		if ( $password_baru !== $repeat_password ) {
			echo "
				<script>
					alert('Password tidak sesuai...');
					document.location.href = '?page=PengaturanPassword';
				</script>";
			return false;
		}

		// Enskripsi password	
		$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

		// Menambahkan user
		$query = "UPDATE tbl_karyawan SET 
		`password`        = '$password_baru',
		`role`						= '$role'
		WHERE id 		      = $id";

		if( queryData($query) > 0){
			echo "
				<script>
					alert('Data berhasil di ubah');
					document.location.href = '?page=index.php';
				</script>";
		} else {
			echo "
				<script>
					alert('Gagal mengubah Data.,.');
					document.location.href = '?page=index.php';
				</script>";
		}
	}
?>


<!-- START: Content -->
<div class="container">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-4">
		<h1>Ubah Password</h1>
		<a href="?page=index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
			<i class="fas fa-chevron-left fa-sm text-white-50"></i> Back</a>
	</div>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title text-center mb-5">Ubah Password</h5>			
			<form action="" method="post">
				<div class="form-group">
					<div class="form-group row">
						<label for="password_baru" class="col-sm-2 col-form-label">Password Baru</label>
						<div class="col-sm-10">
							<input type="password" maxlength="16" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="repeat_password" class="col-sm-2 col-form-label">Ulangi Password</label>
						<div class="col-sm-10">
							<input type="password" maxlength="16" class="form-control" name="repeat_password" id="repeat_password" placeholder="Ulangi Password Baru" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-2 col-form-label">Role</label>
						<div class="col-sm-10">
							<select class="form-control" name="role" id="role">
								<option disabled selected><?= $data['role']; ?></option>
								<option value="Admin">Admin</option>
								<option value="Karyawan">Karyawan</option>
							</select>
						</div>
					</div>
				</div>

				<div class="card-footer text-center mt-5">
					<button type="reset" class="btn btn-danger mr-2"><i class="fas fa-undo"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Change</button>
				</div>			
			</form>
		</div>
	</div>
</div>
<!-- END: Content -->