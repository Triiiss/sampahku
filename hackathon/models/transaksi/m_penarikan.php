<?php
class Penarikan {

  private $mysqli;

  function __construct($conn) {
    $this->mysqli = $conn;
  }

  public function tampil($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM nasabah";
    if($norek != null) {
      $sql .= " WHERE norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilpenabungan() {
    $db = $this->mysqli->conn;
    $sql = "SELECT SUM(ct.saldo_tabungan) AS saldo_penabungan, ct.status, ct.id_pembelian, n.nm_nasabah, n.norek, n.rt, n.no_hp FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian AND ct.status='penabungan' GROUP BY n.norek";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilpenarikan() {
    $db = $this->mysqli->conn;
    $sql = "SELECT SUM(ct.saldo_tabungan) AS saldo_penarikan, ct.status, ct.id_penarikan, n.nm_nasabah, n.norek FROM nasabah n, penarikan pn, catatan_tabungan ct WHERE n.norek=pn.norek AND pn.id_penarikan=ct.id_penarikan AND ct.status='penarikan' GROUP BY n.norek";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampiltarik() {
    $db = $this->mysqli->conn;
    $sql = "SELECT * FROM penarikan ORDER BY id_penarikan DESC LIMIT 1";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilsaldopembelian() {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, n.rt, n.no_hp, SUM(ct.saldo_tabungan) AS saldo_pembelian FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian GROUP BY n.norek";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilsaldopembelian_tanggal($tgl1, $tgl2) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, n.rt, n.no_hp, SUM(ct.saldo_tabungan) AS saldo_pembelian FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian AND p.tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY n.norek";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilsaldopenarikan() {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, n.rt, n.no_hp, ct.saldo_tabungan AS saldo_penarikan, ct.status, pn.tanggal FROM nasabah n, penarikan pn, catatan_tabungan ct WHERE n.norek=pn.norek AND pn.id_penarikan=ct.id_penarikan";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilsaldopenarikan_tanggal($tgl1, $tgl2) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, n.rt, n.no_hp, ct.saldo_tabungan AS saldo_penarikan, ct.status, pn.tanggal FROM nasabah n, penarikan pn, catatan_tabungan ct WHERE n.norek=pn.norek AND pn.id_penarikan=ct.id_penarikan AND pn.tanggal BETWEEN '$tgl1' AND '$tgl2'";
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  # UPDATE
  public function tambahtarik($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  # UPDATE
  public function tambahct($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  function __destruct() {
    $db = $this->mysqli->conn;
    $db->close();
  }

}
 ?>
