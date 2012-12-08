<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
 
  															
															    $sql = "DELETE FROM ".$tbl_category." WHERE categoryid = ".tosql($_POST['catid'], "Number")."";
																$result = mysql_query($sql);
																//echo $result;
																if ($result){
																	
																$sqlfordelete = "select * from " . $tbl_category ." Where categoryid =".tosql($_POST['catid'], "Number")."";
																$rs = mysql_query($sqlfordelete) or die(mysql_error());
																$row = mysql_fetch_array($rs);
																$myFile = $row['categoryimage'];
																unlink($myFile);
																	echo 'pass';
																}else{
																	echo 'fail';
																}
																													
                                                            
                                                            
