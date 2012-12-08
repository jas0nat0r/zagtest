<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");


 
   $sql = "select * from  " . $tbl_category ." ".
          " Where categoryid =".tosql($_POST['catid'], "Number")."";
										 
									//	 echo $sql;
   $rs = mysql_query($sql) or die(mysql_error());
   $row_select = mysql_fetch_array($rs);
  
?>

		
                <div class="editproduct_wrapper"><div class="dil_prodcuttitle">Edit Category</div>
        <br class="clear"/><br class="clear"/><form name="dil_edit_category_details<?php echo $_POST['catid'];?>" class="dil_edit_category_details<?php echo $_POST['catid'];?>" action="<?= $PHP_SELF; ?>" method="post">
        <div class="dil_prodcutlable">Category Name :</div>
        <div class="dil_prodcutinput"><input type="text" name="catname" id="catname" class="catinputclass" value="<?php echo $row_select['categoryname']; ?>"/></div><br class="clear"/>
        <div class="dil_prodcutlable">Category Description :</div>
        <div class="dil_prodcutinput"><textarea name="catdescription" id="catdescription" class="wymeditor1 catinputclasstextarea"><?php echo $row_select['categorydescription']; ?></textarea></div><br class="clear"/>
        <div class="dil_prodcutlable iamgespecial">Category Image :</div>
        <div class="dil_prodcutinput">
         <div id="upload_status" ></div>

                                                            <span id="loader" style="display:none;"><img src="loader.gif" alt="Loading..."/></span> <span id="progress"></span>
                                                            <br />
                                                            <div id="uploaded_image"><img src="<?php echo $row_select['categoryimage']; ?>" alt="No Image"/></div>
                                                           
        
           <input type="hidden" name="slide_image_current" value="<?php echo $row_select['categoryimage']; ?>"/>
        <input type="hidden" name="category_id" class="category_id" value="<?php echo $_POST['catid'];?>"/>
        
        
        <a id="upload_link" class="links" href="#">Click here to upload photos</a>
        
        </div><br class="clear"/>  <div id="leftimage_cont"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Update"  class="dil_inputbuttons" onClick="dil_update_category(<?php echo $_POST['catid']; ?>);" name="submit" /><input type="button" onClick="dilcloseajax_form(<?php echo $_POST['catid']; ?>);" name="catname" id="productcancel" class="dil_inputbuttons"  value="Cancel"/></div><br class="clear"/>
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
                                                           
                                                            
                                                            
                                                            
