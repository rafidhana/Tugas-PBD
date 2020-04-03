<?php
function open_connection() {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "akademik63";
	$koneksi = mysqli_connect($hostname, $username, $password, $dbname);
	return $koneksi;
	}  ?>