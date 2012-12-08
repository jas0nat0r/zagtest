<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
 
  															
															    $sql = "DELETE FROM ".$tblNews." WHERE idnews = ".tosql($_POST['catid'], "Number")."";
																$result = mysql_query($sql);
																//echo $result;
																if ($result){
																	
																	echo 'pass';
																}else{
																	echo 'fail';
																}
																													
                                                            
                                                            
