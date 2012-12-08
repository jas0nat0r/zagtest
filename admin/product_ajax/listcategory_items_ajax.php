<?php 
include ("../common/common.php");
include ("../common/xmlfunctions.php");
                                               
							
							 $sql = "select * from " . $tbl_category . "";
							//echo $sql;
                            $rs = mysql_query($sql) or die(mysql_error()); ?>


                            <?php while ($row = mysql_fetch_array($rs)) {
                                $autoid = $row['categoryid'];
                                
                                $th_img=explode(",", $row['categoryimage']);
                                ?>

                                          <li id="recordsArray_<?php echo $autoid ?>">
                                    <div id="<?php echo $autoid ?>" style="width:769px;min-height:90px;margin:2px; padding:4px; background-color:#ececec;" onMouseOver="changeColor(this.id,'#dbd9d9')" onMouseOut="changeColor(this.id,'#ececec')">
                                        <div style="width:30px;height:75px; overflow:hidden; float:left; padding-top: 5px;"><img src="images/arrow.png" width="16" class="handle" /></div>

                                        <div style="width:297px;height:77px; overflow:hidden; float:left; padding:2px;">

                                            <img src="<?= $th_img[0] ?>" width="75" height="58" />

                                        </div>
                                        <div style="width:266px;height:77px; overflow:hidden; float:left; padding:2px;">

                                            <?php echo $row['categoryname']; ?>

                                        </div>
                                           
                                       
                                        <div style="width:80px;height:65px;  overflow:hidden;float:left;">
                                            <a href="#" class="links"  onClick="dil_edit_form_fetch(<?= $autoid; ?>); return false" id="editproduct">Edit</a>&nbsp;|&nbsp;
                                            <a href="#" class="links" onClick="dil_deletecategory(<?= $autoid; ?>); return false">Delete</a>
                                        </div>   </div>
                                       
                                        <div class="ajaxt_editform" id="ajaxt_editform<?= $autoid; ?>"></div>
                                  

                                </li>                       
                                <?php } ?>
                                