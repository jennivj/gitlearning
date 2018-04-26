<?php
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier');
 $options->set('isRemoteEnabled', true);
// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

 
 
$txt = file_get_contents('pdf_text.php');
 
					 
	 // echo $txt;
     //      exit;
 $dompdf->loadHtml($txt );
 

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>