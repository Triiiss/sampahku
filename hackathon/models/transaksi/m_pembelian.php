<?php
class Pembelian {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($id_pembelian = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM pembelian ORDER BY id_pembelian DESC LIMIT 1";
    if($id_pembelian != null) {
      $sql .= " WHERE id_pembelian = $id_pembelian";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilnasabah($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM nasabah";
    if($norek != null) {
      $sql .= " WHERE norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampildp($id_pembelian = null) {
    $db = $this->mysqli->conn;
    // $sql = "SELECT dp.id_pembelian, ns.nm_sampah, dp.berat_pembelian FROM detil_pembelian dp, nama_sampah ns WHERE id_pembelian IN (SELECT MAX(id_pembelian) FROM pembelian) AND dp.id_nm_sampah=ns.id_nm_sampah";
    // $sql = "SELECT dp.id_pembelian, dp.id_nm_sampah, p.id_pembelian, ns.nm_sampah, dp.berat_pembelian FROM detil_pembelian dp, pembelian p, nama_sampah ns WHERE dp.id_pembelian IN (SELECT MAX(id_pembelian) FROM pembelian) AND dp.id_nm_sampah=ns.id_nm_sampah AND p.id_pembelian=dp.id_pembelian";
    $sql = "SELECT dp.id_nm_sampah, p.norek, p.id_pembelian, ns.nm_sampah, dp.berat_pembelian FROM detil_pembelian dp, pembelian p, nama_sampah ns WHERE p.id_pembelian IN (SELECT MAX(id_pembelian) FROM pembelian) AND dp.id_nm_sampah=ns.id_nm_sampah AND p.id_pembelian=dp.id_pembelian";
    if($id_pembelian != null) {
      $sql .= " WHERE id_pembelian = $id_pembelian";
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

  # CREATE
  public function tambahbeli($norek) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO pembelian (tanggal, norek) VALUES (now(), '$norek')") or die ($db->error);
  }

  # CREATE
  public function tambahdetailbeli($id_pembelian, $id_nm_sampah, $berat_pembelian) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO detil_pembelian VALUES ('$id_pembelian', '$id_nm_sampah', '$berat_pembelian')") or die ($db->error);
  }

  public function show($norek) {
    $db = $this->mysqli->conn;
    $db->query("SELECT * FROM nasabah WHERE norek = '$norek'") or die ($db->error);
    return $query;
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  public function hapus($id_pembelian) {
    $db = $this->mysqli->conn;
    $db->query("DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'") or die ($db->error);
  }

  public function tampildatepembelian() {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, p.tanggal FROM nasabah n, pembelian p WHERE n.norek=p.norek";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilcetakpembelian() {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.nm_nasabah, n.rt, p.tanggal, ns.nm_sampah, dp.berat_pembelian, dpj.harga_penjualan, pj.tanggal FROM nasabah n, pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE n.norek=p.norek AND p.id_pembelian=dp.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND dpj.id_penjualan=pj.id_penjualan AND p.tanggal=pj.tanggal";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilcetakpembelian_tanggal($tgl1, $tgl2) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.nm_nasabah, n.rt, p.tanggal, ns.nm_sampah, dp.berat_pembelian, dpj.harga_penjualan, pj.tanggal FROM nasabah n, pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE n.norek=p.norek AND p.id_pembelian=dp.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND dpj.id_penjualan=pj.id_penjualan AND p.tanggal=pj.tanggal AND p.tanggal BETWEEN '$tgl1' AND '$tgl2'";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampildetailpembelianberatsampah() {
    $db = $this->mysqli->conn;
    $sql = "SELECT ns.nm_sampah, SUM(dp.berat_pembelian) AS berat_pembelian FROM nama_sampah ns, detil_pembelian dp WHERE dp.id_nm_sampah=ns.id_nm_sampah GROUP BY ns.nm_sampah";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampildetailpembelianberatsampah_tanggal($tgl1, $tgl2) {
    $db = $this->mysqli->conn;
    $sql = "SELECT ns.nm_sampah, SUM(dp.berat_pembelian) AS berat_pembelian FROM pembelian p, detil_pembelian dp, nama_sampah ns WHERE p.id_pembelian=dp.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah AND dp.id_nm_sampah=ns.id_nm_sampah AND p.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY ns.nm_sampah";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  function __destruct() {
    $db = $this->mysqli->conn;
    $db->close();
  }

}
 ?>
