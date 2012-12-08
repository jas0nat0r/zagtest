<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$s_id = $_REQUEST['s_id'];
$autoid = $_REQUEST['autoid'];
$instructor =  addslashes($_REQUEST['instructor']);
$primary_number =  addslashes($_REQUEST['primary_number']);
$secondary_number =  addslashes($_REQUEST['secondary_number']);
$instruction = addslashes($_REQUEST['instruction']);
$email =  addslashes($_REQUEST['email']);
$rates =  addslashes($_REQUEST['rates']);
$description =  addslashes($_REQUEST['description']);
$images =  addslashes($_REQUEST['images']);
$Submit = $_REQUEST['Submit'];

switch ($Submit)
{
	
	case "":
		$sql = "select * from ".$tblFullTimeInstructor." where autoid=".tosql($s_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$instructor = $row['instructor'];
		$primary_number = $row['primary_number'];
		$secondary_number = $row['secondary_number'];
		$instruction = $row['instruction'];
		$email = $row['email'];
		$rates = $row['rates'];
		$description = $row['description'];
		$images = $row['images'];
	break;
	
	case "Update":
		
		$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		$uploaddir="../images/instructors/";
		$image = "instructors.".image_valid($_FILES["uploadimage"]["type"]);
		
			if (!empty($tmp_name)) {
				move_uploaded_file($tmp_name, $uploaddir.$image);
				smart_resize_image($uploaddir.$image, 186, 226, true); 
				
			$sql = "UPDATE ".$tblFullTimeInstructor." SET".
			" images = \"".$image."\"".
			" WHERE autoid=".tosql($s_id,"Number");
			mysql_query($sql) or die (mysql_error());
		}
			
		$sql = "UPDATE ".$tblFullTimeInstructor." SET".
		" instructor = ".tosql(forTexEditor($instructor),"Text").
		",primary_number = ".tosql(forTexEditor($primary_number),"Text").
		",secondary_number = ".tosql(forTexEditor($secondary_number),"Text").
		",instruction = ".tosql(forTexEditor($instruction),"Text").
		",email = ".tosql(forTexEditor($email),"Text").
		",rates = ".tosql(forTexEditor($rates),"Text").
		",description = ".tosql(forTexEditor($description),"Text").
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
          <td colspan="2" class="heading"> Edit Full time Instructors</td>
          </tr>
        <tr>
          <td width="136" valign="top">&nbsp;</td>
          <td width="704" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        
        <tr>
          <td height="25" valign="top" class="Normal">Instructors Name</td>
          <td><input name="instructor" type="text" class="inputBox" id="instructor" style="width:400px" value="<?php echo(stripslashes(stripslashes($instructor)));?>"></td>
        </tr>
        <tr>
          <td height="25" valign="top" class="Normal">Primary</td>
          <td><input name="primary_number" type="text" class="inputBox" id="primary_number" style="width:400px" value="<?php echo(stripslashes(stripslashes($primary_number)));?>"></td>
        </tr>
        <tr>
          <td height="25" valign="top" class="Normal">Secondary</td>
          <td><input name="secondary_number" type="text" class="inputBox" id="secondary_number" style="width:400px" value="<?php echo(stripslashes(stripslashes($secondary_number)));?>"></td>
        </tr>
        <tr>
          <td height="25" valign="top" class="Normal">Instruction</td>
          <td><input name="instruction" type="text" class="inputBox" id="instruction" style="width:400px" value="<?php echo(stripslashes(stripslashes($instruction)));?>"></td>
        </tr>
        <tr>
          <td class="Normal">Email</td>
          <td><input name="email" type="text" class="inputBox" id="email" style="width:400px" value="<?php echo(stripslashes(stripslashes($email)));?>"></td>
        </tr>
        <tr>
          <td class="Normal">Rates</td>
          
          <td class="NormalRedSmall"><input name="rates" type="text" class="inputBox" id="rates" style="width:400px" value="<?php echo(stripslashes(stripslashes($rates)));?>">
          Ex: 290 (<strong>not like $290</strong>)</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Instructors Image</td>
          <td class="links"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
         <tr>
          <td valign="top" class="Normal">Description</td>
          <td><?php
			$oFCKeditor = new FCKeditor('description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
         <tr>
          <td>&nbsp;</td>
          <td><img src="../images/instructors/<?=$images?>" width="186" height="226" /></td>
        </tr>
      </table>
</form>
</body>
</html>