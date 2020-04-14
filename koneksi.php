<?php
$koneksi = mysqli_connect("localhost","root","","pbd_akademik_3049");
function open_connection() {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname   = "pbd_akademik_3049";
	$koneksi  = mysqli_connect($hostname, $username, $password, $dbname);
	return $koneksi;
}
?>