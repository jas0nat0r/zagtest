<?php
include ("../common/common.php");
include ("../common/xmlfunctions.php");


 
   $sql = "select * from  " . $tblNews ." ".
          " Where idnews =".tosql($_POST['catid'], "Number")."";
										 
									//	 echo $sql;
   $rs = mysql_query($sql) or die(mysql_error());
   $row_select = mysql_fetch_array($rs);
  
?>

		
                <div class="editproduct_wrapper"><div class="dil_prodcuttitle">Edit News</div>
        <br class="clear"/><br class="clear"/><form name="dil_edit_category_details<?php echo $_POST['catid'];?>" class="dil_edit_category_details<?php echo $_POST['catid'];?>" action="<?= $PHP_SELF; ?>" method="post">
        <div class="dil_prodcutlable">News Title :</div>
        <div class="dil_prodcutinput"><input type="text" name="catname" id="catname" class="catinputclass" value="<?php echo $row_select['newstitle']; ?>"/></div><br class="clear"/>
        <div class="dil_prodcutlable">Description :</div>
        <div class="dil_prodcutinput"><textarea name="catdescription" id="catdescription" class="wymeditor1 catinputclasstextarea"><?php echo $row_select['newsdescription']; ?></textarea></div><br class="clear"/><input type="hidden" name="newsid" value="<?php echo $_POST['catid'];?>" />
         <br class="clear"/>  <div id="leftimage_cont"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Update"  class="dil_inputbuttons" onClick="dil_update_category(<?php echo $_POST['catid']; ?>);" name="submit" /><input type="button" onClick="dilcloseajax_form(<?php echo $_POST['catid']; ?>);" name="catname" id="productcancel" class="dil_inputbuttons"  value="Cancel"/></div><br class="clear"/>
        </div></form>
            