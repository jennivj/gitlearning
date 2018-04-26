<?php
 //$con = mysqli_connect('localhost', 'root','','test');
   $con = mysqli_connect('127.0.0.1', 'umm_zeitraum_usr','D5Jv8*qMwhV4iCP$knKY','umm_zeitraum');


 $dumpfile = "doc2/";
if ( !file_exists($dumpfile) ) {mkdir($dumpfile,0777); echo "created";}
else { 
if ( !chmod($dumpfile,0777) ) echo "Unable to change $dumpfile permissions<p>";
}
 
  
 

 
 

 
 
 


 
$result = mysqli_query( $con,'SELECT * FROM `users`  '); 
if (!$result) die('Couldn\'t fetch records'); 
  $num_fields = mysqli_affected_rows ( $con); 

 
 
 
$headers = array();  $res= [];  $resultArr= []; $newsletterAppend = [];
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
//-----------------------fetching newsletter hresder
    $result_role_header = mysqli_query( $con,'SELECT * FROM  roles where id in(5,6,7,8) ' );

        while ($rows = mysqli_fetch_array( $result_role_header))
                {
                    $headers_app[] = $rows['display_name'];
                }
//---------------------------------

  //  $headers[] = 'NewsLetterName';
while ($row = mysqli_fetch_assoc( $result)) 
{
	  

	 
     $res[$row['id']] =	array_values($row) ;
	 $result_roleUser = mysqli_query( $con,'SELECT * FROM  role_user  WHERE user_id='.$row['id']);


	while ($row_meta = mysqli_fetch_array( $result_roleUser)) 		
		{
            //$res[$row['id']][] = 'No';
            $result_role = mysqli_fetch_array(mysqli_query( $con,'SELECT * FROM  roles  WHERE  id='. $row_meta['role_id']));

            foreach (  $headers_app as $key => $val ){

                //$newsletterAppend2[$row['id']][ $val] = 'No';
                if( $val ==   $result_role['display_name']){
                    $newsletterAppend2[$row['id']][] = $result_role['display_name'];
                   // $res[$row['id']][] = $result_role['display_name'];
                }
            }
            /*
          foreach (  $headers as $key => $val ){

                 // if( $val == 'NewsLetterName'){
                     $result_role = mysqli_fetch_array(mysqli_query( $con,'SELECT * FROM  roles  WHERE  id='. $row_meta['role_id']));
                    // print_r(  $result_role);
                      if ( $val == $result_role['display_name']){

                          $newsletterAppend[$row['id']][] = $result_role['display_name'];
                      }


             // }
          } */

		}
 	//------------
   // print_R(  $newsletterAppend2[$row['id']]  );
	if(isset(  $newsletterAppend2[$row['id']] ) ){
        foreach ( $headers_app as $kl => $vl ){

            foreach ( $newsletterAppend2[$row['id']]  as $k2 => $v2 ){
                if(in_array(  $v1 ,   $newsletterAppend2[$row['id']] )) {
                    $res[$row['id']][] = 	 $vl ;}
               else $res[$row['id']][] = 'no';

            }

              //  else $res[$row['id']][] = 'no';

        }

	}

// print_R(  $res[$row['ID']]['newsletter']);  
//---------------	
}

print_R(  $res );
  exit();
 
	 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="exportusers.csv"');
header('Pragma: no-cache');    
 header('Expires: 0');
  fputcsv($fp, $headers); 
      foreach (  $res as $k => $v ){
		//  if(
   fputcsv($fp, array_values($v)); 
	  }

 exit();
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