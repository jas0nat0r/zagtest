<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
 
  															
																												
																 $productname = $_POST['prdname'];
																 $productdescription = $_POST['prddescription'];
																 $imagepath = $_POST['slide_image1'];
																 $producturl = $_POST['prdurl'];
																 if($imagepath==""){
																	$imagepathnew = '../images/catergory/default.jpg';
																	 
																 } else{
																	$imagepathnew = $imagepath[0];
																	 } 
																 //echo $imagepath;
																 $categoryid = $_POST['productcategory'];
																if( $productname!=""&& $productdescription!=""){
																	  $sql = "INSERT INTO " . $tbl_prduct . " (productname, productdescription, productimage, cagegoryid, producturl) " .
																				" VALUES ('".$productname ."','". $productdescription."','".  $imagepathnew ."','".  $categoryid ."','".  $producturl ."')";
																			//	echo $sql;
																				//die();
																				// print_r($_REQUEST);
																		mysql_query($sql) or die(mysql_error());
																			echo 'pass';
																}else{
																	    echo 'fail';
																	}
                                                            
                                                            
                                                            
