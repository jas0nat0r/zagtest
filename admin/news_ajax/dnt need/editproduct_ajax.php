<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");


 
   $sql = "select * from " . $tbl_prduct ." p, " . $tbl_category ." e".
          " Where p.cagegoryid = e.categoryid and".
		  " product_id =".tosql($_POST['proid'], "Number")."";
										 
									//	 echo $sql;
   $rs = mysql_query($sql) or die(mysql_error());
   $row_select = mysql_fetch_array($rs);
  
?>

		
                <div class="editproduct_wrapper"><div class="dil_prodcuttitle">Edit Product</div>
        <br class="clear"/><br class="clear"/><form name="dil_edit_product_details<?php echo $_POST['proid'];?>" class="dil_edit_product_details<?php echo $_POST['proid'];?>" action="<?= $PHP_SELF; ?>" method="post">
        <div class="dil_prodcutlable">Product Name :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdname" id="prdname" class="catinputclass" value="<?php echo $row_select['productname']; ?>"/></div><br class="clear"/>
         <div class="dil_prodcutlable">Product URL :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdurl" id="prdurl" class="catinputclass" value="<?php echo $row_select['producturl']; ?>"/></div><br class="clear"/>
         <div class="dil_prodcutlable">Product Category :</div>
        <div class="dil_prodcutinput"><select name="productcategory">
     
           <?php        $sql = "select * from " . $tbl_category . "";
                        $rs = mysql_query($sql) or die(mysql_error());
                        while ($row = mysql_fetch_array($rs)) {    ?>
                        
                   <option <?php if ($row_select['cagegoryid']== $row['categoryid']){?> selected <?php } ?> value="<?= $row['categoryid']; ?>"><?= $row['categoryname']; ?></option>        
                        
           <?php } ?>
        
        </select></div><br class="clear"/>
        <div class="dil_prodcutlable">Product Description :</div>
        <div class="dil_prodcutinput"><textarea name="prddescription" id="prddescription" class="wymeditor1 catinputclasstextarea"><?php echo $row_select['productdescription']; ?></textarea></div><br class="clear"/>
        <div class="dil_prodcutlable iamgespecial">Product Image :</div>
        <div class="dil_prodcutinput">
         <div id="upload_status" ></div>

                                                            <span id="loader" style="display:none;"><img src="loader.gif" alt="Loading..."/></span> <span id="progress"></span>
                                                            <br />
                                                            <div id="uploaded_image"><img src="<?php echo $row_select['productimage']; ?>" alt="cutrrnt imaeg"/></div>
                                                           
        <input type="hidden" name="slide_image_current" value="<?php echo $row_select['productimage']; ?>"/>
        <input type="hidden" name="pro_id" class="pro_id" value="<?php echo $_POST['proid'];?>"/>
        
        <a id="upload_link" class="links" href="#">Click here to upload photos</a>
        
        </div><br class="clear"/>  <div id="leftimage_cont"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Update"  class="dil_inputbuttons" onClick="dil_update_product(<?php echo $_POST['proid']; ?>, <?php echo $row_select['cagegoryid']; ?>); return false" name="submit" /><input type="button" onClick="dilcloseajax_form(<?php echo $_POST['proid']; ?>);" name="catname" id="productcancel" class="dil_inputbuttons"  value="Cancel"/></div><br class="clear"/>
        </div></form>
         <div id="thumbnail_form" style="display:none; width: 100%; height: auto; float: left;">
                                                                <form name="form" action="" method="post">
                                                                    <input type="hidden" name="x1" value="" id="x1" />
                                                                    <input type="hidden" name="y1" value="" id="y1" />
                                                                    <input type="hidden" name="x2" value="" id="x2" />
                                                                    <input type="hidden" name="y2" value="" id="y2" />
                                                                    <input type="hidden" name="w" value="" id="w" />
                                                                    <input type="hidden" name="h" value="" id="h" />
                                                                    <div style="width: 100%; height: auto;">
                                                                        <input type="submit" name="save_thumb"  value="Save Thumbnail" id="save_thumb" class="btn thumbnailposiotionforajax" />
                                                                    </div>
                                                                   
                                                                </form>
                                                                                    </div>                                             
                                                           
                                                            
                                                            
                                                            
