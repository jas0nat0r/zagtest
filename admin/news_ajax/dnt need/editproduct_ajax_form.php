<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
                                                                 $product_id = $_POST['pro_id'];
                                                                 $productname = $_POST['prdname'];
																 $productdescription = $_POST['prddescription'];
																 $producturl = $_POST['prdurl'];
																 if($_POST['slide_image'][0]==""){
																	     $imagepath = $_POST['slide_image_current'];
																	 }else{
																		 $imagepath = $_POST['slide_image'][0];
																		 }
																 
																 if($_POST['slide_image'][0]=="" && $_POST['slide_image_current']==""){
																	 $imagepath = '../images/catergory/default.jpg';
																	 
																	 }
																	 
																	// echo $imagepath;
																 $categoryid = $_POST['productcategory'];
																 if( $productname!=""&& $productdescription!=""){
																	 $sql = 'UPDATE  ' . $tbl_prduct . ''.
																				' SET '.
																				' productname = "'.$productname.'",'.
																				' productdescription = "'.$productdescription.'",'.
																				' productimage = "'.$imagepath.'",'.
																				' cagegoryid = "'.$categoryid.'",'.
																				' producturl = "'.$producturl.'"'.
																				' WHERE product_id = "'.$product_id.'"';
																										//echo $sql;					
																		mysql_query($sql) or die(mysql_error());														 
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}
?>