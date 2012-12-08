<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$acc_id = $_REQUEST['acc_id'];
$autoid = $_REQUEST['autoid'];
$acc_year = $_REQUEST['acc_year'];
$acc_month = $_REQUEST['acc_month'];
$accomplishment_date = $_REQUEST['accomplishment_date'];
$member = $_REQUEST['member'];
$instructor = $_REQUEST['instructor'];
$aircraft = $_REQUEST['aircraft'];
$accomplishment = $_REQUEST['accomplishment'];
$youtube_video = $_REQUEST['youtube_video'];
$s_description = addslashes($_REQUEST['s_description']);

$Submit=$_REQUEST['Submit'];

switch ($Submit)
{
	
	case "":
		$sql = "select * from ".$tblAccomplishments." where autoid=".tosql($acc_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$acc_year = $row['acc_year'];
		$acc_month = $row['acc_month'];
		$image = $row['image'];
		$accomplishment_date = $row['accomplishment_date'];
		$member = $row['member'];
		$instructor = $row['instructor'];
		$aircraft = $row['aircraft'];
		$accomplishment = $row['accomplishment'];
		$youtube_video = $row['youtube_video'];
		$s_description = $row['s_description'];
		$accomplishment_order = $row['accomplishment_order'];
	break;
	
	case "Update":
		$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../images/accomplishments/";
		$image = "accomplishments_".$acc_id.".jpg";
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image, 390, 245, true); 
			
			$sql = "UPDATE ".$tblAccomplishments." SET".
			" image = ".tosql(forTexEditor($image),"Text").
			" WHERE autoid=".tosql($acc_id,"Number");
			mysql_query($sql) or die (mysql_error());
			}
		
		$sql = "UPDATE ".$tblAccomplishments." SET".
		" acc_year = ".tosql(forTexEditor($acc_year),"Text").
		",acc_month = ".tosql(forTexEditor($acc_month),"Text").
		",accomplishment_date = ".tosql(forTexEditor($accomplishment_date),"Text").
		",member = ".tosql(forTexEditor($member),"Text").
		",instructor = ".tosql(forTexEditor($instructor),"Text").
		",aircraft = ".tosql(forTexEditor($aircraft),"Text").
		",accomplishment = ".tosql(forTexEditor($accomplishment),"Text").
		",youtube_video = ".tosql(forTexEditor($youtube_video),"Text").
		",s_description = \"".$s_description."\"".
		" WHERE autoid=".tosql($acc_id,"Number");
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
  <table width="880" border="0" align="left">
        <tr>
          <td colspan="3" class="heading">Edit Accomplishments</td>
          </tr>
        <tr>
          <td width="174" valign="top">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="NormalDisabled">Image</td>
          <td colspan="2" align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:390px, hight:245px)</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Accomplishment Group</td>
          <td width="163"><select name="acc_month" class="NormalTextBox" id="acc_month" style="width:150px" >
            <option value="-1">Select Month</option>
            <?php
                for($i = 0; $i < sizeof($arr_acc_month); $i++){
                    $select = "";
                    if($arr_acc_month[$i] == $acc_month){
                        $select = "selected";
                    }
                    echo('<option value="'.$arr_acc_month[$i].'" '.$select.'>'.$arr_acc_month[$i].'</option>');
                }
                ?>
          </select></td>
          <td width="529" class="NormalRedSmall"><select name="acc_year" class="NormalTextBox" id="acc_year" style="width:100px" >
            <option value="-1">Select Year</option>
            <?php
                for($i = 0; $i < sizeof($arr_acc_year); $i++){
                    $select = "";
                    if($arr_acc_year[$i] == $acc_year){
                        $select = "selected";
                    }
                    echo('<option value="'.$arr_acc_year[$i].'" '.$select.'>'.$arr_acc_year[$i].'</option>');
                }
                ?>
          </select>
            Select <strong>Month</strong> And <strong>Year</strong></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Accomplishment Date</td>
          <td colspan="2"><input name="accomplishment_date" type="text" class="NormalTextBox" id="accomplishment_date" onClick="displayDatePicker('accomplishment_date', this);" value="<?=$accomplishment_date?>" size="10" readonly="true" /></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Member</td>
          <td colspan="2"><input name="member" type="text" class="NormalTextBox" id="member" value="<?=$member?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Instructor</td>
          <td colspan="2"><input name="instructor" type="text" class="NormalTextBox" id="instructor" value="<?=$instructor?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Aircraft</td>
          <td colspan="2"><input name="aircraft" type="text" class="NormalTextBox" id="aircraft" value="<?=$aircraft?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Accomplishment</td>
          <td colspan="2"><input name="accomplishment" type="text" class="NormalTextBox" id="accomplishment" value="<?=$accomplishment?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Youtube Video</td>
          <td colspan="2"><input name="youtube_video" type="text" class="NormalTextBox" id="youtube_video" value="<?=$youtube_video?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Description</td>
          <td colspan="2"><?php
			$oFCKeditor = new FCKeditor('s_description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($s_description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><img src="../images/accomplishments/<?=$row['image']?>" width="160" height="100"></td>
        </tr>
        <!--<tr>
          <td align="left">&nbsp;</td>
      <td align="left"><?php if($row['image'] !=""){?><img src="../images/services/<?=$row['image']?>" width="351" height="158"><?php }?></td>
        </tr>-->
      </table>
</form>
</body>
</html>