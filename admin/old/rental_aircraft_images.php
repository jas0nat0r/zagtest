<?php
include ("common/common.php");
include ("common/imagemanipulation.php");

$cid = $_REQUEST['cid'];
//$cid = 1;
$autoid = $_REQUEST['autoid'];
$Submit = $_REQUEST['Submit'];

/*$sql = "select category from tbl_galler_category Where id=".$cid;
$rs = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($rs);
$category = $row['category'];*/

switch ($Submit)
{
	
	case "delete":
	
		$sql = "select images from ".$tblRentalAircraftsImages." Where id=".$autoid;
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		$images = $row['images'];
		
		delete_file("../images/rental_aircraft/".$images);
		delete_file("../images/rental_aircraft/t_".$images);
		
		$sql= "DELETE FROM ".$tblRentalAircraftsImages." WHERE id=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());
		
		header( "Location:rental_aircraft_images.php?cid=".$cid);
		exit;
		
	break;
}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<link href="css/text_editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script type="text/javascript">
function Delete(autoid)
{
	var userreq=confirm('Are you sure you want to delete ?');
	if (userreq==true)
	{
		var url='rental_aircraft_images.php?Submit=delete&autoid='+autoid+'&cid=<?php echo $cid ?>';
		//var url='rental_aircraft_images.php?Submit=delete&autoid='+autoid;
		window.location = url;
	}
}
</script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>

<style>
#list {margin: 0;padding:0;list-style-type: none;}
#list li {float:left; padding:0 0 5px 0;margin:0 5px 0 0;width:127px;height:83px;list-style:none;}
#list li .handle{height:83px; width:127px;border:solid 1px #999; text-align:center; position:absolute;overflow:hidden;}
#list li .del{ width:20px; height:22px; position:absolute;padding-left:109px;}
#list li .number{ width:10px; height:10px; position:absolute;margin:2px;padding:5px;background-color:#FFF;font-family:Arial, Helvetica, sans-serif;font-size:10px;line-height:10px;color:#999;}
</style>

<link href="uploader/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="uploader/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="uploader/swfobject.js"></script>
<script type="text/javascript" src="uploader/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//image upload
	$("#uploadify").uploadify({
		'uploader'       : 'uploader/uploadify.swf',
		'script'         : 'rental_aircraft_images_upload.php',
		'scriptData'	 : {'param': '<?php echo $cid;?>'},
		'cancelImg'      : 'uploader/cancel.png',
		'folder'         : 'products',
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : true,
		'fileDesc'       : 'Images',
		'fileExt'        : '*.jpg;*.jpeg;*.png;*.gif',
		'onAllComplete'  : function(event, data) {
								self.location.reload(true);
                                //window.opener.location.reload();
								//self.close();
                                }

	});
	
	// sorting
	$(function() {
		$("#list").sortable({ opacity: 0.6, cursor: 'move',handle : '.handle', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&cid=<?php echo $cid ?>'; 
			$.post("rental_aircraft_images_order.php", order, function(theResponse){
				$("#thumbContent").html(theResponse);
			}); 												 
		}								  
		});		
	});
	
});

</script>

</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="center" valign="top">

      <table width="95%" border="0">
        <tr>
          <td><span class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</span></td>
          </tr>
        <tr>
          <td class="heading">Add Images</td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td><table width="582" border="0">
        <tr>
          <td class="NormalRedSmall"><?php echo $msg ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="450"><div id="fileQueue"><input type="file" name="uploadify" id="uploadify" />
<p><a class="links" href="javascript:$('#uploadify').uploadifyUpload();">Upload Files</a>&nbsp;&nbsp;<a class="links" href="javascript:jQuery('#uploadify').uploadifyClearQueue()">Cancel Upload</a></p></div></td>
  </tr>
</table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="thumbContent">
          
              <div style="width:940px; height:600px; float:left;overflow:scroll; position:relative; padding:0;margin: 0;">
                    <ul id="list">
                    <?php
                    $i = 1;
                    $sql = "select * from ".$tblRentalAircraftsImages." Where cid=".$cid." Order by image_order";
                    $rs  = mysql_query($sql) or die (mysql_error());
                    while( $row = mysql_fetch_array($rs)) { 
                        $id = $row['id'];
                        $images = $row['images'];
                    ?>
                        <li id="recordsArray_<?php echo $id ?>">
                            <div class="handle"><img src="../images/rental_aircraft/<?php echo "t_".$images ?>" /></div>
                            <div class="del"><img src="images/del.png" width="20" height="20" onClick="Delete(<?php echo $id ?>);"></div>   
                            <div class="number"><?php echo $i ?></div>     
                        </li>                
                    <?php
                        $i++;
                    	}
                    ?>   
                    </ul>
   			</div>
		</div>
</td>
          </tr>
      </table>
</td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>