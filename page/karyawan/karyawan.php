<!-- START: Content -->
<div class="container">

  <div class="card mt-4">
    <div class="card-header">
      <h5>Karyawan</h5>
    </div>
    <div class="card-body">
      <!-- START: Button -->
      <div class="d-flex justify-content-start mb-4">
        <a href="?page=TambahKaryawan" type="button" class="btn btn-sm btn-primary mr-3"><i class="fas fa-plus fa-sm text-white"></i> Tambah Data</a>
        <a href="page/karyawan/laporankaryawan.php" target="_blank" type="button" class="btn btn-sm btn-info mr-3"><i class="fas fa-download fa-sm text-white"></i> Hasilkan PDF</a>
      </div>
      <!-- END: Button -->
      <table id="dataTables" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Karyawan</th>
            <th>Username</th>
            <th>No Handphone</th>
            <th>Alamat</th>
            <th>Catatan</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php $karyawan = viewDatas("SELECT * FROM `tbl_karyawan` WHERE tbl_karyawan.role = 'Karyawan'"); ?>
          <?php foreach($karyawan as $data) : ?>
          <tr>
            <td><?= $no++;?></td>
            <td><img class="img" width="70px" height="70px" src="upload/karyawan/<?= $data['image']; ?>"
                alt="<?= $data['nama']; ?>">
            <td><?= $data['nama']; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['no_hp']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td><?= $data['catatan']; ?></td>
            <td>
              <a href="?page=EditKaryawan&id=<?php echo $data['id']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              <a href="?page=PengaturanKaryawan&id=<?php echo $data['id']; ?>">
                <span class="fas fa-cogs"></span>
              </a>
              &nbsp;&nbsp;
              <a href="?page=HapusKaryawan&id=<?php echo $data['id']; ?>"
                onclick="return confirm('Yakin ingin hapus <?= $data['nama']; ?>');">
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