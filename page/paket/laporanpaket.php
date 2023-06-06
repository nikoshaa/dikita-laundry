<?php

  // define ('SITE_ROOT', realpath(dirname(__FILE__)));
  require_once __DIR__ . './../../asset/vendor/mPDF-8/autoload.php';
  require __DIR__ . './../../load/function.php';

  $paket = viewAllData("tbl_paket");
  $reportDate = date('l, d M Y');

  $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./../../asset/css/style.laporan.css" type="text/css">
      <title>Laporan Data Paket</title>
    </head>

    <body>
      <h1>Laporan Data Paket</h1>
      <p>'. $reportDate .'</p>
      <table border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Id Paket</th>
            <th>Nama Paket</th>
            <th>Harga Per Kilo</th>
            <th>Deskripsi Paket</th>
          </tr>
        </thead>
        <tbody>';
        $no = 1;
        foreach ($paket as $data) {
        $html .= '
          <tr>
            <td>'. $no++ .'</td>
            <td>'. $data['id'] .'</td>
            <td>'. $data['paket'] .'</td>
            <td>'. $data['harga_kilo'] .'</td>
            <td>'. $data['deskripsi'] .'</td>
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
  $mpdf->Output($date. '-Laporan-Data-Paket.pdf', 'I');
?>