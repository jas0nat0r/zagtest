<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$mp_id = $_REQUEST['mp_id'];
$autoid = $_REQUEST['autoid'];
$page_name =  $_REQUEST['page_name'];
$Submit = $_REQUEST['Submit'];

switch ($Submit)
{
	case "":
		$sql = "select * from ".$tblMainPages." where autoid=".tosql($mp_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$page_name = $row['page_name'];
	break;
	
	case "Update":
		$sql = "UPDATE ".$tblMainPages." SET".
		" page_name = ".tosql(forTexEditor($page_name),"Text").
		" WHERE autoid=".tosql($mp_id,"Number");
		mysql_query($sql) or die (mysql_error());	
		echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');
	break;
}
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
  <table width="500" border="0" align="left">
        <tr>
          <td colspan="2" class="heading"> Edit Main Page </td>
          </tr>
        <tr>
          <td width="100" valign="top">&nbsp;</td>
          <td width="390" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Page Name</td>
          <td class="links"><input name="page_name" type="text" class="NormalTextBox" id="page_name" value="<?=$page_name?>" size="75"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
      </table>
</form>
</body>
</html>