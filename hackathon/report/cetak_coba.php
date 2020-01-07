<?php
require '../assets/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML('<h1>HelloTris</h1>');
$html2pdf->output('exeple.pdf');

// $content = "
// <page>
// <h1>Example </h1>
// <br>
// Test<br>
// </page>";
//
// require_once('../assets/html2pdf/html2pdf.class.php');
// $html2pdf = new HTML2PDF('P', 'A4', 'en');
// $html2pdf->writeHTML($content);
// $html2pdf->output('exemple.pdf');
?>
