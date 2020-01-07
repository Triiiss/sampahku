<?php
class Jenis_Sampah {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($id_jn_sampah = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM jenis_sampah";
    if($id_jn_sampah != null) {
      $sql .= " WHERE id_jn_sampah = $id_jn_sampah";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # CREATE
  public function tambah($nm_jn_sampah) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO jenis_sampah (nm_jn_sampah) VALUES ('$nm_jn_sampah')") or die ($db->error);
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }
}
 ?>
