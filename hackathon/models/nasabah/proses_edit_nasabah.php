<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../nasabah/m_nasabah.php";
$connection = new Database($host, $user, $pass, $database);
$nsb = new Nasabah($connection);

$norek = $_POST['norek'];
$nm_nasabah = $connection->conn->real_escape_string($_POST['nm_nasabah']);
$no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
$email = $connection->conn->real_escape_string($_POST['email']);
$rt = $connection->conn->real_escape_string($_POST['rt']);
$alamat = $connection->conn->real_escape_string($_POST['alamat']);

$nsb->edit("UPDATE nasabah SET nm_nasabah = '$nm_nasabah', no_hp = '$no_hp', email = '$email', rt = '$rt', alamat = '$alamat' WHERE norek = '$norek'");
echo "<script>window.location='?page=nasabah';</script>";

 ?>
