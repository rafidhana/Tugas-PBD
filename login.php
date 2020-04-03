<?php
session_start();
include "koneksi.php";

 
if (isset($_POST["enter"])) {
	# code...

	$username=$_POST["username"];
	$password=$_POST["password"];
	
	$sql="insert into admin1 values ('','$username','$password')";
	$hasil = mysqli_query($koneksi, $sql);
	 header("location:index.php");
 exit;
}

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from admin1 where username='$username' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:curd_prodi.php");
}else{
	header("location:index.php?pesan=gagal");
}
?>

