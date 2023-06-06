<?php 
  // Jika tidak ada ID di URL
  if (!isset($_GET['id'])) {
    header("Location: ?page=Paket");
    exit;
  }

  // Mengambil ID dari URL
  $id = $_GET['id'];

  if (deleteData('tbl_paket', $id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = '?page=Paket';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal dihapus');
          </script>";  
  }
?>