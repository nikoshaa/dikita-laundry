<?php 
	// Jika tidak ada ID di URL
	if (!isset($_GET['id'])) {
		header("Location: ?page=Pelanggan");
		exit;
	}

	// Ambil ID dari URL
	$id = $_GET['id'];

	// Ambil semua data pelanggan berdasarkan ID
	$data = viewData("SELECT * FROM tbl_pelanggan WHERE id = '$id'");

	if( isset($_POST['submit'])) {
		$id 		= $data['id'];
		$nama 	= strip_tags(addslashes($_POST['nama']));
		$alamat = strip_tags(addslashes($_POST['alamat']));
		$nohp		= strip_tags($_POST['no_hp']);
		$query 	= "UPDATE tbl_pelanggan SET 
								nama 			= '$nama', 
								alamat 		= '$alamat', 
								no_hp 		= '$nohp'
							WHERE id 	= '$id'";

		if( queryData($query) > 0){
			echo "<script>
							alert('Data berhasil diubah');
							document.location.href = '?page=Pelanggan';
						</script>";
		} else {
			echo "<script>
							alert('Data gagal diubah');
							document.location.href = '?page=Pelanggan';
						</script>";
		}
	}
?>


<!-- START: Content -->
<div class="container container-fluid">

	<div class="card mt-4 mb-4">
		<h5 class="card-header d-flex flex-row align-items-center justify-content-between">
			<a>Edit Pelanggan</a>
			<a href="?page=Pelanggan" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-chevron-left fa-sm fa-fw"></i>
			</a>
		</h5>
		<div class="card-body">

			<form method="post" action="">
				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Id Pelanggan</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="id" name="id" value="<?= $data['id']; ?>" required readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="nama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>"
							placeholder="Masukkan Nama Pelanggan" maxlength="50" required autofocus>
					</div>
				</div>
				<div class="form-group row">
					<label for="alamat" class="col-sm-2 col-form-label">Alamat Pelanggan</label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Pelanggan"
							maxlength="255" required><?= $data['alamat']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="no_hp" class="col-sm-2 col-form-label">Telepon Pelanggan</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp']; ?>" min="0" maxlength="20" placeholder="Masukkan Telepon Pelanggan" autocomplete="off" required>
					</div>
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