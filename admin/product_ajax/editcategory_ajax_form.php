<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
                                                                 
																 if($_POST['slide_image'][0]==""){
																	     $imagepath = $_POST['slide_image_current'];
																	 }else{
																		 $imagepath = $_POST['slide_image'][0];
																		 }
																 
																  if($_POST['slide_image'][0]=="" && $_POST['slide_image_current']==""){
																	 $imagepath = '../images/catergory/default.jpg';
																	 
																	 }
																 $categoryname = $_POST['catname'];
																 $categorudescription = $_POST['catdescription'];
																// $imagepath = $_POST['slide_image'];
																 $category_id = $_POST['category_id'];
																if( $categoryname!=""&& $categorudescription!=""){
																	 $sql = 'UPDATE  ' . $tbl_category . ''.
																				' SET '.
																				' categoryname = "'.$categoryname.'",'.
																				' categorydescription = "'.$categorudescription.'",'.
																				' categoryimage = "'.$imagepath.'"'.
																				' WHERE categoryid = "'.$category_id.'"';
																							//			echo $sql;					
																		mysql_query($sql) or die(mysql_error());														 
																		echo 'pass';
																}else{
																	    echo 'fail';
																	}