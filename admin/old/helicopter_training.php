<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$autoid = $_REQUEST['autoid'];
$page_name = $_REQUEST['page_name'];
$page_url = $_REQUEST['page_url'];
//$f_description = addslashes($_REQUEST['f_description']);

$Submit = $_REQUEST['Submit'];


switch ($Submit)
{
	case "":
		$sql = "select * from ".$tblSubPages." where autoid= 13";
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$page_name = $row['page_name'];
		$page_url = $row['page_url'];
		$image = $row['image'];
	break;
	
	case "Save":
	/*$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../assets/pages/";
		$image = "helicopter_training.".image_valid($_FILES["uploadimage"]["type"]);
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image, 950, 305, true); 
			
			$sql = "UPDATE ".$tblSubPages." SET image = '".$image."' where autoid =13";
			mysql_query($sql) or die (mysql_error());
		}*/
		
		$sql = "UPDATE ".$tblSubPages." SET".
		" page_name = ".tosql(forTexEditor($page_name),"Text").
		",page_url = ".tosql(forTexEditor($page_url),"Text").
		" WHERE autoid=".tosql(13,"Number");
		mysql_query($sql) or die (mysql_error());
		
		header("Location:helicopter_training.php");
		exit;
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

<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<link href="css/text_editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>

</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form" id="form">
      <table width="900" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="heading">Edit Helicopter Training</td>
          </tr>
        <tr>
          <td width="145" valign="top">&nbsp;</td>
          <td width="745" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <!--<tr>
          <td valign="top" class="Normal">Page Image</td>
          <td class="links"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
          ( width <strong>950px</strong> X <strong>305px</strong>)</td>
        </tr>-->
        <tr>
          <td valign="top" class="Normal">Page Name</td>
          <td><input name="page_name" type="text" class="NormalTextBox" id="page_name" value="<?=$page_name?>" size="75"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Page Url</td>
          <td><input name="page_url" type="text" class="NormalTextBox" id="page_url" value="<?=$page_url?>" size="75"> 
            <span class="NormalRedSmall"> <strong>ex:http://www.domain-name.com</strong></span></td>
        </tr>
        <!--<tr>
          <td valign="top" class="Normal">Description</td>
          <td><?php
			$oFCKeditor = new FCKeditor('f_description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($f_description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>-->
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Save"/></td>
        </tr>
        <!--<tr>
          <td>&nbsp;</td>
          <td><img src="../assets/pages/<?=$image?>" width="745" height="238" /></td>
        </tr>-->
      </table>
    </form></td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>