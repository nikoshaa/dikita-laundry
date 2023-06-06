<?php
// Jika tidak ada ID di URL
if (!isset($_GET['id'])) {
	header("Location: ?page=Transaksi");
	exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil semua data pelanggan berdasarkan ID
$data = viewData("SELECT * FROM tbl_transaksi WHERE id = '$id'");

if (isset($_POST['submit'])) {
	$id 					= $_POST['id'];
	$tanggal 			= strip_tags($_POST['tanggal']);
	$idpelanggan	= strip_tags($_POST['id_pelanggan']);
	$kdpaket			= strip_tags($_POST['kd_paket']);
	$qty 					= strip_tags($_POST['qty']);
	$biaya 				= strip_tags($_POST['biaya']);
	$bayar				= strip_tags($_POST['bayar']);
	$kembalian 		= strip_tags($_POST['kembalian']);
	$query				= "UPDATE tbl_transaksi SET
											tanggal 			= '$tanggal',
											id_pelanggan	= '$idpelanggan',
											kd_paket 			= '$kdpaket',
											qty						= $qty,
											biaya					= $biaya,
											bayar 				= $bayar,
											kembalian 		= $kembalian
										WHERE id 				= '$id'";

	if (queryData($query) > 0) {
		echo "<script>
							alert('Data berhasil diubah');
							document.location.href = '?page=Transaksi';
					</script>";
	} else {
		echo "<script>
                alert('Data gagal diubah');
                document.location.href = '?page=Transaksi';
							</script>";
	}
}
?>


<!-- Awal Isi Halaman -->
<div class="container container-fluid">

	<div class="card mt-4">
		<h5 class="card-header d-flex flex-row align-items-center justify-content-between">
			<a>Edit Transaksi</a>
			<a href="?page=Transaksi" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-chevron-left fa-sm fa-fw"></i>
			</a>
		</h5>
		<div class="card-body">

			<form method="post" action="">
				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Id Transaksi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control-plaintext" id="id" name="id" value="<?= $id; ?>" required readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="tanggal" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
					<div class="col-sm-10">
						<input type="text" class="form-control-plaintext" id="tanggal" name="tanggal" value="<?= $data['tanggal']; ?>" required readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="id_pelanggan" class="col-sm-2 col-form-label">Id Pelanggan</label>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" placeholder="Pilih Pelanggan" value="<?= $data['id_pelanggan']; ?>" readonly required autofocus>
							<div class="input-group-append">
								<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalPelanggan"><i class="fas fa-search fa-sm"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="kd_paket" class="col-sm-2 col-form-label">Kode Paket</label>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="text" class="form-control" id="kd_paket" name="kd_paket" placeholder="Pilih Paket" value="<?= $data['kd_paket']; ?>" readonly required>
							<div class="input-group-append">
								<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalPaket"><i class="fas fa-search fa-sm"></i></button>
							</div>
						</div>
					</div>
				</div>

				<?php
				$kd_paket = $data['kd_paket'];
				$harga = viewData("SELECT * FROM tbl_paket WHERE id = '$kd_paket'");
				?>

				<div class="form-group row">
					<label for="harga" class="col-sm-2 col-form-label">Harga Per Kilo</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="harga" name="harga" onkeyup="jumlahBiaya();" value="<?= $harga['harga_kilo']; ?>" required readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="qty" class="col-sm-2 col-form-label">Quantity</label>
					<div class="col-sm-10">
						<input type="number" min="1" class="form-control" id="qty" name="qty" onkeyup="jumlahBiaya();" value="<?= $data['qty']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="biaya" name="biaya" onkeyup="jumlahKembalian();" value="<?= $data['biaya']; ?>" required readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="bayar" class="col-sm-2 col-form-label">Bayar</label>
					<div class="col-sm-10">
						<input type="text" min="0" class="form-control" id="bayar" name="bayar" onkeyup="jumlahKembalian();" value="<?= $data['bayar']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="kembalian" class="col-sm-2 col-form-label">Kembalian</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="kembalian" name="kembalian" required value="<?= $data['kembalian']; ?>" readonly>
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
<!-- Akhir Isi Halaman -->

<!-- Modal Pelanggan -->
<div class="modal fade bd-example-modal-lg" id="modalPelanggan" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="modal">Pilih Pelanggan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex mb-4">
							<a href="?page=TambahPelanggan" target="_blank" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan</a>
							<a href="?page=Pelanggan" target="_blank" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3"><i class="fas fa-forward fa-sm text-white-50"></i> Lihat Pelanggan</a>
						</div>

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No.</th>
										<th>#</th>
										<th>Id Pelanggan</th>
										<th>Nama Pelanggan</th>
										<th>Alamat Pelanggan</th>
										<th>Nomor Handphone</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php $pelanggan = viewAllData("tbl_pelanggan"); ?>
									<?php foreach ($pelanggan as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<button id="pilih-pelanggan" class="btn btn-sm btn-success pilih-pelanggan" data-pelanggan="<?= $data['id'] ?>">
													<i class="fas fa-check-double fa-sm"></i>
												</button>
											</td>
											<td><?= $data['id']; ?></td>
											<td><?= $data['nama']; ?></td>
											<td><?= $data['alamat']; ?></td>
											<td><?= $data['no_hp']; ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Modal Paket -->
<div class="modal fade bd-example-modal-lg" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="modal">Pilih Paket</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex mb-4">
							<a href="?page=TambahPaket" target="_blank" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket</a>
							<a href="?page=Paket" target="_blank" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3"><i class="fas fa-forward fa-sm text-white-50"></i> Lihat Paket</a>
						</div>

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTables2" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No.</th>
										<th>#</th>
										<th>Id Paket</th>
										<th>Nama Paket</th>
										<th>Harga Per Kilo</th>
										<th>Deskripsi Paket</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php $paket = viewAllData("tbl_paket"); ?>
									<?php foreach ($paket as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<button id="pilih-paket" class="btn btn-sm btn-success pilih-paket" data-kdpaket="<?= $data['id'] ?>" data-harga="<?= $data['harga_kilo'] ?>">
													<i class="fas fa-check-double fa-sm"></i>
												</button>
											</td>
											<td><?= $data['id']; ?></td>
											<td><?= $data['paket']; ?></td>
											<td><?= $data['harga_kilo']; ?></td>
											<td><?= $data['deskripsi']; ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>