<?php
class Dashboard {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($id_pengurus = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM pengurus";
    if($id_pengurus != null) {
      $sql .= " WHERE id_pengurus = $id_pengurus";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # CREATE
  public function tambah($id_pengurus, $username, $status, $no_hp, $email, $password, $alamat) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO pengurus VALUES ('$id_pengurus', '$username', '$status', '$no_hp', '$email', '$password', '$alamat')") or die ($db->error);
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  function __destruct() {
    $db = $this->mysqli->conn;
    $db->close();
  }

}
 ?>
