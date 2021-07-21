<?php
require_once('../../config.php');
use Dompdf\Dompdf;
ob_start();
include(RAIZ.'controller/generarDocumento/facturaPDF.php');
$html = ob_get_clean();
$options = ['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true];
$dompdf = new Dompdf($options);
$dompdf->setBasePath($_SERVER['DOCUMENT_ROOT']);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portatil');
$dompdf->render();
$dompdf->stream('Factura.pdf', array('Attachment' => 0));
//$output = $dompdf->output();
//file_put_contents(RAIZ.'python/temp/form.pdf', $output);
//echo shell_exec('C:\laragon\www\PC-Barranquilla\python\print.py');
//echo "<script>window.close();</script>";
?>