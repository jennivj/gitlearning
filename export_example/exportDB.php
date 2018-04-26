<?php
echo "<pre> ";
 

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



 $con = mysqli_connect('localhost', 'root','','wpz');
 
 
 
 
 use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
 
// Include Spout library 
require_once 'spout/src/Spout/Autoloader/autoload.php';
 
// check file name is not empty
   
    // Get File extension eg. 'xlsx' to check file is excel sheet
   // $pathinfo = pathinfo($_FILES["file"]["name"]);
     
    // check file has extension xlsx, xls and also check 
    // file is not empty
 
        
        // Temporary file name
  //$inputFileName = 'Kopie von Bestandsdaten.xlsx'; 
  echo   $inputFileName = 'Newsletters-Receiver.xlsx'; 
	echo '==<br>';
        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);
  
        // Open file
        $reader->open($inputFileName);
        
$splitupRow = [5000,5100]; //   [1,250,500]; // [500,750, 1000] , [1000,1250,1500] ,  [1500,1750,2000] ,[2000,2500,3000] ,[3000,3500,4000] ,[4000,4500,5000]
 $total =	1;
 /*
for($i=0; $i<count($splitupRow); $i++) {
	 $total++ ;
	if( count($splitupRow) >= $total ){
echo 'count > ' . $splitupRow[$i] . ' && count <=  ' .$splitupRow[$i+1] ; 
	}
 }
 exit;*/
        // Number of sheet in excel file
		
	 
        foreach ($reader->getSheetIterator() as $sheet) {
			$count = 1;
			
		
			
       if($sheet->getName() =='newsletter' || $sheet->getName() == 'export-a90ede023eacdcaab2af'  ){
			
	 echo '<br>' ;
            // Number of Rows in Excel sheet
			
		 // print_R( $sheet->getRowIterator());	 exit;
		 
            foreach ($sheet->getRowIterator() as $row) {
					 	 
                // It reads data after header. In the my excel sheet, 
                // header is in the first row. 
                if ($count > 1) { 
				
				
				//if($count > 1500 && $count<= 2000 )  {		/*  Give range as $count > 1 && $count<= 500  ,  $count > 500 && $count<= 1000 ,  $count > 1000 && $count<= 1500 , $count > 1500 && $count<= 2000*/	
 for($i=0; $i<count($splitupRow); $i++) {
	 $total++ ;
 if($count > $splitupRow[$i] && isset( $splitupRow[$i+1]) && $count<= $splitupRow[$i+1] )  {
 
                    // Data of excel sheet
              
        
		  $time = '';
		  if($row[5] !="" && !empty($row[5]) ){
		  $time =   ($row[5] );
		   
				 $time_m = (array) ($row[5]);
				 $time =  $time_m['date'];
				  
		 }
		 //echo "<br> ===" .$row[2];
	  	 $sel_sql ="Select * from wp_users where user_email='" .$row[0]."' ";
		 $ss =  mysqli_query($con,$sel_sql) ;
		 $numRows =  mysqli_num_rows(  $ss );
		
			//echo "<br> ===";
			$name= $row[1] .' ' .$row[2];
                if($numRows < 1){
					if($row[0] !=""){
					$pass='NoRealUserPassword';
					//Nicename: 	When this is email jenni13@trash-mail.com then -> this is nicename jenni13trash-mail-com
					            $nicename = str_replace('@','',$row[0]);
								 $nicename = str_replace('.','-', $nicename);
								 
                    $sql = "INSERT into wp_users ( user_login ,user_pass,user_nicename ,user_email,user_registered,display_name) values ('$row[0]' ,'$pass', ' $nicename', '$row[0]','   $time ','$row[0]' )";
                    mysqli_query($con,$sql);
					 $insrt_id = mysqli_insert_id($con);
					 if($row[1] != "" ){
					$sqlins = "INSERT into wp_usermeta ( user_id ,meta_key,meta_value) values ('$insrt_id' , 'first_name', '$row[1]'  )";
					mysqli_query($con,$sqlins);
					 }
					  if($row[2] != "" ){
					$sqlins_last = "INSERT into wp_usermeta ( user_id ,meta_key,meta_value) values ('$insrt_id' , 'last_name', '$row[2]'  )";
					mysqli_query($con,$sqlins_last);
					 }
					}
					
					//$sql = "INSERT into wp_usermeta ( user_login ,user_pass,user_nicename ,user_email,user_registered,display_name) values ('$row[0]' ,'$pass', '$row[0]', '$row[0]','   $time ','$row[0]' )";
                    //mysqli_query($con,$sql);}
					
				}else{ 
				
				 echo "else<br> ===";
		/**********************************/			
					while ($uptrow = mysqli_fetch_assoc($ss)) {
  echo '<br>'. $uptrow['user_email'];
						foreach($uptrow as $key => $field) {  

			// echo '<br>'. $uptrow['user_email'];
			 
				  if($uptrow['user_login'] !=  $uptrow['user_email']){
					          $sqluptlogin = "Update wp_users SET user_login='" . $uptrow['user_email']."' WHERE user_email= '" .$uptrow['user_email']."' ";
							   mysqli_query($con,$sqluptlogin) ;  
				  }
							if($key =='user_nicename'){

							     if(  $uptrow['user_nicename'] != ""){
								      $sel_sql2 ="Select * from wp_usermeta where user_id='" .$uptrow['ID']."' ";
		                            $sel_last =  mysqli_query($con,$sel_sql2) ;
		                       while ($row = mysqli_fetch_assoc($sel_last)) {
								if(  $row['meta_key'] == 'last_name' && $row['meta_value'] == "" ) {
									   $sqlupt = "Update wp_usermeta SET meta_value='".$uptrow['user_nicename'] ."' WHERE user_id= '" . $uptrow['ID']."' AND meta_key='last_name'";
							   $supt=  mysqli_query($con,$sqlupt) ;
								}
							   }
								 }
							 if(empty($uptrow[$key])){  
							//-------------------
						//  echo   $sql_insmeta = "INSERT into wp_usermeta (meta_key,meta_value,user_id) values ('last_name','$field' ,'" .$uptrow['ID']."')";
                      // mysqli_query($con,$sql_insmeta);
		 //------------------------------------
								//user_login = email (same value)
								//nicename also email value with some replaces
								 $nicename = str_replace('@','',$row[0]);
								 $nicename = str_replace('.','-', $nicename);
							   $sqlupt = "Update wp_users SET user_nicename='$nicename' WHERE user_email= '" . $uptrow['user_email']."' ";
							   $supt=  mysqli_query($con,$sqlupt) ;
							   mysqli_query($con,$supt);	 	 
 //echo $key." : empty field :"."<br>"; 

							} 
						}}
					}
        /**********************************/
				}
//echo $row[1] .' Already exists<br>';				
                    //Here, You can insert data into database. 
                  //  print_r(data);
                     
				}}  }
			 $count++;}
              
           }   
        }
 
        // Close excel file
        $reader->close();
 
   
 


?>