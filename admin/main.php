<?php
include ("common/common.php");
$username = $_SESSION['username'];
$accountType = $_SESSION['accountType'];

$s = $_REQUEST['s'];
$error_msg = '';
$suc_msg = '';
$page_name = "main.php";
$limit = 25;

$start = $_REQUEST['start'];
if ($start == "") {
    $start = 0;
}

$eu = ($start - 0);

$this1 = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;

$msg = "";
if ($s != "") {
    $sql = "select status,suspendedNote from " . $tblAdmin . " where digi_id=" . tosql($s, "Number");
    $rs = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $status = $row['status'];
    $suspendedNote = $row['suspendedNote'];

    if ($status == "Suspended") {
        $msg = '<br><br><span class="NormalRedSmall">Your Account has been suspended</span><br><br><span class="Normal">' . $suspendedNote . '</span>';
    } else if ($status == "Deleted") {
        $msg = '<span class="NormalRedSmall">Your Account has been deleted</span>';
    }
}


$category_id = $_REQUEST['category_id'];
$suid = $_REQUEST['suid'];
$autoid = $_REQUEST['autoid'];
$add_to_directory = $_REQUEST['add_to_directory'];
$Submit = $_REQUEST['Submit'];

switch ($Submit) {
    case "update":
        $sql = "UPDATE " . $tblDirectory . " SET" .
                " add_to_directory = " . tosql($add_to_directory, "Text") .
                " WHERE autoid=" . tosql($autoid, "Number");
        mysql_query($sql) or die(mysql_error());
        header("Location:main.php");

        break;

    case "delete":
        $sql = "DELETE FROM " . $tblDirectory . " WHERE autoid=" . tosql($autoid, "Number");
        mysql_query($sql) or die(mysql_error());
        header("Location:main.php");
        break;

    case "Update Email":
        $new_admin_email = $_REQUEST['admin_email'];
        if ($new_admin_email != '') {
            $sql = "UPDATE " . $tblAdminEmail . " SET" .
                    " admin_email = " . tosql($new_admin_email, "Text") .
                    " ,supportEmail = " . tosql($new_admin_email, "Text") .
                    " WHERE autoid=" . tosql(1, "Number");
            mysql_query($sql) or die(mysql_error());
            $suc_msg = 'Email updated sucessfully';
        } else {
            $error_msg = $error_msg . ' Email cannot be empty';
        }
        break;

    case "Change Passowrd":

        $username = $_SESSION['username'];
        $password = get_param("password");
        $repassword = get_param("repassword");

        if ($repassword == $password && $password != "") {
            $sql = "update " . $tblAdmin . " set" .
                    " password = " . tosql($password, "Text") .
                    " where username=" . tosql($username, "Text");
            mysql_query($sql) or die(mysql_error());
            $suc_msg = 'New password updated';
        } else {

            $error_msg = $error_msg . 'Both password fields must match';
        }
        break;
}

$sqle = "select * from " . $tblAdminEmail . " where autoid=" . tosql(1, "Number");
$rse = mysql_query($sqle) or die(mysql_error());
$rowe = mysql_fetch_assoc($rse);
$admin_email = $rowe['admin_email'];
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administration</title>
        <link href="css/body.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/dropdowntabs.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
    </head>

    <body >
        <?php include("inc/header.php"); ?>
        <table width="990" height="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#98B3CE">
            <tr>
                <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td width="972" align="center" valign="top">
                    <table width="460" border="0" align="center" class="tahoma_12_drk_ash">

                        <tr>
                            <td height="22" colspan="3" class="SubHead">
                                <span class="NormalGreenSmall">
                                    <? if (isset($suc_msg) && $suc_msg != '')
                                        echo $suc_msg; ?>
                                </span><br/>
                                <span class="NormalRedSmall">
                                    <? if (isset($error_msg) && $error_msg != '')
                                        echo $error_msg; ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td width="972" height="200" align="center" valign="top">
                    <form action="" method="post" name="frm">
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
                                <td width="267" class="Normal"><input name="admin_email" type="text" class="NormalTextBox" id="admin_email" value="<?= $admin_email ?>" size="50"></td>
                            </tr>
                        </table>
                        <table width="460" border="0" align="center">
                            <tr >
                                <td height="23" align="center" valign="middle" class="DotLine">-----------------------------------------------------------------------------------------------------------------</td>
                            </tr>
                            <tr >
                                <td width="342" height="23" align="right"><input name="Submit" type="submit" class="StandardButton" id="Submit" value="Update Email"/></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <!-- Change password-->
            <tr>
                <td width="972" height="200" align="center" valign="top">
                    <form id="form" name="form" method="post" action="">
                        <table width="460" border="0" align="center" class="tahoma_12_drk_ash">

                            <tr>
                                <td height="22" colspan="3" class="SubHead">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="22" colspan="3" class="heading">Change Password</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------</td>
                            </tr>
                            <tr>
                                <td height="21" colspan="2" valign="top" class="SubHead">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="165" class="SubHead">Enter New Password </td>
                                <td width="267" class="Normal"><input name="password" type="password" class="NormalTextBox" id="password" value="<?= $password ?>" size="50" maxlength="20" /></td>
                            </tr>
                            <tr>
                                <td width="165" class="SubHead">Re-Enter New Password </td>
                                <td width="267" class="Normal"><input name="repassword" type="password" class="NormalTextBox" id="repassword" value="<?= $repassword ?>" size="50" maxlength="20" /></td>
                            </tr>
                        </table>
                        <table width="460" border="0" align="center">
                            <tr >
                                <td height="23" align="center" valign="middle" class="DotLine">-----------------------------------------------------------------------------------------------------------------</td>
                            </tr>
                            <tr >
                                <td width="342" height="23" align="right"><input name="Submit" type="submit" class="StandardButton" id="Submit" value="Change Passowrd"/></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <!-- Logout-->
            <tr>
                <td width="972" height="50" align="center" valign="top">

                    <table width="460" border="0" align="center" class="tahoma_12_drk_ash">
                        <tr>
                            <td height="22" colspan="3" class="SubHead">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="22" colspan="3" class="heading"><a class="heading" href="sign_out.php">Logout</a></td>
                        </tr>

                    </table>
                </td>
            </tr>


        </table>
        <?php include("footer.php"); ?>
    </body>
</html>
