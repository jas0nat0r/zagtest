<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$ss_id = $_REQUEST['ss_id'];
$autoid = $_REQUEST['autoid'];
$title =  addslashes($_REQUEST['title']);
$f_description =  addslashes($_REQUEST['f_description']);
$Submit = $_REQUEST['Submit'];

switch ($Submit)
{
	
	case "":
		$sql = "select * from ".$tblImages." where id=".tosql($ss_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$title = $row['title'];
		$f_description = $row['f_description'];
	break;
	
	case "Update":		
		$sql = "UPDATE ".$tblImages." SET".
		" title = ".tosql(forTexEditor($title),"Text").
		",f_description = \"".$f_description."\"".
		" WHERE id=".tosql($ss_id,"Number");
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

</head>
<body >
<form method="post" enctype="multipart/form-data" name="form" id="form">
  <table width="850" border="0" align="left">
        <tr>
          <td colspan="2" class="heading"> Edit Slide Content</td>
          </tr>
        <tr>
          <td width="150" valign="top">&nbsp;</td>
          <td width="690" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <!--<tr>
          <td valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="inputBox" id="title" style="width:500px" value="<?php echo(stripslashes(stripslashes($title)));?>"></td>
        </tr>-->
        <tr>
          <td>&nbsp;</td>
          <td><?php
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
      </table>
</form>
</body>
</html>