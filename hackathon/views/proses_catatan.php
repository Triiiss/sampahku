<?php
include "models/transaksi/m_penarikan.php";
$tarik = new Penarikan($connection);

if (@$_GET['act'] == '') {
  $tampilpenabungan = $tarik->tampilpenabungan();
  while ($datapenabungan = $tampilpenabungan->fetch_object()) {
    $nm_warga = $datapenabungan->nm_warga;
    $nikp = $datapenabungan->nik;
    $rt = $datapenabungan->rt;
    $no_hp = $datapenabungan->no_hp;
    $saldo_penabungan = $datapenabungan->saldo_penabungan;
    echo "NIK : ".$nikp;
    echo "<br>";
    echo "Nama : ".$nm_warga;
    echo "<br>";
    echo "rt : ".$rt;
    echo "<br>";
    echo "NO HP : ".$no_hp;
    echo "<br>";
    echo "saldo penabungan : ".$saldo_penabungan;
    echo "<br>";

  $tampilpenarikan = $tarik->tampilpenarikan();
  while ($datapenarikan = $tampilpenarikan->fetch_object()) {
    $nikpn = $datapenarikan->nik;
    $saldo_penarikan = $datapenarikan->saldo_penarikan;
    // echo "NIK : ".$nikpn;
    // echo "<br>";
    if ($nikp == $nikpn) {
      echo "saldo penarikan : ".$saldo_penarikan;
      echo "<br>";
      $saldo = $saldo_penabungan - $saldo_penarikan;
      // echo "saldo coy : ".$saldo;
      // echo "<br>";
      // echo "<br>";
      // echo "<br>";
    } else {
      $saldo = $saldo_penabungan;
      // echo "saldo : ".$saldo;
      echo "<br>";
    }
    echo "saldo coy 1: ".$saldo;
    echo "<br>";
    echo "<br>";
    echo "<br>";
  }
  // echo "<br>";
  // echo "saldo coy 2: ".$saldo;
  // echo "<br>";
  // echo "<br>";
  // echo "<br>";
}

}
?>
