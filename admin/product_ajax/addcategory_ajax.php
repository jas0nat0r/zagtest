<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

print_r($_POST);
 
  															
																 $categoryname = $_POST['catname'];
																 $categorudescription = $_POST['catdescription'];
																 $imagepath = $_POST['slide_image1'];
																 
																  if($imagepath==""){
																	$imagepathnew = '../images/catergory/default.jpg';
																	 
																 } else{
																	$imagepathnew = $imagepath[0];
																	 }
																if( $categoryname!=""&& $categorudescription!=""){
																	  $sql = "INSERT INTO " . $tbl_category . " (categoryname, categorydescription, categoryimage) " .
																				" VALUES ('".$categoryname ."','". $categorudescription."','".  $imagepathnew ."')";
																				//echo $sql;
																			//	die();
																				// print_r($_REQUEST);
																		mysql_query($sql) or die(mysql_error());
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}
                                                            
                                                            
                                                            
