<?php
// require_once('../../config/koneksi.php');
// require_once('../../models/database.php');
// include "../../models/user/m_user.php";
// $connection = new Database($host, $user, $pass, $database);
// $usr = new User($connection);

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
// $usr->login("SELECT * FROM user WHERE username='$username' AND password='$password'");
$login = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:../../home_admin.php");

	// cek jika user login sebagai pegawai
	}else if($data['level']=="pegawai"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pegawai";
		// alihkan ke halaman dashboard pegawai
		header("location:halaman_pegawai.php");

	// cek jika user login sebagai pengurus
}else if($data['level']=="bendahara"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "bendahara";
		// alihkan ke halaman dashboard pengurus
		header("location:../../home_admin.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagalwoy");
	}
}else{
	header("location:../../index.php?pesan=gagalgaadauser");
}

 ?>
