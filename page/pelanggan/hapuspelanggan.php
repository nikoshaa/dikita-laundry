<?php 
  // Jika tidak ada id di url
  if (!isset($_GET['id'])) {
    header("Location: ?page=Pelanggan");
    exit;
  }

  // Mengambil ID dari URL
  $id = $_GET['id'];

  if (deleteData('tbl_pelanggan', $id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = '?page=Pelanggan';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal dihapus');
          </script>";  
  }
?>