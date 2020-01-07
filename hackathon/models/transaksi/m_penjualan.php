<?php
class Penjualan {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($date) {
    $db = $this->mysqli->conn;
    $sql = "SELECT ns.id_nm_sampah, ns.nm_sampah, SUM(dp.berat_pembelian) AS berat_pembelian, pj.id_penjualan, dpj.harga_penjualan, p.tanggal FROM detil_pembelian dp, pembelian p, nama_sampah ns, penjualan pj, detil_penjualan dpj WHERE dp.id_pembelian=p.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah  AND p.tanggal=date(NOW()) AND pj.id_penjualan IN (SELECT MAX(id_penjualan) FROM penjualan) GROUP BY dp.id_nm_sampah";
    // $sql = "SELECT ns.id_nm_sampah, ns.nm_sampah, SUM(dp.berat_pembelian) AS berat_pembelian, pj.id_penjualan, dpj.harga_penjualan, p.date FROM detil_pembelian dp, pembelian p, nama_sampah ns, penjualan pj, detil_penjualan dpj WHERE dp.id_pembelian=p.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah AND p.date=date(NOW()) AND ns.id_nm_sampah=dpj.id_nm_sampah AND pj.id_penjualan IN (SELECT MAX(id_penjualan) FROM penjualan) GROUP BY dp.id_nm_sampah";
    if($id_pembelian != null) {
      $sql .= " WHERE id_pembelian = $id_pembelian";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # tampil id_nm_sampah, nm_sampah, berat_penjualan
  public function tampiljp() {
    $db = $this->mysqli->conn;
    $sql = "SELECT SUM(dp.berat_pembelian) AS berat_penjualan, ns.id_nm_sampah, ns.nm_sampah FROM detil_pembelian dp, nama_sampah ns, pembelian p WHERE ns.id_nm_sampah=dp.id_nm_sampah AND p.id_pembelian=dp.id_pembelian AND p.tanggal=date(NOW()) GROUP By ns.id_nm_sampah";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # CREATE
  # tambah detail penjualan
  public function tambahdjp($id_penjualan, $id_nm_sampah, $berat_penjualan) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO detil_penjualan (id_penjualan, id_nm_sampah, berat_penjualan, harga_penjualan) VALUES ('$id_penjualan', '$id_nm_sampah', '$berat_penjualan', '0')") or die ($db->error);
  }

  public function tampilh() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM detil_penjualan";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampiltanggal() {
    $db = $this->mysqli->conn;
    $sql = "SELECT tanggal FROM pembelian GROUP BY tanggal";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilsemua() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM penjualan";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampildetailpenjualan() {
    $db = $this->mysqli->conn;
    $sql = "SELECT ns.id_nm_sampah, pj.id_penjualan, ns.nm_sampah, dpj.berat_penjualan, dpj.harga_penjualan, pj.tanggal FROM nama_sampah ns, penjualan pj, detil_penjualan dpj WHERE ns.id_nm_sampah=dpj.id_nm_sampah AND pj.id_penjualan=dpj.id_penjualan";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilpakhir() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM pembelian ORDER BY tanggal DESC LIMIT 1";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilpctakhir() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM pembelian WHERE tanggal=date(NOW())";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilpjakhir() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM penjualan ORDER BY tanggal DESC LIMIT 1";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilhistory($date = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM penjualan";
    if($date != null) {
      $sql .= " WHERE tanggal = $date";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  // public function tampilpj() {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT p.id_pembelian, pj.id_penjualan FROM pembelian p, penjualan pj ORDER BY p.date DESC LIMIT 1";
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }

  public function tampil_tgl($tgl1, $tgl2) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM tb_barang WHERE tgl_publish BETWEEN '$tgl1' AND '$tgl2'";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # CREATE
  public function tambahjual($norek) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO penjualan (tanggal) VALUES (now())") or die ($db->error);
  }

  # CREATE
  public function tambahdpj($norek) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO penjualan (tanggal) VALUES (now())") or die ($db->error);
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  public function hapusjual($id_penjualan) {
    $db = $this->mysqli->conn;
    $db->query("DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'") or die ($db->error);
  }

  public function hapusct($id_pembelian) {
    $db = $this->mysqli->conn;
    $db->query("DELETE FROM catatan_tabungan WHERE id_pembelian = '$id_pembelian'") or die ($db->error);
  }

  public function hapusjual1($id_penjualan) {
    $db = $this->mysqli->conn;
    $db->query("DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'") or die ($db->error);
  }
}
 ?>
