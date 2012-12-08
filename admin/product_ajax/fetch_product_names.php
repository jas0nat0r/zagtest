<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");

//print_r($_POST);
                                                                 
						                    $keyword = $_POST['searchkeyword'];																
											if( $keyword!=""){
																	 $sql = 'SELECT  productname From ' . $tbl_prduct . ''.
																			' WHERE  productname LIKE "'.$keyword.'%" ' ;
																//	echo $sql;		
																									
																		$rs = mysql_query($sql) or die(mysql_error());														 
																		$array=array();
																		while ($row = mysql_fetch_array($rs)) {
																			$array[] = $row;
																		}
																		
																	//	return $array;
																	echo "<select class='suggetion' multiple onChange='dil_searchvalue(this.value);'>";
																		 foreach($array as $row) {
						 
                                                                           echo  "<option>" . $row['productname']. "</option>" ;
					                                                          }
																		echo "</select>";
																}