<?php
// Load file koneksi.php
include "../../config/koneksi.php";


// Ambil data ID Provinsi yang dikirim via ajax post
$id_jn_sampah = $_POST['id_jn_sampah'];
// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = $pdo->prepare("SELECT * FROM nama_sampah WHERE id_jn_sampah='".$id_jn_sampah."' ORDER BY nm_sampah");
$sql->execute(); // Eksekusi querynya
// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>Pilih</option>";

while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
  $html .= "<option value='".$data['id_nm_sampah']."'>".$data['nm_sampah']."</option>"; // Tambahkan tag option ke variabel $html
}
$callback = array('data_sampah'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
