<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
                                                                 
																
																 $categoryname = $_POST['catname'];
																 $categorudescription = $_POST['catdescription'];
																// $imagepath = $_POST['slide_image'];
																 $category_id = $_POST['newsid'];
																if( $categoryname!=""&& $categorudescription!=""){
																	 $sql = 'UPDATE  ' . $tblNews . ''.
																				' SET '.
																				' newstitle = "'.$categoryname.'",'.
																				' newsdescription = "'.$categorudescription.'"'.
																				' WHERE idnews = "'.$category_id.'"';
																							//			echo $sql;					
																		mysql_query($sql) or die(mysql_error());														 
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}