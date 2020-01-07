<?php
class Sampah {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($id_nm_sampah = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM nama_sampah JOIN jenis_sampah ON nama_sampah.id_jn_sampah = jenis_sampah.id_jn_sampah";
    if($id_nm_sampah != null) {
      $sql .= " WHERE id_nm_sampah = $id_nm_sampah";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampiljs($id_jn_sampah = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM jenis_sampah";
    if($id_jn_sampah != null) {
      $sql .= " WHERE id_jn_sampah = $id_jn_sampah";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  // public function tampil_tgl($tgl1, $tgl2) {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT * FROM tb_barang WHERE tgl_publish BETWEEN '$tgl1' AND '$tgl2'";
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }

  # CREATE SAMPAH
  public function tambah($id_jn_sampah, $nm_sampah) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO nama_sampah (nm_sampah, id_jn_sampah) VALUES ('$nm_sampah', '$id_jn_sampah')") or die ($db->error);
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  // # DELETE
  // public function hapus($nik) {
  //   $db = $this->mysqli->conn;
  //   $db->query("DELETE FROM warga WHERE nik = '$nik'") or die ($db->error);
  // }
  //
  // function __destruct() {
  //   $db = $this->mysqli->conn;
  //   $db->close();
  // }

}
 ?>
