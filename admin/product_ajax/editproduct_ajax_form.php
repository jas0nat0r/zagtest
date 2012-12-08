<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");


                                                                 $product_id = $_POST['product_id'];
                                                                 $productname = $_POST['prdname'];
																 $productdescription = $_POST['prddescription'];
																 $producturl = $_POST['prdurl'];
																
																	 $imagepath =  "../productfiles/".$_POST['uploadurl'];;
																	 
																	
																	 
																	// echo $imagepath;
																 //$categoryid = $_POST['productcategory'];
																 if( $productname!=""&& $productdescription!=""){
																	 $sql = 'UPDATE  ' . $tbl_prduct . ''.
																				' SET '.
																				' productname = "'.$productname.'",'.
																				' productdescription = "'.$productdescription.'",'.
																				' productimage = "'.$imagepath.'",'.
																				' producturl = "'.$producturl.'"'.
																				' WHERE product_id = "'.$product_id.'"';
																										//echo $sql;					
																		mysql_query($sql) or die(mysql_error());														 
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}
?>