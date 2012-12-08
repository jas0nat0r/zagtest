<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$btSubmit=$_REQUEST['Submit'];

$admin_email=$_REQUEST['admin_email'];

switch ($btSubmit){
	case "update":	
		$sql = "UPDATE ".$tblAdminEmail." SET".
		" admin_email = ".tosql($admin_email,"Text").
		" ,supportEmail = ".tosql($admin_email,"Text").
		" WHERE autoid=".tosql(1,"Number");
		mysql_query($sql) or die (mysql_error());		
		header("Location:change_email.php");		
	break;
}

$sql = "select * from ".$tblAdminEmail." where autoid=".tosql(1,"Number");
$rs  = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($rs);
$admin_email=$row['admin_email'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script language="javascript" type="text/javascript">

function Delete(autoid)
{
	var userreq=confirm('Are you sure you want to delete ?');
	if (userreq==true)
	{
		var url='category.php?Submit=delete&autoid='+autoid;
		window.location = url;
	}
}

</script>
</head>
<body >
<? include ("header.php");?>
<table width="990" height="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr>
    <td width="972" height="415" align="center" valign="top"><form action="" method="post" name="frm">
      <table width="460" border="0" align="center" class="tahoma_12_drk_ash">
            
            <tr>
          <td height="22" colspan="3" class="SubHead">&nbsp;</td>
        </tr>
        <tr>
          <td height="22" colspan="3" class="heading">Change Email</td>
        </tr>
            <tr>
              <td colspan="2" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <tr>
              <td height="21" colspan="2" valign="top" class="SubHead">&nbsp;</td>
            </tr>
            <tr>
              <td width="165" class="SubHead">Email Address </td>
              <td width="267" class="Normal"><input name="admin_email" type="text" class="NormalTextBox" id="admin_email" value="<?=$admin_email?>" size="50"></td>
            </tr>
          </table>
          <table width="460" border="0" align="center">
            <tr >
              <td height="23" align="center" valign="middle" class="DotLine">-----------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <tr >
              <td width="342" height="23" align="right"><input name="Submit" type="submit" class="StandardButton" id="Submit" value="update"></td>
            </tr>
          </table>
        </form></td>
  </tr>
</table>
<? include ("footer.php");?>
</body>
</html>