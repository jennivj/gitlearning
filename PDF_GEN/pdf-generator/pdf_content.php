 <?php  
$array= array(2,5,6,7,8,9,3,7,4,4,7);

 ob_start(); ?>
<link rel="stylesheet" type="text/css" href="http://test.app/pdf-gen/pdfcss.php">
 
<div class="logo-wrapper left">
  <img  class="middle" src="img.png"  alt=""/>
</div>

<form name="frmfirst_step" id="frmfirst_step" method="post" action="#">
       <div class="divTable greenTable"  >
<div class="divTableBody">
<div class="divTableRow">
<div class="divTableCell" style="width:15%;">Tariff<span>*</span></div>
<div class="divTableCell"><select placeholder="" name="tariff" id="tariff" class="" readonly="readonly"><option value="">-- Select --</option><option value="1" selected="">
		Single
	  </option><option value="2">
		Combination
	  </option></select>		<div class="sel-arrow"></div>  </div>
</div> 
  <?php for($i=0 ; $i<=5 ; $i++) {  ?>
 <div class="divTableRow">
<div class="divTableCell"> <span>*</span>&nbsp;</div>
<div class="divTableCell"> <input type="text" name="test" editable="true" value="<?php echo $i ?>">	 </div>
</div> 
<?php
  }  foreach($array as $k => $v){  ?>
  
   <div class="divTableRow">
<div class="divTableCell"> <span>*</span> <?php echo $k ?></div>
<div class="divTableCell"> <input type="text" name="test" editable="true" value="<?php echo $v ?>">	 </div>
</div> 

  
  <?php } ?>
 </div>
</div>
     
		 
 

                     </form>  
					 
 
<?php
$txt = ob_get_contents();
ob_end_clean();

 
//echo $out1 ;
?>
 