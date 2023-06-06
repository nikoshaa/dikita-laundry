<?php
  if( isset($_POST['submit']) ) {
    $nama       			= addslashes($_POST['nama']);
    $username         = stripslashes($_POST['username']);
		$email       			= stripslashes($_POST['email']);
		$nohp       			= stripslashes($_POST['no_hp']);
		$alamat       		= addslashes($_POST['alamat']);
    $catatan       		= addslashes($_POST['catatan']);
    $oldusername			= $_POST['oldusername'];
    $oldimage					= $_POST['oldimage'];

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
    if( $_FILES['image']['error'] === 4 ) {
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
          document.location.href = '?page=Profil',true;
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Data gagal diubah');
          document.location.href = '?page=Profil',true;
        </script>
      ";
    }
  }
?>


<div class="container mb-4">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
    <h1>Edit Profil</h1>
    <a href="?page=Profil" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
			<i class="fas fa-chevron-left fa-sm text-white-50"></i> Back</a>
  </div>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="oldimage" value="<?= $user['image']; ?>">
		<input type="hidden" class="form-control" name="oldusername" value="<?= $data['username']; ?>">

    <div class="row">

      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center mb-3">
              <img id="imagePreview" class="profile-user-img img-fluid img-circle" src="upload/karyawan/<?= $user['image']; ?>"
                alt="User profile picture">
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input id="nama" name="nama" class="form-control mb-2" maxlength="50" type="text" placeholder="Masukkan Nama" value="<?= $user['nama']; ?>" required>   
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input id="username" name="username" class="form-control" maxlength="30" type="text" placeholder="Masukkan Username" value="<?= $user['username']; ?>" required>   
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      
      <div class="col-md">
        <!-- About Me Box -->
        <div class="card">
          <div class="card-body">

            <div class="custom-file">
              <input type="file" class="form-control-file" id="image" name="image" aria-describedby="inputGroupFileAddon01">
              <small>Max size is 3MB</small>
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
            <hr>

            <strong><i class="fas fa-mail-bulk mr-1"></i> Email</strong>
            <input class="form-control" type="text" maxlength="200" placeholder="Email" name="email" value="<?= $user['email']; ?>" required>
            <hr>

            <strong><i class="fas fa-phone-alt mr-1"></i> No Handphone</strong>
            <input class="form-control" type="text" maxlength="20" placeholder="No Handphone" name="no_hp" value="<?= $user['no_hp']; ?>" required>
            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
            <input class="form-control" type="text" maxlength="100" placeholder="Alamat" name="alamat" value="<?= $user['alamat']; ?>" required>
            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Catatan</strong>
            <textarea class="form-control" type="text" maxlength="255" placeholder="Catatan" name="catatan" required><?= $user['catatan']; ?></textarea>

            <div class="card-footer text-center mt-3">
              <button type="reset" class="btn btn-danger mr-2"><i class="fas fa-undo"></i> Reset</button>
              <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Change</button>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <!-- /.row -->
  </form>
</div>