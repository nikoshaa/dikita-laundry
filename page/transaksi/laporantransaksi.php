<?php

// define ('SITE_ROOT', realpath(dirname(__FILE__)));
require_once __DIR__ . './../../asset/vendor/mPDF-8/autoload.php';
require __DIR__ . './../../load/function.php';

$query = "SELECT tbl_transaksi.id, tbl_transaksi.tanggal ,tbl_pelanggan.nama, tbl_paket.paket, tbl_transaksi.qty, tbl_transaksi.biaya, tbl_transaksi.bayar, tbl_transaksi.kembalian 
            FROM tbl_transaksi 
            INNER JOIN tbl_pelanggan 
            ON tbl_transaksi.id_pelanggan = tbl_pelanggan.id 
            INNER JOIN tbl_paket 
            ON tbl_transaksi.kd_paket = tbl_paket.id 
            ORDER BY tbl_transaksi.id DESC";
$transaksi = viewDatas($query);

$reportDate = date('l, d M Y');

$html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./../../asset/css/style.laporan.css" type="text/css">
      <title>Laporan Data Transaksi</title>
    </head>

    <body>
      <h1>Laporan Data Transaksi</h1>
      <p>' . $reportDate . '</p>
      <table border="1">
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
          </tr>
        </thead>
        <tbody>';
$no = 1;
foreach ($transaksi as $data) {
  $html .= '
          <tr>
            <td>' . $no++ . '</td>
            <td>' . $data['id'] . '</td>
            <td>' . $data['tanggal'] . '</td>
            <td>' . $data['nama'] . '</td>
            <td>' . $data['paket'] . '</td>
            <td>' . $data['qty'] . ' kg</td>
            <td>' . $data['biaya'] . '</td>
            <td>' . $data['bayar'] . '</td>
            <td>' . $data['kembalian'] . '</td>
          </tr>';
}

$html .= '
        </tbody>
      </table>
    </body>
    </html>
  ';

$mpdf = new \Mpdf\Mpdf();

$date = date('d-M-Y');
$mpdf->setFooter('{PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->Output($date . '-Laporan-Data-Transaksi.pdf', 'I');
