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
    $nama       			= addslashes($_POST['nama']);
    $username         = stripslashes($_POST['username']);
    // $password      		= mysqli_real_escape_string($koneksi, $_POST['password']);
		// $repeat_password	= mysqli_real_escape_string($koneksi, $_POST['repeat_password']);
		$email       			= stripslashes($_POST['email']);
		$nohp       			= stripslashes($_POST['no_hp']);
		$alamat       		= addslashes($_POST['alamat']);
		$catatan       		= addslashes($_POST['catatan']);
		$oldusername			= $_POST['oldusername'];
		$oldimage 				= $_POST['oldimage'];
		$role							= "Karyawan";

    // Cek username
		$result = mysqli_query($koneksi, "SELECT username FROM tbl_karyawan WHERE username = '$username'");
		$resultId = mysqli_query($koneksi, "SELECT * FROM tbl_karyawan WHERE id = $id AND username = '$username'");

		if ( mysqli_fetch_assoc($resultId) ) {
			$username = $oldusername;
		} else if ( mysqli_fetch_assoc($result) ) {
      echo "
				<script>
					alert('Username sudah ada');
				</script>
      ";
      return false;
    }

    //Cek Apakah User Pilih Gambar Baru
    if ( $_FILES['image']['error'] === 4 ) {
      $image = $oldimage;
    } else {
      $image = uploadImage("upload/karyawan");
    }
    
    $query = "UPDATE tbl_karyawan SET 
              nama 				      = '$nama', 
              username 				  = '$username', 
              email 			      = '$email', 
              no_hp             = '$nohp',
              alamat 	          = '$alamat', 
              catatan           = '$catatan',
              `image`           = '$image'
              WHERE id 		      = $id";

    if( queryData($query) > 0 ) {
      echo "
        <script>
          alert('Data berhasil diubah');
          document.location.href = '?page=Karyawan',true;
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Data gagal diubah');
          document.location.href = '?page=Karyawan',true;
        </script>
      ";
    }
	}
?>


<!-- START: Content -->
<div class="container">

	<div class="card mt-4 mb-4">
		<h5 class="card-header d-flex flex-row align-items-center justify-content-between">
			<a>Edit Karyawan</a>
			<a href="?page=Karyawan" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-chevron-left fa-sm fa-fw"></i>
			</a>
		</h5>
		<div class="card-body">

			<form method="post" enctype="multipart/form-data">
				<input type="hidden" class="form-control" name="oldimage" value="<?= $data['image']; ?>">
				<input type="hidden" class="form-control" name="oldusername" value="<?= $data['username']; ?>">

				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="nama">Nama Karyawan</label>
							<input type="text" maxlength="50" class="form-control" name="nama" id="nama" value="<?= $data['nama']; ?>"
								placeholder="Masukkan Nama Karyawan" required autofocus>
						</div>
						<div class="custom-file">
							<label for="image">Gambar Karyawan</label>
							<input type="file" class="form-control-file" name="image" id="image">
							<small>Max size is 3MB</small>
						</div>
					</div>
					<div class="col">
						<img id="imagePreview" src="upload/karyawan/<?= $data['image']; ?>" class="mb-4" height="150px" width="150px" alt="">
						<script type="text/javascript">
							document.getElementById("image").onchange = function () {
								var reader = new FileReader();
								reader.onload = function (e) {
									// Get loaded data and render thumbnail.
									document.getElementById("imagePreview").src = e.target.result;
								};
								// Read the image file as a data URL.
								reader.readAsDataURL(this.files[0]);
							};
						</script>
					</div>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" maxlength="30" class="form-control" name="username" id="username" placeholder="Username" value="<?= $data['username']; ?>" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" maxlength="200" class="form-control" name="email" id="email" placeholder="Email" value="<?= $data['email']; ?>" required>
				</div>
				<div class="form-group">
					<label for="no_hp">No Handphone</label>
					<input type="text" min="0" maxlength="20" class="form-control" name="no_hp" id="no_hp" placeholder="No Handphone" value="<?= $data['no_hp']; ?>" required>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<input type="text" maxlength="100" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $data['alamat']; ?>"required>
				</div>
				<div class="form-group">
					<label for="Catatan">Catatan</label>
					<textarea type="text" maxlength="255" class="form-control" name="catatan" id="catatan" placeholder="Catatan" required><?= $data['catatan']; ?></textarea>
				</div>
				<div class="card-footer text-center">
					<button type="reset" class="btn btn-danger mr-2"><i class="fas fa-undo"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Change</button>
				</div>
			</form>
		</div>
	</div>

</div>
<!-- END: Content -->