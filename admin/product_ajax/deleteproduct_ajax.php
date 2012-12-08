<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
 
  															
															$sql = "DELETE FROM ".$tbl_prduct." WHERE product_id = ".tosql($_POST['proid'], "Number")."";
																$result = mysql_query($sql) ;
																//$suc_msg = 'Product Deleted Sucessfully';
																	if ($result){
																$sqlfordelete = "select * from " . $tbl_prduct ." Where product_id =".tosql($_POST['proid'], "Number")."";
																$rs = mysql_query($sqlfordelete) or die(mysql_error());
																$row = mysql_fetch_array($rs);
																$myFile = $row['productimage'];
																unlink($myFile);
																	echo 'pass';
																}else{
																	echo 'fail';
																}