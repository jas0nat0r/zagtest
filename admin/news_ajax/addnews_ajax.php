<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
 
  															
																 $categoryname = $_POST['catname'];
																 $categorudescription = $_POST['catdescription'];
																 $imagepath = $_POST['slide_image1'];
														 		 date_default_timezone_set('Asia/Colombo');
 													             $currentdate =  time();

																// Prints something like: Monday
													
													//			 $currentdate = 
															///	 die();
															
																if( $categoryname!=""&& $categorudescription!=""){
																	  $sql = "INSERT INTO " . $tblNews . " (newstitle, newsdescription, publishdate) " .
																				" VALUES ('".$categoryname ."','". $categorudescription."','".  $currentdate ."')";
																				//echo $sql;
																				//die();
																				// print_r($_REQUEST);
																		mysql_query($sql) or die(mysql_error());
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}
                                                            
                                                            
                                                            
