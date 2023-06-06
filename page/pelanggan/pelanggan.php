<!-- START: Content -->
<div class="container">

  <div class="card mt-4 mb-4">
    <div class="card-header">
      <h5>Pelanggan</h5>
    </div>
    <div class="card-body">
      <!-- START: Button -->
      <div class="d-flex justify-content-start mb-4">
        <a href="?page=TambahPelanggan" type="button" class="btn btn-sm btn-primary mr-3"><i class="fas fa-plus fa-sm text-white"></i> Tambah Data</a>
        <a href="page/pelanggan/laporanpelanggan.php" target="_blank" type="button" class="btn btn-sm btn-info mr-3"><i class="fas fa-download fa-sm text-white"></i> Hasilkan PDF</a>
      </div>
      <!-- END: Button -->
      <table id="dataTables" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Id Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat Pelanggan</th>
            <th>No Handphone</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php $pelanggan = viewAllData("tbl_pelanggan"); ?>
          <?php foreach($pelanggan as $data) : ?>
          <tr>
            <td><?= $no++;?></td>
            <td><?= $data['id']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td><?= $data['no_hp']; ?></td>
            <td>
              <a href="?page=EditPelanggan&id=<?php echo $data['id']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              &nbsp;&nbsp;
              <?php 
                $id = $data['id'];
                $result = viewDatas("SELECT * FROM `tbl_transaksi` WHERE tbl_transaksi.id_pelanggan = '$id'");
                if ( count($result) > 0 ) { ?>
                <a href="#"
                  onclick="return confirm('Data sedang digunakan');">
                  <span class="fas fa-trash"></span>
              <?php } else { ?>
                <a href="?page=HapusPelanggan&id=<?php echo $data['id']; ?>"
                  onclick="return confirm('Yakin ingin hapus <?= $data['nama']; ?>');">
                  <span class="fas fa-trash"></span>              
              <?php } ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- END: Content -->