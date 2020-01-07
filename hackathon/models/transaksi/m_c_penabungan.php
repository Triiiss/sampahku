<?php
class C_Jual {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampilsemuadata() {
    $db = $this->mysqli->conn;
    $sql = "SELECT p.id_pembelian, dp.berat_pembelian, ns.nm_sampah, dpj.harga_penjualan, p.tanggal FROM pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE p.id_pembelian=dp.id_pembelian AND ns.id_nm_sampah=dp.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND pj.id_penjualan=dpj.id_penjualan AND p.tanggal=date(NOW()) AND pj.tanggal=date(NOW())";
    $sql = "SELECT p.id_pembelian, dp.berat_pembelian, ns.nm_sampah, dpj.harga_penjualan, p.tanggal, pj.id_penjualan FROM pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE p.id_pembelian=dp.id_pembelian AND ns.id_nm_sampah=dp.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND pj.id_penjualan=dpj.id_penjualan AND p.tanggal=date(NOW()) AND pj.tanggal=date(NOW())";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilidpembelian() {
    $db = $this->mysqli->conn;
    $sql = "SELECT id_pembelian FROM pembelian WHERE tanggal=date(NOW())";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function lempar($id_pembelian) {
    $db = $this->mysqli->conn;
    $sql = "SELECT p.id_pembelian, dp.berat_pembelian, ns.nm_sampah, dpj.harga_penjualan, p.tanggal FROM pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE p.id_pembelian=dp.id_pembelian AND ns.id_nm_sampah=dp.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND pj.id_penjualan=dpj.id_penjualan AND p.tanggal=date(NOW()) AND pj.tanggal=date(NOW()) AND p.id_pembelian=$id_pembelian ";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # UPDATE
  public function show($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  #CREATE
  public function tambahct($id_pembelianp, $hasilakhir) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO catatan_tabungan (saldo_tabungan, status, id_penarikan, id_pembelian) VALUES ('$hasilakhir', 'penabungan', '0', '$id_pembelianp')") or die ($db->error);
  }
  #CREATE
  public function tambahcp($id_penjualan, $totaluang) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO catatan_penjualan (saldo_penjualan, id_penjualan) VALUES ('$totaluang', '$id_penjualan')") or die ($db->error);
  }

  function __destruct() {
    $db = $this->mysqli->conn;
    $db->close();
  }

}
 ?>
