<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$autoid = $_REQUEST['autoid'];
$s_description = addslashes($_REQUEST['s_description']);

$Submit = $_REQUEST['Submit'];

switch ($Submit) {
   

    case "Save":

        $sql = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $s_description . "\"" .                
                " WHERE autoid=" . tosql(1, "Number");
        mysql_query($sql) or die(mysql_error());
        $suc_msg = 'Updates were saved sucessfully';       
        break;
}
include("fckeditor/fckeditor.php");
$sBasePath = $_SERVER['PHP_SELF'];
$sBasePath = substr($sBasePath, 0, strpos($sBasePath, "admin")) . "admin/fckeditor/";

 $sqlc = "select * from " . $tblGeneralContent . " where section='footer'";
        $rsc = mysql_query($sqlc) or die(mysql_error());
        $rowc = mysql_fetch_assoc($rsc);
        $f_content = $rowc['content'];
        
        
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
        <?php include ("inc/header.php"); ?>
        <table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#98B3CE">
            <tr>
                <td width="972" height="415" align="center" valign="top">
                    <form method="post" enctype="multipart/form-data" name="formp" id="formp">
                        <table width="900" border="0" bgcolor="#98B3CE">
                            <tr>
                                <td colspan="3" align="center" class="DotLine">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">
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
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="heading">Edit Copyright text</td>
                            </tr>
                            <tr>
                                <td width="143" height="25" valign="top">&nbsp;</td>
                                <td colspan="2" class="NormalRedSmall"><?= $err ?>&nbsp;</td>
                            </tr>
                            <tr>
                                <td rowspan="2" valign="top" class="Normal">Copyright Text</td>
                                <td width="377" rowspan="2"><textarea name="s_description" class="NormalTextBox"  cols="70" rows="3" wrap="physical" id="s_description" onKeyDown="textCounter(document.formp.s_description,document.formp.remLen1,250)" onKeyUp="textCounter(document.formp.s_description,document.formp.remLen1,250)"><?= forTexEditor($f_content); ?></textarea></td>
                                <td width="366" class="Normal"><strong class="NormalRedSmall">Note :</strong> &copy;&nbsp; = &nbsp; <code>&amp;copy;</code></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;<input readonly type="text" name="remLen1" size="3" maxlength="3" value="250" class="NormalTextBox" />
                                    <span class="Normal">( this text display in footer. </span><strong><span class="NormalRedSmall">max 250 Charactors</span></strong><span class="Normal">)</span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><input name="Submit" type="submit" class="btn" id="Submit" value="Save"/></td>
                            </tr>
                        </table>
                    </form></td>
            </tr>
        </table>
        <?php include ("footer.php"); ?>
    </body>
</html>