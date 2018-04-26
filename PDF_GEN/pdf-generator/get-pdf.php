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

 $txt  = '<h1>Test</h1> <p>Test paragragp</p>';
 
   //$txt   .= include('pdf_content.php');
/*
$txt = include('pdf_content.php');
  ob_get_contents();

print_R(  ob_get_contents());
ob_end_clean();
 */
 
  include('pdf_content.php');
 $g =  (string)$txt   ;
	 
 $dompdf->loadHtml (  $g   );
 

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>