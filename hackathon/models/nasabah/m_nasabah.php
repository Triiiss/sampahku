<?php
class Nasabah {

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

  # CREATE
  public function tambah($norek, $nm_nasabah, $no_hp, $email, $rt, $alamat) {
    $db = $this->mysqli->conn;
    $db->query("INSERT INTO nasabah VALUES ('$norek', '$nm_nasabah', '$no_hp', '$email', '$rt', '$alamat')") or die ($db->error);
  }

  # UPDATE
  public function edit($sql) {
    $db = $this->mysqli->conn;
    $db->query($sql) or die ($db->error);
  }

  # DELETE
  public function hapus($norek) {
    $db = $this->mysqli->conn;
    $db->query("DELETE FROM nasabah WHERE norek = '$norek'") or die ($db->error);
  }

  function __destruct() {
    $db = $this->mysqli->conn;
    $db->close();
  }

  public function tampilcetakdetilpembelian($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.nm_nasabah, n.rt, p.tanggal AS tangal, p.id_pembelian, ns.nm_sampah, dp.berat_pembelian, dpj.harga_penjualan, pj.tanggal FROM nasabah n, pembelian p, detil_pembelian dp, nama_sampah ns, detil_penjualan dpj, penjualan pj WHERE n.norek=p.norek AND p.id_pembelian=dp.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah AND ns.id_nm_sampah=dpj.id_nm_sampah AND dpj.id_penjualan=pj.id_penjualan AND p.tanggal=pj.tanggal";
    if($norek != null) {
      $sql .= " AND n.norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function tampilcetaktotalpembelian($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.nm_nasabah, p.id_pembelian, p.tanggal, SUM(ct.saldo_tabungan) AS saldo_tabungan, ct.status FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian GROUP BY p.tanggal";
    if($norek != null) {
      $sql .= " AND n.norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function a($norek) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.nm_nasabah, n.norek, p.tanggal, ct.id_penarikan, pn.tanggal, ct.id_catatan_tabungan, ct.saldo_tabungan, ct.status, ct.id_penarikan, ct.id_pembelian FROM nasabah n, pembelian p, penarikan pn, catatan_tabungan ct";
    if($norek != null) {
      $sql .= " WHERE (n.norek=p.norek AND p.id_pembelian=ct.id_pembelian AND n.norek=$norek) OR (pn.norek=n.norek AND pn.id_penarikan=ct.id_penarikan AND n.norek=$norek) GROUP BY ct.id_catatan_tabungan
";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function p($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, p.tanggal, p.id_pembelian, ct.id_catatan_tabungan, ct.saldo_tabungan, ct.status, ct.id_penarikan, ct.id_pembelian FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian";
    if($norek != null) {
      $sql .= " AND n.norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  public function pn($norek = null) {
    $db = $this->mysqli->conn;
    $sql = "SELECT n.norek, n.nm_nasabah, pn.tanggal, pn.id_penarikan, ct.id_catatan_tabungan, ct.saldo_tabungan, ct.status, ct.id_penarikan, ct.id_pembelian FROM nasabah n, penarikan pn, catatan_tabungan ct WHERE n.norek=pn.norek AND pn.id_penarikan=ct.id_penarikan";
    if($norek != null) {
      $sql .= " AND n.norek = $norek";
    }
    $query = $db->query($sql) or die ($db->error);
    return $query;
  }

  // public function tampilcetakpenarikan($norek = null) {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT n.nm_nasabah, p.id_pembelian, p.tanggal, SUM(ct.saldo_tabungan) AS saldo_tabungan, ct.status FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian GROUP BY p.tanggal";
  //   if($norek != null) {
  //     $sql .= " AND n.norek = $norek";
  //   }
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }
  //
  // public function tampilcetakpembelian($norek = null) {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT n.norek, n.nm_nasabah, n.rt, n.no_hp, ct.saldo_tabungan AS saldo_pembelian, ct.status, p.tanggal FROM nasabah n, pembelian p, catatan_tabungan ct WHERE n.norek=p.norek AND p.id_pembelian=ct.id_pembelian";
  //   if($norek != null) {
  //     $sql .= " AND n.norek = $norek";
  //   }
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }
  //
  // public function tampildetailpembelianberatsampah($norek = null) {
  //   $db = $this->mysqli->conn;
  //   $sql = "SELECT ns.nm_sampah, SUM(dp.berat_pembelian) AS berat_pembelian FROM nasabah n, pembelian p, detil_pembelian dp, nama_sampah ns, detil_pembelian dp WHERE dp.id_nm_sampah=ns.id_nm_sampah AND n.norek=p.norek AND p.id_pembelian=dp.id_pembelian AND dp.id_nm_sampah=ns.id_nm_sampah GROUP BY ns.nm_sampah";
  //   if($norek != null) {
  //     $sql .=" AND norek = $norek";
  //   }
  //   $query = $db->query($sql) or die ($db->error);
  //   return $query;
  // }

}
 ?>
