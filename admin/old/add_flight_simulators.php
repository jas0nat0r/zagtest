<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$autoid = $_REQUEST['autoid'];
$title =  addslashes($_REQUEST['title']);
$f_description = addslashes($_REQUEST['f_description']);

$Submit = $_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["s_order"];

switch ($Submit)
{
	case "Add":	
	$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		if (!empty($tmp_name)) {
			
		$sql = "INSERT INTO ".$tblFlightSimulators."(title,f_description) VALUES ('".$title."','".forTexEditor($f_description)."')";
		mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();
		
		$image = "simulators_".$id.".jpg";				
		$uploaddir="../images/simulators/";
		
		move_uploaded_file($tmp_name, $uploaddir.$image);
		//do_crop($uploaddir.$image,927,351,90);
		smart_resize_image($uploaddir.$image, 390, 245, true); 
		
		$sql = "UPDATE ".$tblFlightSimulators." SET image = '".$image."' where autoid=".$id;
		mysql_query($sql) or die (mysql_error());
		
		header("Location:add_flight_simulators.php");	
		exit;
		/*echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');*/
		}else{
			$err = "Attach Image";
		}
	break;
	
	case "Reorder":
		for ($i=0; $i<sizeof($arr_id); $i++)
		{
			$sql = "UPDATE ".$tblFlightSimulators." SET".
			" simulators_order = ".tosql($arr_order[$i],"Number").
			" WHERE autoid=".tosql($arr_id[$i],"Number");				
			mysql_query($sql) or die (mysql_error());
			
		}
		header("Location:add_flight_simulators.php");
		exit;
	break;
	case "delete":
		$sql = "select image from ".$tblFlightSimulators." where autoid=".tosql($autoid,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		
		delete_image("../images/simulators/".$row['image']);
		
		$sql= "DELETE FROM ".$tblFlightSimulators." WHERE autoid=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());
		
		header( "Location:add_flight_simulators.php");
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
		var url='add_flight_simulators.php?Submit=delete&autoid='+autoid;
		window.location = url;
	}
}
</script>
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
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="formp" id="formp">
      <table width="95%" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="heading">Add Flight Simulators</td>
          </tr>
        <tr>
          <td width="18%" valign="top">&nbsp;</td>
          <td width="82%" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Image</td>
          <td class="links"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
         (.jpg width <strong>390px</strong> X <strong>245px</strong>)</td>
        </tr>
        
        <tr>
          <td height="25" valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="inputBox" id="title" style="width:400px" value="<?php echo(stripslashes(stripslashes($title)));?>"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Description</td>
          <td colspan="3"><?php
			$oFCKeditor = new FCKeditor('f_description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($f_description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Add"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="" method="post" name="frmfaq">
    <table width="95%" border="0" align="center">
  <tr>
    <td colspan="6" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
    <td width="17%" height="30" valign="middle" class="SubHead"><strong>Member Image</strong></td>
    <td valign="middle" class="SubHead"><strong>Title<strong> / Description</strong></strong></td>
    <td width="4%" align="center" class="SubHead"><strong>Order</strong></td>
    <td width="11%" align="center">&nbsp;</td>
  </tr>
	<?php
		$sql = "select * from ".$tblFlightSimulators." Order by simulators_order";
		$rs  = mysql_query($sql) or die (mysql_error());
		$i=1;
		while( $row = mysql_fetch_array($rs)) {
		$autoid = $row['autoid'];
		$image = $row['image'];
		$title = $row['title'];
		$f_description = $row['f_description'];
		$simulators_order = $row['simulators_order'];
    ?>
  <tr bgcolor="#ececec" onMouseOver="this.bgColor='#dbd9d9'" onMouseOut="this.bgColor='#ececec'">
    <td width="2%" align="center" valign="top" class="Normal">[<?=$i?>]
      <input name="id[]" type="hidden" id="id[]" value="<?=$row['autoid']?>"></td>
    <td align="left" valign="top" class="Normal"><img src="../images/simulators/<?=$image?>" width="112" height="70" /></td>
    <td align="left" valign="top" class="Normal"><strong><?=$title?></strong><br><?php echo(stripslashes($f_description));?></td>
    <td align="center" valign="top" class="links"><input name="s_order[]" type="text" class="NormalTextBox" id="s_order[]" value="<?=$row['simulators_order']?>" size="2" maxlength="2"></td>
    <td align="center" valign="top" class="links"><a href="javascript:" class="links" onClick="MM_openBrWindow('edit-add_flight_simulators.php?s_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=900,height=750,scrollbars=yes')">Edit</a> | <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')">Delete</a> </td>
    </tr>
<?php	
	$i++; 
	}
?>
  <tr>
    <td align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="2" align="center" valign="top" class="Normal">&nbsp;</td>
    <td align="center" valign="top" class="links">&nbsp;</td>
    <td align="center" valign="top" class="links"><input name="Submit" type="submit" class="btn" id="Submit" value="Reorder"/></td>
    </tr>
</table>

    </form></td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>