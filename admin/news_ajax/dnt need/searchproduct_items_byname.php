<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");
                                               
							$keyword = $_POST['srchstring'];
							if($keyword!= ""){
								$sql = 'SELECT  * From ' . $tbl_prduct . ' p, ' . $tbl_category .' e  '.
										' WHERE  p.cagegoryid = e.categoryid and p.productname LIKE "'.$keyword.'%" ' ;
							
                        //    echo $sql;
                            $rs = mysql_query($sql) or die(mysql_error()); 
							?>

                            <?php if(mysql_num_rows($rs) <= 0) {
							   echo '<div class="noproduct">No Products Under this Category</div>';
							} ?>
                            <?php while ($row = mysql_fetch_array($rs)) {
                                $autoid = $row['product_id'];
                               
                                $th_img=explode(",", $row['productimage']);
								
							
                                ?>

                                <li id="recordsArray_<?php echo $autoid ?>">
                                    <div id="<?php echo $autoid ?>" style="width:769px;min-height:90px;margin:2px; padding:4px; background-color:#ececec;" onMouseOver="changeColor(this.id,'#dbd9d9')" onMouseOut="changeColor(this.id,'#ececec')">
                                        <div style="width:30px;height:75px; overflow:hidden; float:left; padding-top: 5px;"><img src="images/arrow.png" width="16" class="handle" /></div>

                                        <div style="width:194px;height:77px; overflow:hidden; float:left; padding:2px;">

                                            <img src="<?= $th_img[0] ?>" width="75" height="58" />

                                        </div>
                                        <div style="width:187px;height:77px; overflow:hidden; float:left; padding:2px;">

                                            <?php echo $row['productname']; ?>

                                        </div>
                                            <div style="width:217px;height:77px; overflow:hidden; float:left; padding:2px;">
                                            <?php echo $row['categoryname']; ?>


                                        </div>
                                       
                                        <div style="width:80px;height:65px;  overflow:hidden;float:left;">
                                            <a href="#" class="links"  onClick="dil_edit_form_fetch(<?= $row['product_id']; ?>); return false" id="editproduct">Edit</a>&nbsp;|&nbsp;
                                            <a href="viewallprducts.php?action=d&id=<?= $row['product_id']; ?>" class="links" onClick="return confirm('Do you really want to delete ?');">Delete</a>
                                        </div>   </div>
                                       
                                        <div class="ajaxt_editform" id="ajaxt_editform<?= $row['product_id']; ?>"></div>
                                  

                                </li>   


                                    <?php    }  }  ?>