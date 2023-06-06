<!-- START: Content -->
<div class="container">

  <div class="card mt-4 mb-4">
    <div class="card-header">
      <h5>Paket</h5>
    </div>
    <div class="card-body">
      <!-- START: Button -->
      <div class="d-flex justify-content-start mb-4">
        <a href="?page=TambahPaket" type="button" class="btn btn-sm btn-primary mr-3"><i
            class="fas fa-plus fa-sm text-white"></i> Tambah Data</a>
        <a href="page/paket/laporanpaket.php" target="_blank" type="button" class="btn btn-sm btn-info mr-3"><i
            class="fas fa-download fa-sm text-white"></i> Hasilkan PDF</a>
      </div>
      <!-- END: Button -->
      <table id="dataTables" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Id Paket</th>
            <th>Nama Paket</th>
            <th>Harga Per Kilo</th>
            <th>Deskripsi Paket</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php $paket = viewAllData("tbl_paket"); ?>
          <?php foreach($paket as $data) : ?>
          <tr>
            <td><?= $no++;?></td>
            <td><?= $data['id']; ?></td>
            <td><?= $data['paket']; ?></td>
            <td><?= $data['harga_kilo']; ?></td>
            <td><?= $data['deskripsi']; ?></td>
            <td>
              <a href="?page=EditPaket&id=<?php echo $data['id']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              &nbsp;&nbsp;
              <?php 
                $id = $data['id'];
                $result = viewDatas("SELECT * FROM `tbl_transaksi` WHERE tbl_transaksi.kd_paket = '$id'");
                if ( count($result) > 0 ) { ?>
                <a href="#"
                  onclick="return confirm('Data sedang digunakan');">
                  <span class="fas fa-trash"></span>
              <?php } else { ?>
                <a href="?page=HapusPaket&id=<?php echo $data['id']; ?>"
                  onclick="return confirm('Yakin ingin hapus <?= $data['paket']; ?>');">
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