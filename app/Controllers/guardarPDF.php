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
$dompdf->stream($factura->NEGOCIO.'  '.$date2.'.pdf', array('Attachment' => 1));
?>