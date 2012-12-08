<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");


$bannerStatus = $_REQUEST['bannerStatus'];
$autoid = $_REQUEST['autoid'];
$image = $_REQUEST['image'];
$f_description = addslashes($_REQUEST['f_description']);
$title = $_REQUEST['title'];
$video = $_REQUEST['video'];
$youtube_video = $_REQUEST['youtube_video'];
$acc_year = $_REQUEST['acc_year'];
$acc_month = $_REQUEST['acc_month'];
$accomplishment_date = $_REQUEST['accomplishment_date'];
$member = $_REQUEST['member'];
$instructor = $_REQUEST['instructor'];
$aircraft = $_REQUEST['aircraft'];
$accomplishment = $_REQUEST['accomplishment'];
$s_description = addslashes($_REQUEST['s_description']);

$Submit=$_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["accm_order"];

if($bannerStatus == "Yes"){$bannerStatus = "Yes";}else{$bannerStatus = "No";}

switch ($Submit)
{
	case "":
		$sql = "select * from ".$tblSubPages." where autoid= 7";
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$title = $row['title'];
		$f_description = $row['f_description'];
		$image = $row['image'];
	break;
	
	case "Save":
	$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../assets/pages/";
		$image = "accomplishments.".image_valid($_FILES["uploadimage"]["type"]);
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image, 950, 305, true); 
			
			$sql = "UPDATE ".$tblSubPages." SET image = '".$image."' where autoid =7";
			mysql_query($sql) or die (mysql_error());
		}
		
		$sql = "UPDATE ".$tblSubPages." SET".
		" status = ".tosql($bannerStatus,"Text").
		",title = ".tosql(forTexEditor($title),"Text").
		",f_description = \"".$f_description."\"".
		" WHERE autoid=".tosql(7,"Number");
		mysql_query($sql) or die (mysql_error());
		
		
		header("Location:add_accomplishments.php");
		exit;
	break;
	
	case "Add":	
	$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		if (!empty($tmp_name)) {
	
		$sql = "INSERT INTO ".$tblAccomplishments."(acc_year,acc_month,accomplishment_date,member,instructor,aircraft,accomplishment,s_description,youtube_video) VALUES ('".$acc_year."','".$acc_month."','".$accomplishment_date."','".forTexEditor($member)."','".forTexEditor($instructor)."','".forTexEditor($aircraft)."','".forTexEditor($accomplishment)."','".$s_description."','".forTexEditor($youtube_video)."')";
		mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();
		
		$image = "accomplishments_".$id.".jpg";				
		$uploaddir="../images/accomplishments/";
		
		move_uploaded_file($tmp_name, $uploaddir.$image);
		smart_resize_image($uploaddir.$image, 390, 245, true); 
		
		$sql = "UPDATE ".$tblAccomplishments." SET image = '".$image."' where autoid=".$id;
		mysql_query($sql) or die (mysql_error());
		
		header("Location:add_accomplishments.php");
		exit;
		}else{
			$err = "Attach Image";
		}
	break;
	
	case"Reorder":
		for ($i=0; $i<sizeof($arr_id); $i++){
			$sql = "UPDATE ".$tblAccomplishments." SET".
			" accomplishment_order = ".tosql($arr_order[$i],"Number").
			" WHERE autoid=".tosql($arr_id[$i],"Number");
			mysql_query($sql) or die (mysql_error());
		}
		header("Location:add_accomplishments.php");
		exit;
	break;
	case "delete":
	
		$sql= "DELETE FROM ".$tblAccomplishments." WHERE autoid=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());	
		
		//delete_file("../images/services/srv_".$autoid.".jpg");
		
		header( "Location:add_accomplishments.php");
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
<script type="text/javascript">
function Delete(autoid)
{
	var userreq=confirm('Are you sure you want to delete ?');
	if (userreq==true)
	{	
		window.location='add_accomplishments.php?Submit=delete&autoid='+autoid;
	}
}
</script>
</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form" id="form">
      <table width="90%" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="heading">Edit Accomplishments Main Content</td>
          </tr>
        <tr>
          <td width="17%" valign="top">&nbsp;</td>
          <td width="83%" class="NormalRedSmall">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="NormalDisabled">Banner Image</td>
          <td align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:950px, hight:305px)</td>
        </tr>
		<tr>
          <td valign="top" class="Normal">Banner Status </td>
          <td colspan="3" class="Normal"> <input checked="checked" name="bannerStatus" type="checkbox" id="bannerStatus" value="Yes" <?=GetCheckBanner($bannerStatus)?> /></td>
		</tr>
        <!--<tr>
          <td valign="top" class="Normal">Image Title</td>
          <td><input name="image_title" type="text" class="NormalTextBox" id="image_title" value="<?=$image_title?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="NormalTextBox" id="title" value="<?=$title?>" style="width:400px;"></td>
        </tr>-->
        <tr>
          <td valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="NormalTextBox" id="title" value="<?=$title?>" size="75"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Full Description</td>
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
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Save"/><input name="autoid" type="hidden" value="<?=$autoid?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><img src="../assets/pages/<?=$image?>" width="745" height="238" /></td>
        </tr>
      </table>
    </form>
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="90%" border="0">
        <tr>
          <td colspan="3">==================================================================================================</td>
          </tr>
        <tr>
          <td colspan="3" class="heading">Add Accomplishments</td>
          </tr>
        <tr>
          <td width="17%" valign="top">&nbsp;</td>
          <td colspan="2" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="NormalDisabled">Image</td>
          <td colspan="2" align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:390px, hight:245px)</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Accomplishment Group</td>
          <td width="18%"><select name="acc_month" class="NormalTextBox" id="acc_month" style="width:150px" >
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
          <td width="65%" class="NormalRedSmall"><select name="acc_year" class="NormalTextBox" id="acc_year" style="width:100px" >
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
          <td colspan="2" class="Normal"><input name="youtube_video" type="text" class="NormalTextBox" id="youtube_video" value="<?=$youtube_video?>" style="width:150px;">
            <span class="Normal"> ex: http://www.youtube.com/watch?v=</span><span class="NormalRedSmall"><strong>14mI96A8yFU</strong></span> <span class="Normal">** Add Only</span> <span class="NormalRedSmall"><strong>Red</strong></span> <span class="Normal">colored code as shown</span></td>
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
          <td colspan="2"><input name="Submit" type="submit" class="btn" id="Submit" value="Add"/></td>
        </tr>
      </table>
    </form>
    <form action="" method="post" name="frmfaq">
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="11" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
    <td width="81" height="30" valign="middle" class="SubHead"><strong>Image</strong></td>
    <td width="94" valign="middle" class="SubHead"><strong>Group</strong></td>
    <td width="74" valign="middle" class="SubHead"><strong>Date</strong></td>
    <td width="124" valign="middle" class="SubHead"><strong>Member/ Instructor</strong></td>
    <td width="100" valign="middle" class="SubHead"><strong>Aircraft</strong></td>
    <td width="162" valign="middle" class="SubHead"><strong>Accomplishment</strong></td>
    <td width="47" valign="middle" class="SubHead"><strong>Video</strong></td>
    <td width="32" align="center" class="SubHead"><strong>Order</strong></td>
    <td width="110" align="center">&nbsp;</td>
  </tr>
	<?php
		$sql = "select * from ".$tblAccomplishments." Order by accomplishment_order";
		$rs  = mysql_query($sql) or die (mysql_error());
		$i=1;
		while( $row = mysql_fetch_array($rs)) {
		$acc_year = $row['acc_year'];
		$acc_month = $row['acc_month'];
		$video = $row['video'];
		$youtube_video = $row['youtube_video'];
		$accomplishment_date = $row['accomplishment_date'];
		$member = $row['member'];
		$instructor = $row['instructor'];
		$aircraft = $row['aircraft'];
		$accomplishment = $row['accomplishment'];
		$accomplishment_order = $row['accomplishment_order'];
    ?>
  <tr bgcolor="#ececec" onMouseOver="this.bgColor='#dbd9d9'" onMouseOut="this.bgColor='#ececec'">
    <td width="25" align="center" valign="top" class="Normal">[<?=$i?>] <input name="id[]" type="hidden" id="id[]" value="<?=$row['autoid']?>"></td>
    <td align="left" valign="top" class="Normal"><img src="../images/accomplishments/<?=$row['image']?>" width="75" height="38"></td>
    <td align="left" valign="top" class="Normal"><?php echo($acc_month." ".$acc_year);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($accomplishment_date);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($member."<br>".$instructor);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($aircraft);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($accomplishment);?></td>
    <td align="left" valign="top" class="Normal"><?php if($youtube_video!=""){?><img src="../images/video_icon.jpg" width="43" height="33" /><?php }?></td>
    <td align="center" valign="top" class="links"><input name="accm_order[]" type="text" class="NormalTextBox" id="accm_order" value="<?=$row['accomplishment_order']?>" size="2" maxlength="2"></td>
    <td align="center" valign="top" class="links"><!--<a href="javascript:" class="links" onClick="MM_openBrWindow('add_accomplishment_video.php?v_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=590,height=500,scrollbars=yes')"><strong>Video</strong></a> | --><a href="javascript:" class="links" onClick="MM_openBrWindow('edit-add_accomplishments.php?acc_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=900,height=750')">Edit</a> | <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')">Delete</a> </td>
    </tr>
<?php
	$i++; 
	}
?>
  <tr>
    <td align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="2" align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="5" align="left" valign="top" class="Normal">&nbsp;</td>
    <td colspan="2" align="center" valign="top" class="links"><input name="Submit" type="submit" class="btn" id="Submit" value="Reorder"/></td>
    </tr>
</table>
</form>
</td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>