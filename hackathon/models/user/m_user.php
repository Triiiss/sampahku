<?php
class User {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  // #LOGIN
  // public function tampil($id_user = null) {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT * FROM tb_barang";
  //   if($id != null) {
  //     $sql .= " WHERE id_brg = $id";
  //   }
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }
}
 ?>
