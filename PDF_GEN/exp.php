<?php
 $con = mysqli_connect('localhost', 'root','','vivat');
 $dumpfile = "doc2/";
if ( !file_exists($dumpfile) ) {mkdir($dumpfile,0777); echo "created";}
else { 
if ( !chmod($dumpfile,0777) ) echo "Unable to change $dumpfile permissions<p>";
}
 
  
 

 
 

 
 
 


 
$result = mysqli_query( $con,'SELECT * FROM `wp_users`  '); 
if (!$result) die('Couldn\'t fetch records'); 
$num_fields = mysqli_affected_rows ( $con); 

 

 
$headers = array();  $res= [];  $resultArr= [];
/*
for ($i = 0; $i < $num_fields; $i++) 
{     
$headers[] = mysqli_field_name($result , $i); 
} */
$fp = fopen('php://output', 'w'); 
if ($fp && $result) 
{ 
/*    

 */
 echo '<pre>';
 $fields = mysqli_num_fields ( $result );
 for ( $i = 0; $i < $fields; $i++ )
{
   $headers[]   = (string) mysqli_fetch_field_direct( $result , $i )->name   ;
 
}

while ($row = mysqli_fetch_array( $result)) 
{
	 
	 
 $res[$row['ID']] =	array_values($row) ;
	$result_meta = mysqli_query( $con,'SELECT * FROM  wp_usermeta  WHERE user_id='.$row['ID']); 
	while ($row_meta = mysqli_fetch_array( $result_meta)) 		
		{	
		 
		   $headers[]   =    $row_meta['meta_key'] ;	
 $res[$row['ID']][$row_meta['meta_key']]=	  $row_meta['meta_value']  ;		   
		}
 
}
//**********************************************

  foreach (  $headers as $key => $val ){
	    foreach (  $res as $k => $v ){
				 $res[$k][$val];
				  foreach (  $v as $k1 => $v1 ){
					if(  $k1  == $val ) { echo 'eq = ' . $v1 .'<br>';}
					else  { echo   ' not eq = ' . $v1 .'<br>'; }
				  }
		}

	  
  }	  
 print_R( $res);
 
 exit();   
	
/*		 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="export.csv"');
header('Pragma: no-cache');    
 header('Expires: 0');
  fputcsv($fp, $headers); 
  */
  foreach (  $res as $key => $val ){
	
	// fputcsv($fp, array_values($val));   
	 //print_R($val);
	   foreach (  $val as $k => $v ){
		     echo "==".$k ;
	   }
}


  
exit();	 

$result = mysqli_query( $con,'SELECT * FROM `wp_users`  '); 

 

	 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="export.csv"');
header('Pragma: no-cache');    
 header('Expires: 0');
  fputcsv($fp, $headers); 
while ($row = mysqli_fetch_array( $result)) 
{
	 fputcsv($fp, array_values($row)); 
	$result_meta = mysqli_query( $con,'SELECT * FROM  wp_usermeta  WHERE user_id='.$row['ID']); 
	while ($row_meta = mysqli_fetch_array( $result_meta)) 
{
	   
 
 fputcsv($fp, array_values($row_meta)); 
}
  
}
die; 
}
 
?>