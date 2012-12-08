<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");


 
   $sql = "select * from " . $tbl_prduct ." p ".
          " Where product_id =".tosql($_POST['proid'], "Number")."";
										 
									//	 echo $sql;
   $rs = mysql_query($sql) or die(mysql_error());
   $row_select = mysql_fetch_array($rs);
  
?>

		
                <div class="editproduct_wrapper"><div class="dil_prodcuttitle">Edit Link</div>
        <br class="clear"/><br class="clear"/><form name="dil_edit_product_details<?php echo $_POST['proid'];?>" class="dil_edit_product_details<?php echo $_POST['proid'];?>" action="<?= $PHP_SELF; ?>" method="post">
        <input type="hidden" name="product_id" value="<?php echo $_POST['proid'];?>"/>
        <div class="dil_prodcutlable">Link Name :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdname" id="prdname" class="catinputclass" value="<?php echo $row_select['productname']; ?>"/></div><br class="clear"/>
         <div class="dil_prodcutlable">URL :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdurl" id="prdurl" class="catinputclass" value="<?php echo $row_select['producturl']; ?>"/></div><br class="clear"/>
        <div class="dil_prodcutlable">Link Description :</div>
        <div class="dil_prodcutinput"><textarea name="prddescription" id="prddescription" class="wymeditor1 catinputclasstextarea"><?php echo $row_select['productdescription']; ?></textarea></div><br class="clear"/>
        <div class="dil_prodcutlable iamgespecial">Link Image :</div>
        <div class="dil_prodcutinput">
        	<div id="upload2" ><span>Upload File<span></div><span id="status" class="status<?php echo $_POST['proid'];?>" ></span>
		
            <div id="files" class="files<?php echo $_POST['proid'];?>" >
            
            <img src="../images/linksimg/<?php echo $row_select['productimage']; ?>" alt="" />
           
            </div>
        
         <span class="editformcurrentfileurl<?php echo $_POST['proid'];?>"><input type="hidden" name="uploadurl"  value="<?php echo $product_image = "../productfiles/".$_POST['uploadurl'];?>"/></span>
        </div><br class="clear"/>  <div id="leftimage_cont"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Update"  class="dil_inputbuttons" onClick="dil_update_product(<?php echo $_POST['proid']; ?>, <?php echo $row_select['cagegoryid']; ?>); return false" name="submit" /><input type="button" onClick="dilcloseajax_form(<?php echo $_POST['proid']; ?>);" name="catname" id="productcancel" class="dil_inputbuttons"  value="Cancel"/></div><br class="clear"/>
        </div></form>
         <div id="thumbnail_form" style="display:none; width: 100%; height: auto; float: left;">
                                                              
                                                                                    </div>                                             
                                                           
                                                            
                                                            
                                                            
