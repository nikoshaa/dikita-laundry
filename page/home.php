<?php 
  $query = "SELECT tbl_transaksi.id, tbl_transaksi.tanggal ,tbl_pelanggan.nama, tbl_paket.paket, tbl_transaksi.qty, tbl_transaksi.biaya, tbl_transaksi.bayar, tbl_transaksi.kembalian 
            FROM tbl_transaksi 
            INNER JOIN tbl_pelanggan 
            ON tbl_transaksi.id_pelanggan = tbl_pelanggan.id 
            INNER JOIN tbl_paket 
            ON tbl_transaksi.kd_paket = tbl_paket.id 
						ORDER BY tbl_transaksi.id DESC
						LIMIT 5"
?>

<!-- Awal Isi Halaman -->
<div class="container container-fluid">

	<!-- START: Category -->
	<div class="card mt-4 mb-4">
		<div class="card-body">
			<h5 class="card-title">Dashboard</h5>
			<div class="row">

				<div class="col-md">
					<div class="card text-white bg-primary" style="max-width: 18rem;">
						<div class="card-body">
							<h1 class="card-title d-flex align-items-center justify-content-between">
								<i class="fas fa-users"></i>
								<span class="text-right"><?= numData("tbl_pelanggan"); ?></span>
							</h1>
							<p class="card-text">Jumlah Pelanggan</p>
						</div>
					</div>
				</div>

				<div class="col-md">
					<div class="card text-white bg-warning" style="max-width: 18rem;">
						<div class="card-body">
							<h1 class="card-title d-flex align-items-center justify-content-between">
								<i class="fas fa-dollar-sign"></i>
								<span class="text-right"><?= numData('tbl_transaksi'); ?></span>
							</h1>
							<p class="card-text">Jumlah Transaksi</p>
						</div>
					</div>
				</div>

				<div class="col-md">
					<div class="card text-white bg-success" style="max-width: 18rem;">
						<div class="card-body">
							<h1 class="card-title d-flex align-items-center justify-content-between">
								<i class="fas fa-box"></i>
								<span class="text-right"><?= numData('tbl_paket'); ?></span>
							</h1>
							<p class="card-text">Jumlah Paket</p>
						</div>
					</div>
				</div>

				<div class="col-md">
					<div class="card text-white bg-info" style="max-width: 18rem;">
						<div class="card-body">
							<h1 class="card-title d-flex align-items-center justify-content-between">
								<i class="fas fa-user"></i>
								<span class="text-right"><?= numQueryData("SELECT * FROM tbl_karyawan WHERE tbl_karyawan.role = 'Karyawan'"); ?></span>
							</h1>
							<p class="card-text">Jumlah Karyawan</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- END: Category -->

	<!-- START: Data Transaksi Terakhir -->
	<div class="card mb-4">
		<div class="card-body">
			<h5 class="card-title">Riwayat Transaksi Terakhir</h5>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Tanggal</th>
						<th>Nama Pelanggan</th>
						<th>Kode Paket</th>
						<th>Quantity</th>
						<th>Biaya</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php $transaksi = viewDatas($query); ?>
					<?php foreach($transaksi as $data) : ?>
					<tr>
						<td><?= $data['id']; ?></td>
						<td><?= $data['tanggal']; ?></td>
						<td><?= $data['nama']; ?></td>
						<td><?= $data['paket']; ?></td>
						<td><?= $data['qty']; ?> kg</td>
						<td><?= $data['biaya']; ?></td>
						<td>
						<?php 
							if ( $data['kembalian'] < 0 ) {
								echo "<span class='badge badge-pill badge-danger'>Belum Lunas</span>";
							} else {
								echo "<span class='badge badge-pill badge-success'>Lunas</span>";
							}
						?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- END: Data Transaksi Terakhir -->

</div>
<!-- Akhir Isi Halaman -->