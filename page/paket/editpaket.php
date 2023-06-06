<?php 
	// Jika tidak ada ID di URL
	if (!isset($_GET['id'])) {
		header("Location: ?page=Paket");
		exit;
	}

	// Ambil ID dari URL
	$id = $_GET['id'];

	// Ambil semua data pelanggan berdasarkan ID
	$data = viewData("SELECT * FROM tbl_paket WHERE id = '$id'");

	if( isset($_POST['submit'])) {
		$id 				= $data['id'];
		$paket 			= strip_tags(addslashes($_POST['paket']));
		$hargakilo 	= strip_tags($_POST['harga_kilo']);
		$deskripsi	= strip_tags($_POST['deskripsi']);
		$query 			= "UPDATE tbl_paket SET 
										paket 			= '$paket', 
										harga_kilo 	= '$hargakilo', 
										deskripsi		= '$deskripsi'
									WHERE id 			= '$id'";

		if( queryData($query) > 0 ){
			echo "<script>
							alert('Data berhasil diubah');
							document.location.href = '?page=Paket';
						</script>";
		} else {
			echo "<script>
							alert('Data gagal diubah');
							document.location.href = '?page=Paket';
						</script>";
		}
	}
?>


<!-- START: Content -->
<div class="container container-fluid">

  <div class="card mt-4 mb-4">
		<h5 class="card-header d-flex flex-row align-items-center justify-content-between">
			<a>Edit Paket</a>
			<a href="?page=Paket" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-chevron-left fa-sm fa-fw"></i>
			</a>
		</h5>
		<div class="card-body">

        <form method="post" action="">
					<div class="form-group row">
						<label for="id" class="col-sm-2 col-form-label">Id Paket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="id" name="id" value="<?= $data['id']; ?>" required readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="paket" name="paket" value="<?= $data['paket']; ?>" maxlength="50" placeholder="Masukkan Nama Paket" required autofocus>
						</div>
					</div>
					<div class="form-group row">
						<label for="harga_kilo" class="col-sm-2 col-form-label">Harga Per Kilo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="harga_kilo" name="harga_kilo" min="1000" value="<?= $data['harga_kilo']; ?>" placeholder="Masukkan Harga Per Kilo" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Paket</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="deskripsi" name="deskripsi" maxlength="255" placeholder="Masukkan Deskripsi Paket" required><?= $data['deskripsi']; ?></textarea>
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