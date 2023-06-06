<?php
$query = "SELECT tbl_transaksi.id, tbl_transaksi.tanggal ,tbl_pelanggan.nama, tbl_paket.paket, tbl_transaksi.qty, tbl_transaksi.biaya, tbl_transaksi.bayar, tbl_transaksi.kembalian 
            FROM tbl_transaksi 
            INNER JOIN tbl_pelanggan 
            ON tbl_transaksi.id_pelanggan = tbl_pelanggan.id 
            INNER JOIN tbl_paket 
            ON tbl_transaksi.kd_paket = tbl_paket.id 
            ORDER BY tbl_transaksi.id DESC"
?>


<!-- START: Content -->
<div class="container">

  <div class="card mt-4 mb-4">
    <div class="card-header">
      <h5>Transaksi</h5>
    </div>
    <div class="card-body">
      <!-- START: Button -->
      <div class="d-flex justify-content-start mb-4">
        <a href="?page=TambahTransaksi" type="button" class="btn btn-sm btn-primary mr-3"><i class="fas fa-plus fa-sm text-white"></i> Tambah Data</a>
        <a href="page/transaksi/laporantransaksi.php" target="_blank" type="button" class="btn btn-sm btn-info mr-3"><i class="fas fa-download fa-sm text-white"></i> Hasilkan PDF</a>
      </div>
      <!-- END: Button -->
      <table id="dataTables" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Nama Paket</th>
            <th>Quantity</th>
            <th>Biaya</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Keterangan</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php $transaksi = viewDatas($query); ?>
          <?php foreach ($transaksi as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['id']; ?></td>
              <td><?= $data['tanggal']; ?></td>
              <td><?= $data['nama']; ?></td>
              <td><?= $data['paket']; ?></td>
              <td><?= $data['qty']; ?> kg</td>
              <td><?= $data['biaya']; ?></td>
              <td><?= $data['bayar']; ?></td>
              <td><?= $data['kembalian']; ?></td>
              <td>
                <?php
                if ($data['kembalian'] < 0) {
                  echo "<span class='badge badge-pill badge-danger'>Belum Lunas</span>";
                } else {
                  echo "<span class='badge badge-pill badge-success'>Lunas</span>";
                }
                ?>
              </td>
              <td>
                <a href="?page=EditTransaksi&id=<?php echo $data['id']; ?>">
                  <span class="fas fa-edit"></span>
                </a>
                &nbsp;&nbsp;
                <a href="?page=HapusTransaksi&id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin hapus <?= $data['id']; ?>');">
                  <span class="fas fa-trash"></span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- END: Content -->