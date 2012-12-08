<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$s_id = $_REQUEST['s_id'];
$autoid = $_REQUEST['autoid'];
$title =  addslashes($_REQUEST['title']);
$f_description = addslashes($_REQUEST['f_description']);
$Submit = $_REQUEST['Submit'];

switch ($Submit)
{
	
	case "":
		$sql = "select * from ".$tblFlightSimulators." where autoid=".tosql($s_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$title = $row['title'];
		$image = $row['image'];
		$f_description = $row['f_description'];
	break;
	
	case "Update":
	
		$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../images/simulators/";
		$image = "simulators_".$s_id.".jpg";	
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image, 390, 245, true); 
			}
		
		$sql = "UPDATE ".$tblFlightSimulators." SET".
		" title = ".tosql(forTexEditor($title),"Text").
		",f_description = ".tosql(forTexEditor($f_description),"Text").
		" WHERE autoid=".tosql($s_id,"Number");
		mysql_query($sql) or die (mysql_error());	
		
		echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');
		
	break;
}
include("fckeditor/fckeditor.php") ;
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) )."admin/fckeditor/" ;
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<link href="css/datepicke.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<link href="css/text_editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script language="javascript">
<!-- Dynamic Version by: Nannette Thacker -->
<!-- http://www.shiningstar.net -->
<!-- Original by :  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->
<!-- Use one function for multiple text areas on a page -->
<!-- Limit the number of characters per textarea -->
<!-- Begin
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
//  End -->
</script>
</head>
<body >
<form method="post" enctype="multipart/form-data" name="formp" id="formp">
  <table width="850" border="0" align="left">
        <tr>
          <td colspan="2" class="heading"> Edit Flight Simulators</td>
          </tr>
        <tr>
          <td width="136" valign="top">&nbsp;</td>
          <td width="704" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Image</td>
          <td class="links"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
          (.jpg width <strong>390px</strong> X <strong>245px</strong>)</td>
        </tr>
        
        <tr>
          <td valign="top" class="Normal">Title</td>
          <td>
  <input name="title" type="text" class="inputBox" id="title" style="width:500px" value="<?php echo(stripslashes(stripslashes($title)));?>"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Description</td>
          <td colspan="3"><?php
			$oFCKeditor = new FCKeditor('f_description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($f_description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
      <td align="left"><img src="../images/simulators/<?=$image?>" width="153" height="96" /></td>
        </tr>
      </table>
</form>
</body>
</html>