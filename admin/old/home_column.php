<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$id = $_REQUEST['id'];
$title =  addslashes($_REQUEST['title']);
$f_description = addslashes($_REQUEST['f_description']);
$target =  addslashes($_REQUEST['target']);

$Submit = $_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["image_order"];

switch ($Submit)
{
	case "Reorder":
		for ($i=0; $i<sizeof($arr_id); $i++)
		{
			$sql = "UPDATE ".$tblHomeColumn." SET".
			" image_order = ".tosql($arr_order[$i],"Number").
			" WHERE id=".tosql($arr_id[$i],"Number");				
			mysql_query($sql) or die (mysql_error());
			
		}
		header("Location:home_column.php");
		exit;
	break;
	//case "delete":
//		$sql = "select image from ".$tblMembers." where autoid=".tosql($autoid,"Number");
//		$rs  = mysql_query($sql) or die (mysql_error());
//		$row = mysql_fetch_assoc($rs);
//		
//		delete_image("../images/home/".$row['image']);
//		
//		$sql= "DELETE FROM ".$tblMembers." WHERE autoid=".tosql($autoid,"Number");
//		mysql_query($sql) or die(mysql_error());
//		
//		header( "Location:home_column.php");
//		exit;
//	break;
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
		var url='home_column.php?Submit=delete&autoid='+autoid;
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
    </form>
    
    <form action="" method="post" name="frmfaq">
    <table width="95%" border="0" align="center">
  <tr>
    <td colspan="7" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
          <td width="136" valign="top">&nbsp;</td>
          <td class="links">Home Bottom Content</td>
        </tr>
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
	<td width="22%" height="30" valign="middle" class="SubHead"><strong>Title</strong></td>
    <td width="22%" height="30" valign="middle" class="SubHead"><strong>Image</strong></td>
    <td width="39%" valign="middle" class="SubHead"><strong>Description</strong></strong></td>
    <td width="22%" valign="middle" class="SubHead"><strong>Target Url </strong></td>
    <td width="4%" align="center" class="SubHead"><strong>Order</strong></td>
    <td width="11%" align="center">&nbsp;</td>
  </tr>
	<?php
		$sql = "select * from ".$tblHomeColumn." Order by image_order";
		$rs  = mysql_query($sql) or die (mysql_error());
		$i=1;
		while( $row = mysql_fetch_array($rs)) {
		$id = $row['id'];
		$image = $row['image'];
		$title = $row['title'];
		$f_description = $row['f_description'];
		$target = $row['target'];
		$image_order = $row['image_order'];
    ?>
  <tr bgcolor="#ececec" onMouseOver="this.bgColor='#dbd9d9'" onMouseOut="this.bgColor='#ececec'">
    <td width="2%" align="center" valign="top" class="Normal">[<?=$i?>]
      <input name="id[]" type="hidden" id="id[]" value="<?=$row['id']?>"></td>
	  <td align="left" valign="top" class="Normal"><?=$title?></td>
    <td align="left" valign="top" class="Normal"><img src="../images/home/<?=$image?>" width="200" height="71" />&nbsp;</td>
    <td align="left" valign="top" class="Normal"><?php echo(nl2br2($f_description));?></td>
    <td align="left" valign="top" class="Normal"><?php echo($target);?></td>
    <td align="center" valign="top" class="links"><input name="image_order[]" type="text" class="NormalTextBox" id="image_order[]" value="<?=$row['image_order']?>" size="2" maxlength="2"></td>
    <td align="center" valign="top" class="links"><a href="javascript:" class="links" onClick="MM_openBrWindow('edit-home_column.php?id=<?=$row['id']?>','edit','location=yes,resizable=yes,width=900,height=750,scrollbars=yes')">Edit</a> <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')"></a> </td>
    </tr>
<?php	
	$i++; 
	}
?>
  <tr>
    <td align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="Normal">&nbsp;</td>
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