<?php
include ("common/common.php");

$form_msg="";
$username = get_param("username");
$password = get_param("password");
$btSubmit = get_param("Submit");

switch ($btSubmit)
{
	case "Signin":
	
		$sql = "select username,password from ".$tblAdmin." where username=". tosql($username, "Text")." and password=". tosql($password, "Text");
		$rs  = mysql_query($sql) or die (mysql_error());

		if ( mysql_num_rows($rs)> 0  )
		{
			$_SESSION['username'] = $username;
			
			header( "Location:main.php" );			
		}
		else
		{
			$form_msg="username / password invalid";
			$strpassword="";
		}

	
	break;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="margin-top:-20px"/><img src="images/logo.png" width="225" height="95" style="margin-bottom:20px;"></td>
  </tr>
  <br/>
  <tr>
    <td height="24" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<table width="990" height="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="415" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="500" valign="top" bgcolor="#FFFFFF"><table width="263" border="0" align="center" cellpadding="0" cellspacing="0">
	<form id="login" name="login" method="post" action="<?=$_POST['PHP_SELF']?>">
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" class="heading">Admin Login</td>
        </tr>
      <tr>
        <td colspan="3" class="DotLine">-----------------------------------------------------------------</td>
        </tr>
      <tr>
        <td width="96">&nbsp;</td>
        <td width="8">&nbsp;</td>
        <td width="159"><span class="NormalRedSmall"><?=$form_msg?></span></td>
        </tr>
      <tr>
        <td><span class="SubHead">username</span></td>
        <td>&nbsp;</td>
        <td><input name="username" type="text" class="NormalTextBox" id="username" value="<?=$username ?>" /></td>
        </tr>
      <tr>
        <td><span class="SubHead">password</span></td>
        <td>&nbsp;</td>
        <td><input name="password" type="password" class="NormalTextBox" id="password" value="<?=$password ?>"/></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="Submit" type="submit" class="StandardButton" value="Signin"/></td>
        </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
		</form>
    </table></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<?php include ("footer.php"); ?>
</body>
</html>



