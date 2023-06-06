<?php

	//Deklarasi
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "web_laundry";

	//Koneksi Ke Database
	$koneksi = mysqli_connect($host, $user, $password, $database);

	// Periksa Koneksi
	if (mysqli_connect_errno()){
	echo "Gagal Terhubung ke database : " . mysqli_connect_error();
	}

?>